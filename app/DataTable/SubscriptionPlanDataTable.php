<?php

namespace App\DataTable;


use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionPlanDataTable
{
    /**
     * @return SubscriptionPlan
     */
    public function get($input = [])
    {
        /** @var SubscriptionPlan $query */
        $query = SubscriptionPlan::with('currency', 'subscription')->select('subscription_plans.*');

        $query->when(isset($input['plan_type']),function (Builder $q) use ($input) {
            $q->where('plan_type', '=', $input['plan_type']);
        });

        return $query;
    }
}
