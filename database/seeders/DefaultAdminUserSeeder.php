<?php

namespace Database\Seeders;

use App\Models\MultiTenant;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = MultiTenant::create(['tenant_username' => 'default-admin-user']);
        $userExists = User::whereEmail('admin@infyportfolio.com')->exists();
        $superAdminRole = Role::whereName('super_admin')->first();

        if ($userExists) {
            $deleteUser = User::whereEmail('admin@infyportfolio.com')->delete();
        }

        $input = [
            'first_name'              => 'Super',
            'last_name'               => 'Admin',
            'email'                   => 'admin@infyportfolio.com',
            'email_verified_at'       => Carbon::now(),
            'password'                => Hash::make('123456'),
            'region_code'             => '91',
            'phone'                   => '9632587410',
            'dob'                     => now()->addYears(-28),
//            'available_as_freelancer' => true,
//            'experience'              => 1,
            'tenant_id'               => $tenant->id,
            'job_title'               => 'PHP Developer',
            'about_me'                => 'Super Admin is a director of brand marketing, with experience managing global teams and multi-million-dollar campaigns. Her background in brand strategy, visual design, and account management inform her mindful but competitive approach. Madison is fueled by her passion for understanding the nuances of cross-cultural advertising. She considers herself a ‘forever student,’ eager to both build on her academic foundations in psychology and sociology and stay in tune with the latest digital marketing strategies through continued coursework.',
            'country_id'              => 101,
            'state_id'                => 12,
            'city_id'                 => 1041,
            'user_name'               => 'admin',
        ];
        $user = User::create($input);
        $user->assignRole($superAdminRole);
    }
}
