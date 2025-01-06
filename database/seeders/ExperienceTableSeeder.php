<?php

namespace Database\Seeders;

use App\Repositories\ExperienceRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ExperienceTableSeeder extends Seeder
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
                'job_title'           => 'Marketing Coordinator',
                'company'             => 'Beyond Big Marketing.',
                'country_id'          => 101,
                'state_id'            => 12,
                'city_id'             => 862,
                'start_date'          => '2021-05-08',
                'currently_work_here' => 1,
            ],
            [
                'job_title'           => 'President of Sales.',
                'company'             => 'Tik Talk Marketing.',
                'country_id'          => 101,
                'state_id'            => 12,
                'city_id'             => 870,
                'start_date'          => '2021-05-07',
                'end_date'            => '23021-06-09',
                'currently_work_here' => 0,
            ],
            [
                'job_title'           => 'Product Manager',
                'company'             => 'It Sector',
                'country_id'          => 101,
                'state_id'            => 11,
                'city_id'             => 713,
                'start_date'          => '2021-07-08',
                'end_date'            => '23021-08-08',
                'currently_work_here' => 0,
            ],
            [
                'job_title'           => 'Hr',
                'company'             => 'HCL Technologies',
                'country_id'          => 101,
                'state_id'            => 10,
                'city_id'             => 706,
                'start_date'          => '2021-09-08',
                'end_date'            => '23021-10-08',
                'currently_work_here' => 0,
            ],
            [
                'job_title'           => 'Tester',
                'company'             => 'Rk InfoTeach',
                'country_id'          => 101,
                'state_id'            => 11,
                'city_id'             => 712,
                'start_date'          => '2021-11-09',
                'currently_work_here' => 1,
            ],
            [
                'job_title'           => 'Librarian',
                'company'             => 'University of Washington Libraries',
                'country_id'          => 101,
                'state_id'            => 16,
                'city_id'             => 1460,
                'start_date'          => '2021-05-08',
                'currently_work_here' => 1,
            ],
            [
                'job_title'           => 'Information security manager',
                'company'             => 'Tech Mahindra Ltd',
                'country_id'          => 101,
                'state_id'            => 16,
                'city_id'             => 1457,
                'start_date'          => '2021-05-01',
                'currently_work_here' => 1,
            ],
            [
                'job_title'           => 'Developer',
                'company'             => 'Larsen & Toubro Infotech Ltd',
                'country_id'          => 101,
                'state_id'            => 11,
                'city_id'             => 735,
                'start_date'          => '2021-05-02',
                'end_date'            => '23021-09-07',
                'currently_work_here' => 0,
            ],
            [
                'job_title'           => 'Account Executive',
                'company'             => 'All-in-One Financial Solutions.',
                'country_id'          => 101,
                'state_id'            => 11,
                'city_id'             => 778,
                'start_date'          => '2021-06-08',
                'end_date'            => '23021-07-08',
                'currently_work_here' => 0,
            ],
            [
                'job_title'           => 'Nursing Assistant',
                'company'             => 'BAYADA Home Health Care',
                'country_id'          => 101,
                'state_id'            => 12,
                'city_id'             => 787,
                'start_date'          => '2021-03-12',
                'currently_work_here' => 1,
            ],
        ];

        foreach ($input as $key => $value) {
            $experience = App::make(ExperienceRepository::class);
            $experience->create($input[$key]);
        }
    }
}
