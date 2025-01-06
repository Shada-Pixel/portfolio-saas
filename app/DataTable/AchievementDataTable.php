<?php

namespace App\DataTable;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AboutMeDataTable
 */
class AchievementDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        return Achievement::query()->select('achievements.*');
    }
}
