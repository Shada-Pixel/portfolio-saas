<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Seeder;

class SocialSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminSetting::create([
            'key' => 'fab fa-facebook', 'value' => 'www.facebook.com/infyom', 'type' => AdminSetting::SOCIAL_SETTING,
        ]);
        AdminSetting::create([
            'key'  => 'fab fa-instagram', 'value' => 'www.instagram.com/infyomtechnologies/',
            'type' => AdminSetting::SOCIAL_SETTING,
        ]);
        AdminSetting::create([
            'key'  => 'fab fa-linkedin-in', 'value' => 'in.linkedin.com/company/infyom-technologies',
            'type' => AdminSetting::SOCIAL_SETTING,
        ]);
        AdminSetting::create([
            'key' => 'fab fa-youtube', 'value' => 'www.youtube.com/channel/UC8IvwfChD6i7Wp4yZp3tNsQ', 'type' => AdminSetting::SOCIAL_SETTING,
        ]);
        AdminSetting::create(['key'  => 'fab fa-skype', 'value' => 'skype:live:infyomtechnologies?chat',
                              'type' => AdminSetting::SOCIAL_SETTING,
        ]);
        AdminSetting::create(['key'  => 'fab fa-twitter', 'value' => 'twitter.com/infyom',
                              'type' => AdminSetting::SOCIAL_SETTING,
        ]);
    }
}
