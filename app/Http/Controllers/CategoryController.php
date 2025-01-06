<?php

namespace App\Http\Controllers;

use App\DataTable\CategoryDataTable;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class CategoryController extends AppBaseController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepo;

    /**
     * CategoriesController constructor.
     *
     * @param  CategoryRepository  $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            return DataTables::of((new CategoryDataTable())->get())->make(true);
        }

        return view('categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest  $request
     *
     * @return void
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $this->categoryRepo->store($input);

        return $this->sendSuccess('Categories created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return $this->sendResponse($category, 'Category retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return $this->sendResponse($category, 'Categories retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest  $request
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $input = $request->all();
        $category = Category::findOrFail($id);
        $this->categoryRepo->update($input, $category->id);

        return $this->sendSuccess('Categories updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $postExists = Blog::whereCategoryId($category->id)->exists();
        if ($postExists) {
            return $this->sendError('Category can\'t deleted');
        }
        $category->delete();

        return $this->sendSuccess('Categories deleted successfully.');
    }

    /**
     * @param  CreateCategoryRequest  $request
     *
     * @return mixed
     */
    public function getCategory(CreateCategoryRequest $request)
    {
        $input = $request->all();
        /** @var Category $category */
        $category = Category::create($input);

        return $this->sendResponse($category, 'Category created successfully.');
    }
}
