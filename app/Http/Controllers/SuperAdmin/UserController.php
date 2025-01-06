<?php

namespace App\Http\Controllers\SuperAdmin;

use App\DataTable\UsersDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\MultiTenant;
use App\Models\User;
use App\Repositories\UserRepository;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class UserController extends AppBaseController
{
    /**
     * @var UserRepository
     */
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new UsersDataTable())->get($request->only(['status', 'available_as_freelancer'])))->make(true);
        }

        $userStatus = User::STATUS;
        $available_as_freelancer = User::AVAILABLE_AS_FREELANCER;

        return view('super_admin.users.index', compact('userStatus', 'available_as_freelancer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('super_admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $this->userRepo->store($input);
            Flash::success('User created Successfully.');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Flash::error($e->getMessage());
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     *
     * @return Application|Factory|View|Response
     */
    public function show(User $user)
    {
        return view('super_admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     *
     * @return Application|Factory|View|Response
     */
    public function edit(User $user)
    {
        return view('super_admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     *
     * @param  User  $user
     *
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $this->userRepo->updateUser($input, $user);
            Flash::success('User updated Successfully.');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Flash::error($e->getMessage());
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     *
     * @return Response
     */
    public function destroy(User $user)
    {
        $tenant = MultiTenant::where('id', $user->tenant_id);
        if ($tenant) {
            $user->clearMediaCollection(User::PROFILE);
            $user->delete();
        }
        $tenant->delete();

        return $this->sendSuccess('User deleted Successfully.');
    }
}
