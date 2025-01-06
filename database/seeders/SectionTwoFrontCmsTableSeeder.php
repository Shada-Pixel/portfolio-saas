<?php

namespace Database\Seeders;

use App\Models\FrontCms;
use Illuminate\Database\Seeder;

class SectionTwoFrontCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontCms::create([
            'key'  => 's2_text_title', 'value' => 'Graphics Designer and Frontend Developer.',
            'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key'   => 's2_text_secondary',
            'value' => 'Design is the intermediary between information and understanding. Every great developer you know got there by solving problems they were unqualified to solve until they actually did it.',
            'type'  => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_link_one_text', 'value' => '#dribbble', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_link_one_link', 'value' => 'https://dribbble.com/', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_link_two_text', 'value' => '#behance', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_link_two_link', 'value' => 'https://www.behance.net/', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_counter_one_value', 'value' => '15', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_counter_one_text', 'value' => '+ Years Of Experience.', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_counter_two_value', 'value' => '83', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_counter_two_text', 'value' => '% of Works Completed.', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_counter_three_value', 'value' => '100', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key' => 's2_counter_three_text', 'value' => '% Satisfied Customers.', 'type' => FrontCms::SECTION_TWO,
        ]);
        FrontCms::create([
            'key'  => 's2_background_image', 'value' => ('/assets/front/images/me.jpg'),
            'type' => FrontCms::SECTION_TWO,
        ]);
    }
}
