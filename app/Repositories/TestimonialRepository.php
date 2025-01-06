<?php

namespace App\Repositories;

use App\Models\Testimonial;

/**
 * Class Testimonial
 */
class TestimonialRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'position',
        'description',
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
        return Testimonial::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        /** @var Testimonial $testimonial */
        $testimonial = Testimonial::create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $testimonial->addMedia($input['image'])->toMediaCollection(Testimonial::IMAGE, config('app.media_disc'));
        }

        return $testimonial;
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
        $testimonial = Testimonial::findOrFail($id);

        if (isset($input['image']) && ! empty($input['image'])) {
            $testimonial->clearMediaCollection(Testimonial::IMAGE);
            $testimonial->addMedia($input['image'])->toMediaCollection(Testimonial::IMAGE, config('app.media_disc'));
        }
        
        $testimonial->update($input);

        return $testimonial;
    }
}
