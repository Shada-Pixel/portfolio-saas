<?php

namespace App\Http\Controllers\Front;

use App\DataTable\SectionFourDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSectionFourRequest;
use App\Http\Requests\UpdateSectionFourRequest;
use App\Models\SectionFour;
use App\Repositories\FrontRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class SectionFourController extends AppBaseController
{
    /**
     * @var FrontRepository 
     */
    private $frontRepo;

    /**
     * @param  FrontRepository  $frontRepository
     */
    public function __construct(FrontRepository $frontRepository)
    {
        $this->frontRepo = $frontRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     * 
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->all()){
            return DataTables::of((new SectionFourDataTable())->get())->make(true);
        }
        
        return view('front.section_four.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('front.section_four.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSectionFourRequest  $request
     * 
     * @return RedirectResponse
     */
    public function store(CreateSectionFourRequest $request)
    {
        $input = $request->all();
        $this->frontRepo->storeSectionFourData($input);
        Flash::success('Section created Successfully.');

        return redirect()->route('section-four.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  SectionFour  $sectionFour
     * 
     * @return Application|Factory|View
     */
    public function show(SectionFour $sectionFour)
    {
        $data = $this->frontRepo->getSectionFourData();
        $data['sectionFour'] = $sectionFour;

        return view('front.section_four.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SectionFour  $sectionFour
     * 
     * @return Application|Factory|View
     */
    public function edit(SectionFour $sectionFour)
    {
        $data = $this->frontRepo->getSectionFourData();
        $data['sectionFour'] = $sectionFour;
        
        return view('front.section_four.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSectionFourRequest  $request
     * 
     * @param  SectionFour  $sectionFour
     * 
     * @return RedirectResponse
     */
    public function update(UpdateSectionFourRequest $request, SectionFour $sectionFour)
    {
        $input = $request->all();
        $this->frontRepo->updateSectionFourData($input, $sectionFour);
        Flash::success('Section updated Successfully.');

        return redirect()->route('section-four.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SectionFour  $sectionFour
     * 
     * @return Response
     */
    public function destroy(SectionFour $sectionFour)
    {
        $sectionFour->delete();

        return $this->sendSuccess('Section Item deleted Successfully.');
    }
}
