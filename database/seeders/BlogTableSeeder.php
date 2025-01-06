<?php

namespace Database\Seeders;

use App\Repositories\BlogRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class BlogTableSeeder extends Seeder
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
                'title'       => 'Administrative Assistant.',
                'slug'        => 'administrative-assistant',
                'description' => 'Answers phone calls, schedules meetings and supports visitors. Carries out administrative duties such as filing, typing, copying, binding, scanning etc.',
                'category_id' => 1,
            ],
            [
                'title'       => 'Receptionist',
                'slug'        => 'receptionist',
                'description' => 'Diary management and management of meeting rooms. Possibly handling event coordination, both internally and externally. ',
                'category_id' => 2,
            ],
            [
                'title'       => 'Office Manager.',
                'slug'        => 'office-manager',
                'description' => 'Office managers are responsible for keeping an office running smoothly and overseeing administrative support. ... The job can range widely in duties and responsibilities, from reception',
                'category_id' => 3,
            ],
            [
                'title'       => 'Auditing Clerk.',
                'slug'        => 'auditing-clerk',
                'description' => 'Verifying records and financial statements created by other employees. Reviewing accounting records and financial data to check for accuracy.',
                'category_id' => 4,
            ],
            [
                'title'       => 'Bookkeeper',
                'slug'        => 'bookkeeper',
                'description' => 'A Bookkeeper job description generally includes: Recording transactions such as income and outgoings, and posting them to various accounts. Processing payments. ',
                'category_id' => 5,
            ],
            [
                'title'       => 'Account Executive.',
                'slug'        => 'account-executive',
                'description' => 'Meeting clients to discuss their advertising needs. ... Presenting campaign ideas and costings to clients',
                'category_id' => 6,
            ],
            [
                'title'       => 'Branch Manager.',
                'slug'        => 'branch-manager',
                'description' => 'Meeting clients to discuss their advertising needs. ... Presenting campaign ideas and costings to clients',
                'category_id' => 7,
            ],
            [
                'title'       => 'Business Manager.',
                'slug'        => 'business-manager',
                'description' => 'The role of a Business Manager is to supervise and lead a company\'s operations and employees. They perform a range of tasks to ensure company productivity and efficiency including implementing business strategies, evaluating company performances, and supervising employees',
                'category_id' => 8,
            ],
            [
                'title'       => 'Project Manager',
                'slug'        => 'project-manager',
                'description' => 'The Project Manager manages key client projects. Project management responsibilities include the coordination and completion of projects on time within budget and within scope',
                'category_id' => 9,
            ],
            [
                'title'       => 'Daily Dose',
                'slug'        => 'daily-dose',
                'description' => 'DDDs are only assigned for medicines given an ATC codes. The DDDs are allocated to drugs by the WHO Collaborating Centre in Oslo, working in close association with the WHO International Working Group on Drug Statistics Methodology.',
                'category_id' => 10,
            ],
        ];

        foreach ($input as $key => $value) {
            $blogs = App::make(BlogRepository::class);
            $blogs->store($input[$key], false);
        }
    }
}
