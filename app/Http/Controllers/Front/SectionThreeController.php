<?php

namespace App\Http\Controllers\Front;

use App\DataTable\SectionThreeDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSectionThreeRequest;
use App\Http\Requests\UpdateSectionThreeRequest;
use App\Models\SectionThree;
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

class SectionThreeController extends AppBaseController
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
            return DataTables::of((new SectionThreeDataTable())->get())->make(true);
        }

        return view('front.section_three.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('front.section_three.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSectionThreeRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateSectionThreeRequest $request)
    {
        $input = $request->all();
        $this->frontRepo->storeSectionThreeData($input);
        Flash::success('Section created Successfully.');

        return redirect()->route('section-three.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SectionThree  $sectionThree
     *
     * @return Application|Factory|View|Response
     */
    public function edit(SectionThree $sectionThree)
    {
        $data = $this->frontRepo->getSectionThreeData();

        return view('front.section_three.edit', compact('sectionThree'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSectionThreeRequest  $request
     * @param  SectionThree  $sectionThree
     *
     * @return RedirectResponse
     */
    public function update(UpdateSectionThreeRequest $request, SectionThree $sectionThree)
    {
        $input = $request->all();
        $this->frontRepo->updateSectionThreeData($input, $sectionThree);
        Flash::success('Section updated Successfully.');

        return redirect()->route('section-three.index');
    }

    public function show(SectionThree $sectionThree)
    {
        $data = $this->frontRepo->getSectionThreeData();
        $data['sectionThree'] = $sectionThree;

        return view('front.section_three.show', compact('sectionThree'))->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SectionThree  $sectionThree
     *
     * @return Response
     */
    public function destroy(SectionThree $sectionThree)
    {
        $sectionThree->delete();

        return $this->sendSuccess('Section Item deleted Successfully.');
    }
}
