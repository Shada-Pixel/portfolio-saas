<?php

namespace Database\Seeders;

use App\Models\HireRequest;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Input\Input;

class HireRequestTableSeeder extends Seeder
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
                'name'          => 'meet',
                'email'         => 'meet@gmail.com',
                'company_name'  => 'Reliance Industries Ltd.',
                'interested_in' => 'employee',
                'mobile'        => '9898121287',
                'budget'        => '10000',
                'region_code'   => 91,
                'message'       => 'Reliance Industries Limited (RIL) is an Indian multinational conglomerate company headquartered in Mumbai, India. Reliance owns businesses across India engaged in energy, petrochemicals, textiles, natural resources, retail, and telecommunications.',
            ],
            [
                'name'          => 'nihal',
                'email'         => 'nihal@gmail.com',
                'mobile'        => '7898121287',
                'company_name'  => 'Tata Consultancy Services Ltd. NSE: TCS.',
                'interested_in' => 'salesman',
                'budget'        => '12000',
                'region_code'   => 91,
                'message'       => 'Sales Officers are executives that work with companies’ sales teams to determine the best strategies to increase customer purchases. ',
            ],
            [
                'name'          => 'Yash',
                'email'         => 'yash@gmail.com',
                'mobile'        => '9498121287',
                'company_name'  => 'HDFC Bank Ltd',
                'interested_in' => 'Accountant',
                'budget'        => '13000',
                'region_code'   => 91,
                'message'       => 'Accountant responsibilities include auditing financial documents and procedures, reconciling bank statements and calculating tax payments and returns.',
            ],
            [
                'name'          => 'Ravi',
                'email'         => 'ravi@gmail.com',
                'mobile'        => '9098121287',
                'company_name'  => 'Infosys Ltd',
                'interested_in' => 'Auditor',
                'budget'        => '11000',
                'region_code'   => 91,
                'message'       => 'Coordinating online or print publishing cycle and managing content areas. Setting publication standards and establishing goals',
            ],
            [
                'name'          => 'Ketan',
                'email'         => 'Ketan@gmail.com',
                'mobile'        => '9498121287',
                'company_name'  => 'Hindustan Unilever Ltd',
                'interested_in' => 'Marketing',
                'budget'        => '13500',
                'region_code'   => 91,
                'message'       => 'Marketing is the activity, set of institutions, and processes for creating, communicating, delivering, and exchanging offerings that have value for customers, clients, partners, and society at large.',
            ],
            [
                'name'          => 'Tushar',
                'email'         => 'tushar@gmail.com',
                'mobile'        => '9598121287',
                'company_name'  => 'Housing Development Finance Corporation Ltd',
                'interested_in' => 'Developing',
                'budget'        => '15000',
                'region_code'   => 91,
                'message'       => 'adjective. undergoing development; growing; evolving. (of a nation or geographical area) having a standard of living or level of industrial production well below that possible with financial or technical aid; not yet highly industrialized: the developing world.',
            ],
            [
                'name'          => 'Usha',
                'email'         => 'usha@gmail.com',
                'mobile'        => '7798121287',
                'company_name'  => 'ICICI Bank Ltd.',
                'interested_in' => 'Assistant',
                'budget'        => '14000',
                'region_code'   => 91,
                'message'       => 'acting as a first point of contact: dealing with correspondence and phone calls. managing diaries and organising meetings and appointments, often controlling access to the manager/executive',
            ],
            [
                'name'          => 'Mitesh',
                'email'         => 'mitesh@gmail.com',
                'mobile'        => '8898121287',
                'company_name'  => 'JSW Steel Ltd',
                'interested_in' => 'Worker',
                'budget'        => '12000',
                'region_code'   => 91,
                'message'       => 'A production worker is responsible for operating and maintaining equipment in a factory or warehouse and preparing items for distribution. /executive',
            ],
            [
                'name'          => 'Mahesh',
                'email'         => 'mahesh@gmail.com',
                'mobile'        => '9798121287',
                'company_name'  => 'Vedanta Ltd',
                'interested_in' => 'Designer',
                'budget'        => '13000',
                'region_code'   => 91,
                'message'       => 'A designer plays a key role in a creative company. Using elements like typography, illustration, photography and layouts, a designer always has an extremely creative mind that can absorb visual trends and deploy them in fresh and exciting ways',
            ],
            [
                'name'          => 'Vaishali',
                'email'         => 'Vaishali@gmail.com',
                'mobile'        => '8798121287',
                'company_name'  => 'Shree Cement Ltd',
                'interested_in' => 'writer',
                'budget'        => '16000',
                'region_code'   => 91,
                'message'       => 'When writing descriptions that include features and benefits, keep in mind the following: You don\'t have to list benefits of every feature. ',
            ],
        ];
        foreach ($input as $hireRequests) {
            HireRequest::create($hireRequests);
        }
    }
}
