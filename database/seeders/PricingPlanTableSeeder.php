<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

class PricingPlanTableSeeder extends Seeder
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
                'name'      => 'Professional Plan',
                'type'      => 1,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::MONTHLY,
            ],
            [
                'name'      => 'Advance Plan',
                'type'      => 2,
                'color'     => $this->getColor(),
                'price'     => 11000,
                'plan_type' => PricingPlan::WEEKLY,
            ],
            [
                'name'      => 'Silver Plan',
                'type'      => 3,
                'color'     => $this->getColor(),
                'price'     => 12000,
                'plan_type' => PricingPlan::YEARLY,
            ],
            [
                'name'      => 'Basic Plan',
                'type'      => 1,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::MONTHLY,
            ],
            [
                'name'      => 'Super Plan',
                'type'      => 2,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::MONTHLY,
            ],
            [
                'name'      => 'Ultra Plan',
                'type'      => 3,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::YEARLY,
            ],
            [
                'name'      => 'Enterprise Plan',
                'type'      => 1,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::YEARLY,
            ],
            [
                'name'      => 'Ultimate Plan',
                'type'      => 2,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::WEEKLY,
            ],
            [
                'name'      => 'Premium Plan',
                'type'      => 2,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::WEEKLY,
            ],
            [
                'name'      => 'Premium Plan',
                'type'      => 2,
                'color'     => $this->getColor(),
                'price'     => 10000,
                'plan_type' => PricingPlan::WEEKLY,
            ],
        ];

        foreach ($input as $data) {
            PricingPlan::create($data);
        }
    }

    public function getColor()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

        return '#'.$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0, 15)].$rand[rand(0,
                15)].$rand[rand(0, 15)];
    }
}
