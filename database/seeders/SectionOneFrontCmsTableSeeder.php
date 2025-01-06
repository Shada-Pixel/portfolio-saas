<?php

namespace Database\Seeders;

use App\Models\FrontCms;
use Illuminate\Database\Seeder;

class SectionOneFrontCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontCms::create([
            'key' => 'text_title', 'value' => 'I\'M A FREELANCE', 'type' => FrontCms::SECTION_ONE,
        ]);
        FrontCms::create([
            'key' => 'text_main_one', 'value' => 'Developer', 'type' => FrontCms::SECTION_ONE,
        ]);
        FrontCms::create([
            'key' => 'text_main_two', 'value' => 'Designer', 'type' => FrontCms::SECTION_ONE,
        ]);
        FrontCms::create([
            'key' => 'text_main_three', 'value' => '', 'type' => FrontCms::SECTION_ONE,
        ]);
        FrontCms::create([
            'key' => 'text_main_four', 'value' => '', 'type' => FrontCms::SECTION_ONE,
        ]);
        FrontCms::create([
            'key' => 'text_main_five', 'value' => '', 'type' => FrontCms::SECTION_ONE,
        ]);
        FrontCms::create([
            'key'   => 'text_secondary',
            'value' => 'Authoritatively expedite backward-compatible e-commerce with cross-media e-commerce. Credibly provide access to world-class action items through resource-leveling resources.',
            'type'  => FrontCms::SECTION_ONE,
        ]);
    }
}
