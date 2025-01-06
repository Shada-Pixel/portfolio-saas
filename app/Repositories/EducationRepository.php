<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Education;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationRepository
 * @package App\Repositories
 * @version April 28, 2020, 11:09 am UTC
 */
class EducationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'school_name',
        'qualification',
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
        return Education::class;
    }

    public function getEducationCreateData()
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
        $input['currently_studying_here'] = isset($input['currently_studying_here']) ? $input['currently_studying_here'] : false;

        return Education::create($input);

    }

    /**
     * @param  array  $input
     *
     * @return Model
     */
    public function updateRecord($input, $education)
    {
        $input['currently_studying_here'] = isset($input['currently_studying_here']) ? $input['currently_studying_here'] : false;

        return $education->update($input);

    }


}
