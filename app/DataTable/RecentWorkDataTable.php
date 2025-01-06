<?php

namespace App\DataTable;

use App\Models\RecentWork;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class RecentWorkDataTable
 */
class RecentWorkDataTable
{
    /**
     * @param  array  $input
     *
     * @return Builder
     */
    public function get($input = [])
    {
        /* @var RecentWork $recentWork */
        $query = RecentWork::with('type', 'media');

        $query->when(isset($input['type']) && $input['type'] != '',
            function (Builder $q) use ($input) {
                $q->where('type_id', '=', $input['type']);
            });

        return $query->select('recent_works.*');
    }
}
