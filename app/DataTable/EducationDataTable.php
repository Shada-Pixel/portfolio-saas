<?php

namespace App\DataTable;

use App\Models\Education;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ExperienceDataTable
 */
class EducationDataTable
{
    /**
     * @param  array  $input
     *
     * @return Education
     */
    public function get($input = [])
    {
        /** @var Education $query */
        $query = Education::with('country', 'city', 'state')->select('educations.*');

        $query->when(isset($input['study_here']) && $input['study_here'] != Education::ALL,
            function (Builder $q) use ($input) {
                $q->where('currently_studying_here', '=', $input['study_here']);
            });

        return $query;
    }
}
