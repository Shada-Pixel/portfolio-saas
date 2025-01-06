<?php

namespace Database\Seeders;


use App\Repositories\AchievementRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class AboutMeTableSeeder extends Seeder
{
    public function getIcon()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g');

        return '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                15)].$rand[rand(0, 15)];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'title'             => 'Identified problem',
                'short_description' => 'If your desk is messy, it will distract you from your work and reflect poorly on you at the same time.',
                'icon'              => 'fab fa-algolia',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Re-organized something',
                'short_description' => 'People tend to do three things when faced with a problem',
                'icon'              => 'fas fa-address-book',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Come with  new',
                'short_description' => 'Over the years, I have come up with a number of ways to keep my creative muscle active.',
                'icon'              => 'fas fa-adjust',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Developed or implemented',
                'short_description' => 'Most processes touch multiple departments.',
                'icon'              => 'fas fa-align-left',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Worked on special projects',
                'short_description' => 'One of the struggles any company faces  talent to help propel the organization to success.',
                'icon'              => 'fas fa-asterisk',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Received awards',
                'short_description' => 'Comparably – Best Companies for Best Global Culture, Best Teams Product ',
                'icon'              => 'fas fa-birthday-cake',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Been complimented',
                'short_description' => 'Still, there are compliments you give your friends.',
                'icon'              => 'fas fa-air-freshener',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Increased revenue or sales',
                'short_description' => 'An obvious way to improve sales and boost revenue is through marketing.',
                'icon'              => 'fas fa-cog',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Saved time',
                'short_description' => 'Moving to a four day work can translate to huge savings for your company. ',
                'icon'              => 'fab fa-app-store',
                'color'             => $this->getIcon(),
            ],
            [
                'title'             => 'Contributed customer service',
                'short_description' => 'The key to good customer service is building good relationships with your customers. ',
                'icon'              => 'fas fa-life-ring',
                'color'             => $this->getIcon(),
            ],
        ];
        
        foreach ($input as $key => $value) {
            $achievements = App::make(AchievementRepository::class);
            $achievements->store($input[$key]);
        }
    }
}
