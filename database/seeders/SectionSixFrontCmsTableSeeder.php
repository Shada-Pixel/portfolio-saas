<?php

namespace Database\Seeders;

use App\Models\FrontCms;
use Illuminate\Database\Seeder;

class SectionSixFrontCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FrontCms::create([
            'key' => 's6_text_title', 'value' => 'Got a Project?Let\'s Talk!', 'type' => FrontCms::SECTION_SIX,
        ]);
        FrontCms::create([
            'key' => 's6_text_secondary', 'value' => 'We’re eager to hear your idea and help you realize it!', 'type' => FrontCms::SECTION_SIX,
        ]);
    }
}
