<?php

namespace App\DataTable;

use App\Models\PlanCurrency;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PlanCurrencyDataTable
 */
class PlanCurrencyDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = PlanCurrency::toBase();
        
        return $query;
    }
}
