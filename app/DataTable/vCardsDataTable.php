<?php

namespace App\DataTable;

use App\Models\VCard;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PricingPlanDataTable
 */
class vCardsDataTable
{
    /**
     * @return VCard
     */
    public function get()
    {
        /** @var VCard $query */
        $query = VCard::toBase();
     
        return $query;
    }
}
