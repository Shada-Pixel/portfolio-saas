<?php

namespace Database\Seeders;

use App\Models\FrontCms;
use App\Models\SectionThree;
use Illuminate\Database\Seeder;

class SectionThreeFrontCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontCms::create([
            'key'  => 's3_text_title', 'value' => 'What Some of my Clients Say',
            'type' => FrontCms::SECTION_THREE,
        ]);

        FrontCms::create([
            'key'  => 's3_image_main', 'value' => ('/assets/front/images/testi/bg.svg'),
            'type' => FrontCms::SECTION_THREE,
        ]);

        SectionThree::create([
            'slider_text'          => 'Quickly redefine resource sucking web services after exceptional customer service. Professionally coordinate focused platforms before visionary architectures.',
            'image_text'           => 'Peter Parker',
            'image_text_secondary' => 'Kinetic Solutions.',
            'image_url'            => ('/assets/front/images/testi/face.jpg'),
        ]);

        SectionThree::create([
            'slider_text'          => 'Dramatically mesh user friendly solutions whereas sticky human capital. Assertively fashion impactful "outside the box".',
            'image_text'           => 'Mariya Watson',
            'image_text_secondary' => 'Quartz Inc.',
            'image_url'            => ('/assets/front/images/testi/face2.jpg'),
        ]);

        SectionThree::create([
            'slider_text'          => 'Progressively productivate customer directed meta-services without magnetic bandwidth.',
            'image_text'           => 'John Shaine',
            'image_text_secondary' => 'Crystal Pvt Ltd.',
            'image_url'            => ('/assets/front/images/testi/face3.jpg'),
        ]);
    }
}
