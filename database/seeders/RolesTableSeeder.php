<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name'         => 'super_admin',
                'display_name' => 'Super Admin',
                'description'  => 'Super Admin role name',
            ],
            [
                'name'         => 'admin',
                'display_name' => 'Admin',
                'description'  => 'Admin role name',
            ],
        ];

        foreach ($input as $value) {
            Role::create($value);
        }
    }
}
