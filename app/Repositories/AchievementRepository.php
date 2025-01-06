<?php

namespace App\Repositories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AboutMeRepository
 */
class AchievementRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'title',
        'short_description',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Achievement::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        /** @var Achievement $aboutMe */
        $achievement = Achievement::create($input);

        return $achievement;
    }

    /**
     * @param  array  $input
     * 
     * @param  int  $id
     *
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $achievement = Achievement::findOrfail($id);
        $achievement->update($input);

        return $achievement;
    }
}
