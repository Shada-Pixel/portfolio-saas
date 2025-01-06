<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyLogoUrl = ('assets/img/infyom-logo.png');
        $faviconUrl = ('img/favicon-32x32.png');
        $contactUsText = 'Overall, we feel that having an easy-to-use contact form looks more professional and put together on a contact us page than just an email.Think about it: When you really need to contact support';

        AdminSetting::create(['key' => 'company_name', 'value' => 'InfyOmLabs', 'type' => AdminSetting::GENERAL]);
        AdminSetting::create([
            'key' => 'website', 'value' => 'https://www.infyom.com/', 'type' => AdminSetting::GENERAL,
        ]);
        AdminSetting::create(['key' => 'phone', 'value' => '9876543210', 'type' => AdminSetting::GENERAL]);
        AdminSetting::create(['key' => 'region_code', 'value' => '91', 'type' => AdminSetting::GENERAL]);
        AdminSetting::create([
            'key'  => 'company_email', 'value' => 'infyportfolio@gmail.com',
            'type' => AdminSetting::GENERAL,
        ]);
        AdminSetting::create([
            'key' => 'address', 'value' => '16/A saint Joseph Park/', 'type' => AdminSetting::GENERAL,
        ]);
        AdminSetting::create(['key' => 'company_logo', 'value' => $companyLogoUrl, 'type' => AdminSetting::GENERAL]);
        AdminSetting::create(['key' => 'favicon', 'value' => $faviconUrl, 'type' => AdminSetting::GENERAL]);
        AdminSetting::create(['key' => 'contact_us', 'value' => $contactUsText, 'type' => AdminSetting::GENERAL]);
        AdminSetting::create(['key' => 'region_code_flag', 'value' => 'in', 'type' => AdminSetting::GENERAL]);
        AdminSetting::create(['key' => 'contact_email', 'value' => 'user@gmail.com', 'type' => AdminSetting::GENERAL]);
        $termsAndConditions = view('privacy.terms_conditions')->render();
        AdminSetting::create([
            'key'  => 'terms_conditions', 'value' => $termsAndConditions,
            'type' => AdminSetting::PRIVACY_SETTING,
        ]);
        $privacyPolicy = view('privacy.privacy_policy')->render();
        AdminSetting::create([
            'key'  => 'privacy_policy', 'value' => $privacyPolicy,
            'type' => AdminSetting::PRIVACY_SETTING,
        ]);
    }
}
