<?php

namespace Database\Seeders;

use App\Repositories\ServiceRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $input = [
            [
                'name'        => 'Client Creation.',
                'description' => 'Creating a campaign to reach the right target audience can be the biggest challenge for customers. Marketing initiatives need to be focused and targeted appropriately to gain maximum mileage. For clients to engage in target-specific campaigns and ensure they are fitting and properly-focused - data is the lifeline.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],

            ],
            [
                'name'        => 'Extra Assistance.',
                'description' => 'Today, the Department is issuing guidance regarding the use of funds received under the Higher Education Emergency Relief Fund (HEERF) grant program. The new HEERF guidance reflects a change in the Department\'s prior position, which previously only allowed funds received under the Coronavirus Response and Relief Supplemental Appropriations Act, 2021 (CRRSAA), to be used for costs incurred on or after Dec. 27, 2020, the date of the enactment of the CRRSAA.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],

            ],
            [
                'name'        => 'Efficient Operation.',
                'description' => 'Operational efficiency is primarily a metric that measures the efficiency of profit earned as a function of operating costs. The greater the operational efficiency, the more profitable a firm or investment is. This is because the entity is able to generate greater income or returns for the same or lower cost than an alternative.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],

            ],
            [
                'name'        => 'Man with a Plan.',
                'description' => 'A Man with a Plan is a fully insured professional gardening/landscaping service located in the Bayside area. We have tendered many gardens area over the years, undertaking all aspects of gardening work to an exceptionally high standard. We pride ourselves on providing a prompt, high quality service.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
            [
                'name'        => 'Effective Efficiency.',
                'description' => 'The aim of this paper is to propose a mathematical programming technique referred to as Hyperbolic Network Data Envelopment Analysis (HNDEA) to appraise service performance in a service industry. International tourist hotels in Taiwan are used as an example to illustrate the process. ',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
            [
                'name'        => 'Dream Service.',
                'description' => 'Extend this class to implement a custom dream (available to the user as a "Daydream").
Dreams are interactive screensavers launched when a charging device is idle, or docked in a desk dock. Dreams provide another modality for apps to express themselves, tailored for an exhibition/lean-back experience.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
            [
                'name'        => 'Flutes & Finesse',
                'description' => 'We use cookies and similar tools to enhance your shopping experience, to provide our services, understand how customers use our services so we can make improvements, and display ads, including interest-based ads. Approved third parties also use these tools in connection with our display of ads. If you do not want to accept all cookies or would like to learn more about how we use cookies, click "Customise cookies".',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
            [
                'name'        => 'Binary Services',
                'description' => 'Binary Services is a small versatile IT solutions company that provides design, engineering and sustainment for Information Technology Systems. Drawing from our diverse experience supporting defense and corporate technology systems, we have become a trusted IT solutions provider.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
            [
                'name'        => 'Corporate Business Services',
                'description' => 'Corporate services are activities that combine or consolidate certain enterprise-wide needed support services, provided based on specialized knowledge, best practices, and technology to serve internal (and sometimes external) customers and business partners. The term corporate services providers (CSPs) is also used.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
            [
                'name'        => 'Turning Point Services',
                'description' => 'Turning Point Services Ltd. operates as a non-profit social care organization. The Company provides services to meet the needs of people with drug or alcohol problems, mental health issues, and learning disabilities. Turning Point serves the needs of individuals, families, and communities across England and Wales.',
                'color'       => '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                        15)].$rand[rand(0,
                        15)].$rand[rand(0, 15)],
            ],
        ];

        foreach ($input as $key => $value) {
            $services = App::make(ServiceRepository::class);
            $services->store($input[$key]);
        }
    }
}
