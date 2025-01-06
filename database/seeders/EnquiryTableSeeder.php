<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use Illuminate\Database\Seeder;

class EnquiryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'first_name'  => 'Rahul',
                'last_name'   => 'Zala',
                'email'       => 'rahul@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'Making a personal portfolio head-turning and engaging enough to attract plenty of target customers is the main task for every creative, and you are probably no exception. Original and eye-catching design',
                'status'      => 1,
            ],
            [
                'first_name'  => 'Jenil',
                'last_name'   => 'Desai',
                'email'       => 'jenil@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'We’ve prepared a fascinating list of different hello messages that creatives use on their portfolios to get more interested clients. Have a look!',
                'status'      => 1,
            ],
            [
                'first_name'  => 'Mital',
                'last_name'   => 'Barad',
                'email'       => 'mital@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'Warm and friendly welcome words will make your portfolio website look more human-like and get people trust you. A brief “hello message” can include a short information of your personality and field of expertise or create a visual interest',
            ],
            [
                'first_name'  => 'Neha',
                'last_name'   => 'Parmar',
                'email'       => 'neha@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'A playsome and positive greeting message from a Polish web studio. It is located on a surface of a wooden bench with a camera, some notebooks, glasses, and other creative attributes.',
            ],
            [
                'first_name'  => 'Mohan',
                'last_name'   => 'Dangariya',
                'email'       => 'mohan@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'A metaphoric greeting message from a Turkish designer and coder wanting to impress visitors and future customers with his genuine way of thinking.',
            ],
            [
                'first_name'  => 'Rakesh',
                'last_name'   => 'Vaghela',
                'email'       => 'rakesh@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'status'      => 1,
                'message'     => ' a UK based designer specializing in print, 3D, digital, illustration, retouching and visualization, photography, video and animation as well as logo and full brand identity.',
            ],
            [
                'first_name'  => 'Sanjay',
                'last_name'   => 'Nakrani',
                'email'       => 'sanjay@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'A simple and informative greeting message from a Swedish digital product designer based in Stockholm. The homepage with greetings is complemented with works examples.',
            ],
            [
                'first_name'  => 'Bhargav',
                'last_name'   => 'Makwana',
                'email'       => 'bhargav@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'A greeting message from a Czech graphic designer unveiling his achievements and offering his potential customers take part in crafting the appearance of his portfolio. He is ready to accept ideas from you and put them into shape.',
            ],
            [
                'first_name'  => 'Het',
                'last_name'   => 'Patel',
                'email'       => 'het@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'a freelance designer based in Athens, Greece. She has located her message on a bright background, so check out the portfolio design and color scheme to make it clear.',
            ],
            [
                'first_name'  => 'Mahi',
                'last_name'   => 'Dangodara',
                'email'       => 'mahi@gmail.com',
                'phone'       => '9879879879',
                'region_code' => '91',
                'message'     => 'The message is complemented with calming green background which looks minimal and stylish.',
            ],
        ];

        foreach ($input as $enquiry) {
            Enquiry::create($enquiry);
        }
    }
}
