<?php

namespace App\DataTable;

use App\Models\RecentWorkType;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class RecentWorkTypeDataTable
 */
class RecentWorkTypeDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        /* @var RecentWorkType $recentWorkType */
        return RecentWorkType::query();
    }
}
