<?php

namespace Database\Seeders;

use App\Repositories\TestimonialRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class TestimonialTableSeeder extends Seeder
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
                'name'        => 'Short videos',
                'position'    => 'Video maker',
                'description' => 'A video description is a piece of metadata that helps YouTube understand the content of a video',
            ],
            [
                'name'        => 'Customer interviews',
                'position'    => 'Interviewer',
                'description' => ' Customer interviews are usually conducted one-on-one with an individual customer or with a small number of people from the same business or family unit.',
            ],
            [
                'name'        => 'Social media posts.',
                'position'    => 'Posts',
                'description' => 'Social Media Specialists are responsible for planning, implementing and monitoring the company\'s Social Media strategy in order to increase brand awareness',
            ],
            [
                'name'        => 'Press Reviewer.',
                'position'    => 'Reviewer',
                'description' => 'A press review is a compilation of recent articles and items from various press products',
            ],
            [
                'name'        => 'Case studies and success stories',
                'position'    => 'studying',
                'description' => 'It is Studying the case related and story and,  describe the reality',
            ],
            [
                'name'        => 'Authority',
                'position'    => 'Authority',
                'description' => 'Authority testimonials tend to be expensive to produce and it can be difficult to find the right influencer, but when they succeed, these campaigns can pay dividends for your company over-time.',
            ],
            [
                'name'        => 'Peer Review',
                'position'    => 'Reviewer',
                'description' => 'These reviews should be used as customer testimonials for your business because they can be quickly uploaded and shared to your company website.',
            ],
            [
                'name'        => ' Blog Post',
                'position'    => 'Blogs',
                'description' => 'The post can be written by someone who works for your company or you can hire a guest writer to compose the post. ',
            ],
            [
                'name'        => 'Visually Engaging',
                'position'    => 'Visualizer',
                'description' => 'The best testimonials paint a picture with words so readers can learn exactly what the value of making a purchase from you would be.',
            ],
            [
                'name'        => 'Slack',
                'position'    => 'Slack',
                'description' => 'Slacks customer testimonials are cleverly nested on its product features page -- which might seem confusing, until you realize the choice was deliberate.',
            ],
        ];

        foreach ($input as $key => $value) {
            $testimonial = App::make(TestimonialRepository::class);
            $testimonial->store($input[$key]);
        }
    }
}
