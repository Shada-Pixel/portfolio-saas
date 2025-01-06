<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillTableSeeder extends Seeder
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
                'name'       => 'Communication',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Customer service',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Problem-solving',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Time management',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Leadership',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Emotional Intelligence',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Responsibility',
                'percentage' => rand(10, 100),
            ],
            [
                'name'       => 'Data Analysis',
                'percentage' => rand(10, 100),
            ],
        ];

        foreach ($input as $data) {
            Skill::create($data);
        }
    }
}
