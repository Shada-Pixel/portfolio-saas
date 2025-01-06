<?php

namespace App\Repositories;

use App\Models\RecentWorkType;

/**
 * Class RecentWorkTypeRepository
 */
class RecentWorkTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RecentWorkType::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        return RecentWorkType::create($input);
    }

    /**
     * @param $input
     * @param $id
     *
     * @return mixed
     */
    public function update($input, $id)
    {
        $recentWorkType = RecentWorkType::findOrFail($id);
        $recentWorkType->update($input);

        return $recentWorkType;
    }
}
