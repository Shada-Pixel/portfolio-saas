<?php

namespace App\Repositories;

use App\Models\Skill;

/**
 * Class SkillRepository
 */
class SkillRepository extends BaseRepository
{
    /**
     * @var string[] 
     */
    private $fieldSearchable = [
        'name',
        'percentage',
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
        return Skill::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        /** @var Skill $skill */
        $skill = Skill::create($input);

        return $skill;
    }

    /**
     * @param $input
     * 
     * @param $id
     *
     * @return mixed
     */
    public function update($input, $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update($input);

        return $skill;
    }
}
