<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
        $this->call(DefaultCountriesSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DefaultAdminUserSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(SocialSettingTableSeeder::class);
        $this->call(SectionOneFrontCmsTableSeeder::class);
        $this->call(SectionTwoFrontCmsTableSeeder::class);
        $this->call(SectionFourFrontCmsTableSeeder::class);
        $this->call(SectionThreeFrontCmsTableSeeder::class);
        $this->call(SectionFiveFrontCmsTableSeeder::class);
        $this->call(SectionSixFrontCmsTableSeeder::class);
        $this->call(AddDefaultPrefixCodeSeeder::class);
        $this->call(CurrencySeeder::class);
//        $this->call(ExperienceTableSeeder::class);
//        $this->call(EducationTableSeeder::class);
//        $this->call(SkillTableSeeder::class);
//        $this->call(PricingPlanTableSeeder::class);
//        $this->call(TestimonialTableSeeder::class);
//        $this->call(PlanAttributeTableSeeder::class);
//        $this->call(EnquiryTableSeeder::class);
//        $this->call(AboutMeTableSeeder::class);
//        $this->call(ServiceTableSeeder::class);
//        $this->call(RecentWorkTypeTableSeeder::class);
//        $this->call(RecentWorkTableSeeder::class);
//        $this->call(BlogCategoryTableSeeder::class);
//        $this->call(BlogTableSeeder::class);
//        $this->call(HireRequestTableSeeder::class);
    }
}
