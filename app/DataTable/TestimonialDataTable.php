<?php

namespace App\DataTable;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TestimonialDataTable
 */
class TestimonialDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = Testimonial::query()->select('testimonials.*');
        
        return $query;
    }
}
