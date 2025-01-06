<?php

namespace Database\Seeders;

use App\Repositories\RecentWorkRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class RecentWorkTableSeeder extends Seeder
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
                'type_id'   => 1,
                'title'     => 'Accountant',
                'link'      => 'https://www.investopedia.com ',
            ],
            [
                'type_id'   => 1,
                'title'     => 'Doctor',
                'link'      => 'https://in.searchley.com',
            ],
            [
                'type_id'   => 2,
                'title'     => 'Financial Advisor',
                'link'      => 'https://www.cfainstitute.org',
            ],
            [
                'type_id'   => 2,
                'title'     => 'Government Jobs',
                'link'      => 'https://www.sarthakindia.org',
            ],
            [
                'type_id'   => 2,
                'title'     => 'Lawyer',
                'link'      => 'https://www.justdial.com ',
            ],
            [
                'type_id'   => 3,
                'title'     => 'Human Resources',
                'link'      => 'https://www.investopedia.com ',
            ],
            [
                'type_id'   => 3,
                'title'     => 'Back End Developer',
                'link'      => 'https://www.toptal.com',
            ],
            [
                'type_id'   => 4,
                'title'     => 'Programmer',
                'link'      => 'https://www.cognizant.com',
            ],
            [
                'type_id'   => 5,
                'title'     => 'Web Developer',
                'link'      => 'https://www.computerscience.org ',
            ],
            [
                'type_id'   => 5,
                'title'     => 'Advertising',
                'link'      => 'https://economictimes.indiatimes.com',
            ],
        ];

        foreach ($input as $key=> $value) {
            $recentWork = App::make(RecentWorkRepository::class);
            $recentWork->store($input[$key]);
        }
    }
}
