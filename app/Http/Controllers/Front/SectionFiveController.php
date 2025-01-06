<?php

namespace App\Http\Controllers\Front;

use App\DataTable\SectionFiveDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSectionFiveRequest;
use App\Http\Requests\UpdateSectionFiveRequest;
use App\Models\SectionFive;
use Exception;
use App\Repositories\FrontRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class SectionFiveController extends AppBaseController
{
    /**
     * @var FrontRepository
     */
    private $frontRepo;

    public function __construct(FrontRepository $frontRepo)
    {
        $this->frontRepo = $frontRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new SectionFiveDataTable())->get())->make(true);
        }

        return view('front.section_five.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSectionFiveRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateSectionFiveRequest $request)
    {
        $input = $request->all();
        $this->frontRepo->storeSectionFiveData($input);

        return $this->sendSuccess('Section created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SectionFive  $sectionFive
     *
     * @return Application|Factory|View
     */
    public function edit(SectionFive $sectionFive)
    {
        $data = $this->frontRepo->getSectionFiveData();
        
        return $this->sendResponse([$data,$sectionFive], 'Section retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSectionFiveRequest  $request
     * 
     * @param $id
     * 
     * @return RedirectResponse
     */
    public function update(UpdateSectionFiveRequest $request, $id)
    {
        $input = $request->all();
        $sectionFive = SectionFive::find($id);
        $this->frontRepo->updateSectionFiveData($input, $sectionFive);

        return $this->sendSuccess('Section updated successfully.');
    }

    public function show(SectionFive $sectionFive)
    {
        $data = $this->frontRepo->getSectionFiveData();
        
        return $this->sendResponse([$sectionFive, $data], 'Section retrieved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SectionFive  $sectionFive
     *
     * @return Response
     */
    public function destroy(SectionFive $sectionFive)
    {
        $sectionFive->delete();

        return $this->sendSuccess('Section Item deleted Successfully.');
    }
}
