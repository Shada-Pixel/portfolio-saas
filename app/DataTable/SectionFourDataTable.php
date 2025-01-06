<?php

namespace App\DataTable;

use App\Models\SectionFour;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SectionFourDataTable
 */
class SectionFourDataTable
{
    /**
     * @return Builder[]|Collection
     */
    public function get()
    {
        return SectionFour::query()->get();
    }
}
