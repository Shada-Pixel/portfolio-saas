<?php

namespace Database\Seeders;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class BlogCategoryTableSeeder extends Seeder
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
                'name'        => 'Fashion',
                'slug'        => 'fashion',
                'description' => 'When you have a passion for something, you want to share it with the world. Whether it is a passion for science, tech, health, fitness, or marketing, blogging is an excellent way to share that passion.',
            ],
            [
                'name'        => 'Travel',
                'slug'        => 'travel',
                'description' => 'You sit down. You stare at your screen. The cursor blinks. So do you. Anxiety sets in. Where do you begin when you want to create an article that will earn you clicks, comments, and social shares',
            ],
            [
                'name'        => 'Music',
                'slug'        => 'music',
                'description' => 'Through Global Music Project\'s Musical Instrument Donation Program, we provide instruments to underprivileged adults and children around the world.',
            ],
            [
                'name'        => 'Lifestyle',
                'slug'        => 'lifestyle',
                'description' => 'A lifestyle blog is best defined as a digital content representation of its author’s everyday life and interests.',
            ],
            [
                'name'        => 'Fitness',
                'slug'        => 'fitness',
                'description' => 'Think of mindfulness meditation as a brain gym. It is literally training your brain to be in the present moment, by focusing on your anchor point, which, for most people, is their breath.',
            ],
            [
                'name'        => 'DIY',
                'slug'        => 'diy',
                'description' => 'After much review and debate via Zoom teleconference, the Board of Directors has decided on the Community Manager position...and there\'s a twist! After a lot of deliberation.',
            ],
            [
                'name'        => 'Sports',
                'slug'        => 'sports',
                'description' => 'Sports bloggers are responsible for keeping fans up-to-date with the latest developments and feature news stories about their favorite sports teams. Most sports bloggers choose a specific niche to write about a specific team or sport throughout that season.',
            ],
            [
                'name'        => 'Finance',
                'slug'        => 'finance',
                'description' => 'An online journal (or web log) that provides news and information related to the finance industry',
            ],
            [
                'name'        => 'Political',
                'slug'        => 'political',
                'description' => 'Rachel Brulé is an assistant professor of Global Development Policy at Boston University. Her recent book Women, Power and Property-The Paradox of Gender Equality Laws in India “documents her exploration of the links between political representation and economic empowerment.',
            ],
            [
                'name'        => 'Blogger Diaries',
                'slug'        => 'blogger-diaries',
                'description' => 'Author\'s Note: The Blogger Diaries Trilogy is the true story of how I met, fell for, lost, and got a second chance at love with my soul mate. ... Every second of this trilogy is true, exactly as it happened.',
            ],
        ];

        foreach ($input as $key => $value) {
            $categories = App::make(CategoryRepository::class);
            $categories->store($input[$key]);
        }
    }
}
