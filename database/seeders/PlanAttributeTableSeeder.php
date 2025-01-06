<?php

namespace Database\Seeders;

use App\Models\PlanAttribute;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PlanAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        $input = [
            [
                'pricing_plan_id' => 1,
                'attribute_icon'  => 'fab fa-algolia',
                'attribute_name'  => '1 PSD with font',
            ],
            [
                'pricing_plan_id' => 1,
                'attribute_icon'  => 'fas fa-address-book',
                'attribute_name'  => '30 Day trail',
            ],
            [
                'pricing_plan_id' => 1,
                'attribute_icon'  => 'fas fa-adjust',
                'attribute_name'  => 'Sale after service',
            ],
            [
                'pricing_plan_id' => 2,
                'attribute_icon'  => 'fas fa-align-left',
                'attribute_name'  => '5 PSD with font',
            ],
            [
                'pricing_plan_id' => 2,
                'attribute_icon'  => 'fas fa-asterisk',
                'attribute_name'  => 'Help Line',
            ],
            [
                'pricing_plan_id' => 2,
                'attribute_icon'  => 'fas fa-birthday-cake',
                'attribute_name'  => 'Sale after service',
            ],
            [
                'pricing_plan_id' => 3,
                'attribute_icon'  => 'fas fa-air-freshener',
                'attribute_name'  => '10 PSD with font',
            ],
            [
                'pricing_plan_id' => 3,
                'attribute_icon'  => 'fas fa-cog',
                'attribute_name'  => '2 Month extra fee',
            ],
            [
                'pricing_plan_id' => 3,
                'attribute_icon'  => 'fab fa-app-store',
                'attribute_name'  => 'Help line',
            ],
            [
                'pricing_plan_id' => 3,
                'attribute_icon'  => 'fas fa-life-ring',
                'attribute_name'  => 'Sale after service',
            ],
        ];

        foreach ($input as $data) {
            PlanAttribute::create($data);
        }
    }
}
