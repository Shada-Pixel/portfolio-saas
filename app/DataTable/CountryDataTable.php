<?php

namespace App\DataTable;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CountryDataTable
 */
class CountryDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        return Country::toBase();
    }
}
