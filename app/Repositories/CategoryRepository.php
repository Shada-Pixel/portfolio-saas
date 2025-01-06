<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'name',
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
        return Category::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input)
    {
        /** @var Category $category */
        $category = Category::create($input);

        return $category;
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
        $category = Category::findOrFail($id);
        $category->update($input);

        return $category;
    }
}
