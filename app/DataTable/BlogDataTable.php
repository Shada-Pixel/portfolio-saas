<?php

namespace App\DataTable;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BlogDataTable
 */
class BlogDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        return Blog::with('category')->orderByDesc('created_at')->select('blogs.*');
    }
}
