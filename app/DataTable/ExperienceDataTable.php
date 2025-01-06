<?php

namespace App\DataTable;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ExperienceDataTable
 */
class ExperienceDataTable
{
    /**
     * @param  array  $input
     *
     * @return Experience
     */
    public function get($input = [])
    {
        /** @var Experience $query */
        $query = Experience::with('country', 'city', 'state')->select('experiences.*');

        $query->when(isset($input['work_here']) && $input['work_here'] != Experience::ALL,
            function (Builder $q) use ($input) {
                $q->where('currently_work_here', '=', $input['work_here']);
            });

        return $query;
    }
}
