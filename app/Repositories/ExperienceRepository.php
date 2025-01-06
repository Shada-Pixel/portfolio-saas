<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperienceRepository
 * @package App\Repositories
 * @version April 28, 2020, 11:09 am UTC
 */
class ExperienceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'job_title',
        'company',
        'title',
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
        return Experience::class;
    }

    public function getExperienceCreateData()
    {
        $data['countries'] = Country::toBase()->orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return Model
     */
    public function create($input)
    {
        $input['currently_work_here'] = isset($input['currently_work_here']) ? $input['currently_work_here'] : false;

        $experience = Experience::create($input);

        return $experience;

    }

    /**
     * @param  array  $input
     *
     * @return Model
     */
    public function updateRecord($input, $experience)
    {
        $input['currently_work_here'] = isset($input['currently_work_here']) ? $input['currently_work_here'] : false;

        $experience = $experience->update($input);

        return $experience;

    }


}
