<?php

namespace App\DataTable;

use App\Models\PricingPlan;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PricingPlanDataTable
 */
class PricingPlanDataTable
{
    /**
     * @param  array  $input
     *
     * @return PricingPlan
     */
    public function get($input = [])
    {
        /** @var PricingPlan $query */
        $query = PricingPlan::query();

        $query->when(isset($input['type']) && $input['type'] != PricingPlan::ALL,
            function (Builder $q) use ($input) {
                $q->where('type', '=', $input['type']);
            });
        $query->when(isset($input['planType']) && $input['planType'] != PricingPlan::ALL,
            function (Builder $q) use ($input) {
                $q->where('plan_type', '=', $input['planType']);
            });

        return $query;
    }
}
