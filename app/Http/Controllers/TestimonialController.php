<?php

namespace App\Http\Controllers;

use App\DataTable\TestimonialDataTable;
use App\Http\Requests\CreateTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class TestimonialController extends AppBaseController
{
    /**
     * @var TestimonialRepository
     */
    private $testimonialRepo;

    /**
     * TestimonialController constructor.
     * 
     * @param  TestimonialRepository  $testimonialRepository
     */
    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->testimonialRepo = $testimonialRepository;
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
        if ($request->ajax()) {
            return DataTables::of((new TestimonialDataTable())->get())->make(true);
        }

        return view('testimonials.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTestimonialRequest  $request
     *
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $input = $request->all();
        $this->testimonialRepo->store($input);

        return $this->sendSuccess('Testimonial created successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return $this->sendResponse($testimonial, 'Testimonial retrieved successfully.');
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
        $testimonial = Testimonial::findOrFail($id);

        return $this->sendResponse($testimonial, 'Testimonial retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTestimonialRequest  $request
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(UpdateTestimonialRequest $request, $id)
    {
        $input = $request->all();
        $testimonial = Testimonial::findOrFail($id);
        $this->testimonialRepo->update($input, $testimonial->id);

        return $this->sendSuccess('Testimonial updated successfully.');
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
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return $this->sendSuccess('Testimonial deleted successfully.');
    }
}
