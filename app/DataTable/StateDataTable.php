<?php

namespace App\DataTable;

use App\Models\State;
use Illuminate\Database\Eloquent\Builder;

/**
 * @param  array  $input
 *
 * @return State
 */
class StateDataTable
{
    /**
     * @param  array  $input
     *
     * @return State
     */
    public function get($input = [])
    {
        /** @var State $query */
        $query = State::query()->with('country')->select('states.*');

        $query->when(isset($input['country_id']), function (Builder $q) use ($input) {
            $q->where('states.country_id', $input['country_id']);
        });

        return $query;
    }
}
