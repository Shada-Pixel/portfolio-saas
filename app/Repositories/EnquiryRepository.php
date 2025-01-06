<?php

namespace App\Repositories;

use App\Models\Enquiry;

/**
 * Class EnquiryRepository
 * @package App\Repositories
 * @version February 13, 2020, 8:55 am UTC
 */
class EnquiryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'phone',
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
        return Enquiry::class;
    }
}
