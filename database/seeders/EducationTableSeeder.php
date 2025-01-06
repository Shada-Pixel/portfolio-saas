<?php

namespace Database\Seeders;

use App\Repositories\EducationRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class EducationTableSeeder extends Seeder
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
                'school_name'             => 'Saradar Patel High School',
                'qualification'           => 10,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 1011,
                'start_date'              => '2021-03-15',
                'currently_studying_here' => 1,
            ],
            [
                'school_name'             => 'Cm Vidyalay',
                'qualification'           => 12,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 996,
                'start_date'              => '2021-04-12',
                'end_date'                => '2021-09-18',
                'currently_studying_here' => 0,
            ],
            [
                'school_name'             => 'L.p. Savani International',
                'qualification'           => 10,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 1041,
                'start_date'              => '2021-02-15',
                'currently_studying_here' => 1,
            ],
            [
                'school_name'             => 'Naimisharanya School',
                'qualification'           => 8,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 821,
                'start_date'              => '2021-07-15',
                'currently_studying_here' => 1,
            ],
            [
                'school_name'             => 'Bhartiya Public School',
                'qualification'           => 8,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 1033,
                'start_date'              => '2021-07-15',
                'currently_studying_here' => 1,
            ],
            [
                'school_name'             => 'Ameeniya High school',
                'qualification'           => 10,
                'country_id'              => 101,
                'state_id'                => 11,
                'city_id'                 => 717,
                'start_date'              => '2021-04-20',
                'end_date'                => '2021-09-18',
                'currently_studying_here' => 0,
            ],
            [
                'school_name'             => 'Palitana High Shcool Palitana',
                'qualification'           => 8,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 996,
                'start_date'              => '2021-06-10',
                'end_date'                => '2021-08-17',
                'currently_studying_here' => 0,
            ],
            [
                'school_name'             => 'Ryan International School',
                'qualification'           => 10,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 1041,
                'start_date'              => '2021-02-25',
                'currently_studying_here' => 1,
            ],
            [
                'school_name'             => 'LockBharti High School',
                'qualification'           => 12,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 822,
                'start_date'              => '2021-07-15',
                'end_date'                => '2021-09-18',
                'currently_studying_here' => 0,
            ],
            [
                'school_name'             => 'K.V.P School',
                'qualification'           => 8,
                'country_id'              => 101,
                'state_id'                => 12,
                'city_id'                 => 889,
                'start_date'              => '2021-07-15',
                'currently_studying_here' => 1,
            ],
        ];

        foreach ($input as $key => $value) {
            $education = App::make(EducationRepository::class);
            $education->create($input[$key]);
        }
    }
}
