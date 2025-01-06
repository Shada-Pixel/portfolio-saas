<?php

namespace Database\Seeders;

use App\Repositories\RecentWorkTypeRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class RecentWorkTypeTableSeeder extends Seeder
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
                'name'      => 'Accountant',
            ],

            [
                'name'      => 'Doctor',
            ],
            [
                'name'      => 'Financial Advisor',
            ],
            [
                'name'      => 'Government Jobs',
            ],
            [
                'name'      => 'Lawyer',
            ],
            [
                'name'      => 'Human Resources',
            ],
            [
                'name'      => 'Back End Developer',
            ],
            [
                'name'      => 'Programmer',
            ],
            [
                'name'      => 'Web Developer',
            ],
            [
                'name'      => 'Advertising',
            ],
        ];

        foreach ($input as $key => $value) {
            $recentWorkType = App::make(RecentWorkTypeRepository::class);
            $recentWorkType->store($input[$key]);
        }
    }
}
