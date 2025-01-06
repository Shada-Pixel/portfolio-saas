<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Seeder;

class AddDefaultPrefixCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminSetting::create(['key' => 'default_region_code', 'value' => '91', 'type' => AdminSetting::GENERAL]);
        AdminSetting::create(['key' => 'default_region_code_flag', 'value' => 'in', 'type' => AdminSetting::GENERAL]);
    }
}
