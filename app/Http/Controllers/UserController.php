<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Auth;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class UserController
 */
class UserController extends AppBaseController
{
    /** @var  UserRepository $userRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @param  int  $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (! $user) {
            return redirect()->back()->withErrors('User not found');
        }
        $data = $this->userRepository->getUserCreateData();
        $states = [];
        $cities = [];
        if ($user->country_id) {
            $states = getStates($user->country_id);
        }
        if ($user->state_id){
            $cities = getCities($user->state_id);
        }
        $data['states'] = $states;
        $data['cities'] = $cities;

        return view('users.edit', compact('user'))->with($data);
    }

    /**
     * @param  UpdateUserRequest  $request
     *
     * @param  int  $id
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        /* @var User $user */
        $user = User::findOrFail($id);
        if (! $user) {
            return redirect()->back()->withErrors('User not found');
        }

        $input = $request->all();
//        $input['phone'] = preparePhoneNumber($input['phone'], $input['region_code']);

        $input['region_code'] = isset($input['phone']) ? $input['region_code'] : getAdminSettingValue('default_region_code');
        $input['region_code_flag'] = isset($input['phone']) ? $input['region_code_flag'] : getAdminSettingValue('default_region_code_flag');

        $input['dob'] = ! empty($input['dob']) ? Carbon::parse($input['dob'])->format('Y-m-d') : null;
        $input['available_as_freelancer'] = isset($input['available_as_freelancer']) ? $input['available_as_freelancer'] : false;
        $user->update($input);

        Flash::success('Profile Update Successfully.');

        return redirect()->route('users.edit', $user->id);

    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getStates(Request $request)
    {
        $postal = $request->get('postal');

        $states = getStates($postal);

        return $this->sendResponse($states, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $state = $request->get('state');
        $cities = getCities($state);

        return $this->sendResponse($cities, 'Retrieved successfully');
    }

    /**
     * @param  ChangePasswordRequest  $request
     *
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $input = $request->all();

        try {
            $this->userRepository->changePassword($input);

            return $this->sendSuccess('Password updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function updateProfileImage(Request $request)
    {
        $user = auth()->user();
        $input = $request->all();
        try {
            if (isset($input['profile_image']) && ! empty($input['profile_image'])) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($input['profile_image'])->toMediaCollection(User::PROFILE, config('app.media_disc'));

                return $this->sendSuccess('Profile image update successfully.');
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function editProfile($id)
    {
        $user = User::findOrFail($id);

        return $this->sendResponse($user, 'Profile retrieved successfully.');
    }

    /**
     * @param  UpdateProfileRequest  $request
     *
     * @return mixed
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $input = $request->all();

        $this->userRepository->updateProfile($input);

        return $this->sendSuccess('Profile updated successfully.');
    }

    public function updateLanguage(Request $request)
    {
        $language = $request->get('language');
        /** @var User $user */
        $user = Auth::user();
        $user->update(['language' => $language]);

        return $this->sendSuccess('Language updated successfully.');
    }

    /**
     * @param  CreateUserRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $this->userRepository->store($input);
        Flash::success('Your registration has successfully done. Verify account from your email.');

        return redirect('login');
    }

    /**
     * @param  Request  $request
     * @param  User  $user
     *
     * @return mixed
     */
    public function changeStatus(Request $request, User $user)
    {
        $status = $request->all();
        $user->update($status);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @param  \App\Models\User  $user
     *
     *
     * @return mixed
     */
    public function emailVerified(User $user) 
    {
        if (empty($user->email_verified_at)) {
            $user->update(['email_verified_at' => Carbon::now()]);
        } else {
            $user->update(['email_verified_at' => null]);
        }

        
        return $this->sendSuccess('Email verified successfully.');
    }
    
    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function checkUserName(Request $request)
    {
        $checkName = $request->all();

        if (User::where('user_name', '=', $checkName)->exists()) {
            return $this->sendError('User name already exists.');
        } else {
            return $this->sendSuccess('user not found');
        }
    }

    public function impersonate($userId)
    {
        //if user is not admin and session is impersonated_by then return
        if ((! getLoggedInUser()->hasRole('super_admin')) || session('impersonated_by')) {
            return redirect()->back();
        }

        $user = User::find($userId);
        getLoggedInUser()->impersonate($user);

        return redirect()->route('users.edit', $user->id);
    }

    public function impersonateLeave()
    {
        getLoggedInUser()->leaveImpersonation();

        return redirect()->route('dashboard');
    }

    /**
     * @param  Request  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function resendVerificationEmail(Request $request)
    {
        /** @var User $user */
        $user = User::where('email', $request->get('user-email'))->first();
        if ($user != null) {
            $user->sendEmailVerificationNotification();
            Flash::success('Email verification link sent to your email.');
        } else {
            Flash::error('No such user found with this email.');
        }

        return redirect('login');
    }
}
