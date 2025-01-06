<?php

namespace App\DataTable;

use App\Models\City;
use Illuminate\Database\Eloquent\Builder;

/**
 * @param  array  $input
 *
 * @return City
 */
class CityDataTable
{
    /**
     * @param  array  $input
     *
     * @return City
     */
    public function get($input = [])
    {
        /** @var City $query */
        $query = City::query()->with(['state.country'])->select('cities.*');

        $query->when(isset($input['state_id']), function (Builder $q) use ($input) {
            $q->where('cities.state_id', $input['state_id']);
        });

        return $query;
    }
}
