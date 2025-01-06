<?php

namespace Database\Seeders;

use App\Models\FrontCms;
use App\Models\SectionFive;
use Illuminate\Database\Seeder;

class SectionFiveFrontCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontCms::create([
            'key'  => 's5_text_title', 'value' => 'A few things clients normally ask me',
            'type' => FrontCms::SECTION_FIVE,
        ]);
        FrontCms::create([
            'key'   => 's5_main_image',
            'value' => ('/assets/front/images/ask.svg'),
            'type'  => FrontCms::SECTION_FIVE,
        ]);

        SectionFive::create([
            'text_main'      => 'Design & Development Process',
            'text_secondary' => 'During the analysis phase, we discover the requirements and constraints for our proposed system. We can hire consultants and interview potential customers in order to gather this critical information.',
        ]);

        SectionFive::create([
            'text_main'      => 'What is Our Refund Policy',
            'text_secondary' => 'Refund policy is exactly as it sounds - a policy that dictates the terms of any refunds or returns which may be offered by the website or eCommerce store. ... Before you make a purchase,',
        ]);

        SectionFive::create([
            'text_main'      => 'Our Processing Time',
            'text_secondary' => 'Processing times tell you how long you can expect it will take us to process an application under normal circumstances.A processing time starts the day we receive an application and ends when we make a decision.',
        ]);

        SectionFive::create([
            'text_main'      => 'How do I Pay and Payment Method',
            'text_secondary' => 'how to add, edit, or remove payment methods you use for Google Play purchases.
For more information about the payment options available, such as credit cards, direct carrier billing, PayPal',
        ]);
    }
}
