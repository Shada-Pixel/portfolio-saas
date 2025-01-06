<?php

namespace App\Repositories;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'valid_until',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SubscriptionPlan::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        $subscriptionPlan = SubscriptionPlan::create($input);

        return $subscriptionPlan;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $subscriptionPlan = SubscriptionPlan::findOrFail($id);
        $subscriptionPlan->update($input);

        return $subscriptionPlan;
    }

    /**
     *
     *
     * @return array
     */
    public function getSubscriptionPlansData(): array
    {
        $data = null;
        $data['subscriptionPricingMonthPlans'] = SubscriptionPlan::with([
            'currency', 'plan', 'plans',
        ])->where('plan_type', '=',
            '1')->get();
        $data['subscriptionPricingYearPlans'] = SubscriptionPlan::with([
            'currency', 'plan', 'plans',
        ])->where('plan_type', '=',
            '2')->get();

        return $data;
    }
}
