<?php

namespace Database\Seeders;

use App\Models\FrontCms;
use App\Models\SectionFour;
use Illuminate\Database\Seeder;

class SectionFourFrontCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontCms::create([
            'key'  => 's4_text_title', 'value' => 'The ways I can help you',
            'type' => FrontCms::SECTION_FOUR,
        ]);
        
        FrontCms::create([
            'key'   => 's4_text_secondary',
            'value' => 'If you want others to be happy, practice compassion. If you want to be happy, practice compassion.',
            'type'  => FrontCms::SECTION_FOUR,
        ]);
        
        SectionFour::create([
            'image_url'              => ('/assets/front/images/icons/xd.png'),
            'image_text'             => 'Create Website',
            'image_text_description' => 'Objectively productivate interoperable process improvements after team building testing procedures. Distinctively architect resource-leveling portals.',
            'color'                  => '#E2E8D8',
        ]);
        SectionFour::create([
            'image_url'              => ('/assets/front/images/icons/wp.png'),
            'image_text'             => 'Website Design',
            'image_text_description' => 'Objectively productivate interoperable process improvements after team building testing procedures. Distinctively architect resource-leveling portals.',
            'color'                  => '#C2DFEC',
        ]);
        SectionFour::create([
            'image_url'              => ('/assets/front/images/icons/wp.png'),
            'image_text'             => 'Responsive Website',
            'image_text_description' => 'Objectively productivate interoperable process improvements after team building testing procedures. Distinctively architect resource-leveling portals.',
            'color'                  => '#FADCE4',
        ]);
        SectionFour::create([
            'image_url'              => ('/assets/front/images/icons/wp.png'),
            'image_text'             => 'WordPress Website',
            'image_text_description' => 'Objectively productivate interoperable process improvements after team building testing procedures. Distinctively architect resource-leveling portals.',
            'color'                  => '#E4E4E4',
        ]);
        SectionFour::create([
            'image_url'              => ('/assets/front/images/icons/wp.png'),
            'image_text'             => 'SEO Optimised',
            'image_text_description' => 'Objectively productivate interoperable process improvements after team building testing procedures. Distinctively architect resource-leveling portals.',
            'color'                  => '#E5E3CE',
        ]); 
        SectionFour::create([
            'image_url'              => ('/assets/front/images/icons/hosting.svg'),
            'image_text'             => 'Web Hosting',
            'image_text_description' => 'Objectively productivate interoperable process improvements after team building testing procedures. Distinctively architect resource-leveling portals.',
            'color'                  => '#C9D6CF',
        ]);
    }
}
