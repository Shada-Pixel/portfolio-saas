<?php

namespace App\DataTable;

use App\Models\Category;

/**
 * Class CategoriesDataTable
 */
class CategoryDataTable
{
    /**
     * @return mixed
     */
    public function get()
    {
        /** @var Category $query */
        $query = Category::withCount('blogs')->orderByDesc('created_at')->get();

        return $query;
    }
}
