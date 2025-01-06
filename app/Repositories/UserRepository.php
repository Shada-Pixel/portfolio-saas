<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\MultiTenant;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version April 28, 2020, 11:09 am UTC
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
    
    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function changePassword($input)
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            if (! Hash::check($input['password_current'], $user->password)) {
                throw new UnprocessableEntityHttpException("Current password is invalid.");
            }

            $input['password'] = Hash::make($input['password']);
            $user->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getUserCreateData()
    {
        $data['countries'] = Country::toBase()->pluck('name', 'id');
        
        return $data;
    }

    /**
     * @param $input
     * 
     * @return bool
     */
    public function updateProfile($input)
    {
        $user = Auth::user();

        try {
            if (isset($input['photo']) && ! empty($input['photo'])) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($input['photo'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }
            $user->update($input);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param $input
     */
    public function store($input)
    {
        try {
            $tenant = MultiTenant::create(['tenant_username' => $input['user_name']]);
            $input['tenant_id'] = $tenant->id;
            $input['password'] = Hash::make($input['password']);
            if (getLoggedInUser() != null && getLoggedInUser()->hasRole('super_admin')) {
                $input['email_verified_at'] = Carbon::now();
            }
            /** @var User $user */
            $user = User::create($input);
            $adminRole = Role::whereName('admin')->first();
            $user->assignRole($adminRole);

            $companyLogoUrl = asset('assets/img/infyom-logo.png');
            $contactUsText = 'Overall, we feel that having an easy-to-use contact form looks more professional and put together on a contact us page than just an email.Think about it: When you really need to contact support';

            $setting = [
                [
                    'key'        => 'company_name', 'value' => 'InfyomLabs', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'website', 'value' => 'https://www.infyom.com/', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'phone', 'value' => '9876543210', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'region_code', 'value' => '91', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'company_email', 'value' => 'infyportfolio@gmail.com', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'address', 'value' => '16/A saint Joseph Park/', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'company_logo', 'value' => $companyLogoUrl, 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'contact_us', 'value' => $contactUsText, 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'region_code_flag', 'value' => 'in', 'type' => Setting::GENERAL,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'fab fa-facebook', 'value' => null, 'type' => Setting::SOCIAL_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'fab fa-instagram', 'value' => null,
                    'type'       => Setting::SOCIAL_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'fab fa-linkedin-in', 'value' => null,
                    'type'       => Setting::SOCIAL_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'fab fa-pinterest', 'value' => null,
                    'type'       => Setting::SOCIAL_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'fab fa-skype', 'value' => null, 'type' => Setting::SOCIAL_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'fab fa-twitter', 'value' => null, 'type' => Setting::SOCIAL_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
                [
                    'key'        => 'theme_layout', 'value' => Setting::TEMPLATE_ONE, 'type' => Setting::THEME_SETTING,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'tenant_id' => $tenant->id,
                ],
            ];
            Setting::insert($setting);
            $subscription = [
                'user_id'    => $user->id,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now()->addDays(6),
                'status'     => 1,
            ];
            Subscription::create($subscription);

            if (getLoggedInUser() == null || ! getLoggedInUser()->hasRole('super_admin')) {
                $user->sendEmailVerificationNotification();
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  User  $user
     *
     * @return bool
     */
    public function updateUser($input, $user)
    {
        return $user->update($input);
    }
}
