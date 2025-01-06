<?php

namespace App\Http\Controllers;

use App\DataTable\EducationDataTable;
use App\Http\Requests\CreateEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use App\Repositories\EducationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class EducationController extends AppBaseController
{
    /**
     * @var EducationRepository
     */
    private $educationRepo;

    public function __construct(EducationRepository $educationRepo)
    {
        $this->educationRepo = $educationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @throws \Exception
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new EducationDataTable())->get($request->only(['study_here'])))->make(true);
        }

        $studyArr = Education::CURRENTLY_STUDY;


        return view('education.index', compact('studyArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $data = $this->educationRepo->getEducationCreateData();

        return \view('education.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEducationRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateEducationRequest $request)
    {
        $input = $request->all();

        $education = $this->educationRepo->create($input);

        Flash::success('Education create Successfully.');

        return redirect()->route('educations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View|Response
     */
    public function show($id)
    {
        $education = Education::findOrFail($id);

        return \view('education.show', compact('education'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $education = Education::findOrFail($id);
        $data = $this->educationRepo->getEducationCreateData();
        $states = [];
        $cities = [];
        if ($education->country_id) {
            $states = getStates($education->country_id);
        }
        if ($education->state_id) {
            $cities = getCities($education->state_id);
        }
        $data['states'] = $states;
        $data['cities'] = $cities;

        return \view('education.edit', compact('education'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEducationRequest  $request
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateEducationRequest $request, $id)
    {
        $input = $request->all();
        $education = Education::findOrFail($id);
        if (! $education) {
            return redirect()->back()->withInput($input)->withErrors('Education Not Found.');
        }

        $education = $this->educationRepo->updateRecord($input, $education);

        Flash::success('Education updated Successfully.');

        return redirect()->route('educations.index');
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
        $education = Education::findOrFail($id);
        $education->delete();

        return $this->sendSuccess('Education deleted Successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function educationStudyHere($id)
    {
        $education = Education::findOrFail($id);
        $studyHere = $education->currently_studying_here;
        $education->update(['currently_studying_here' => ! $studyHere, 'end_date' => null]);

        return $this->sendSuccess('Currently study here changed successfully.');
    }
}
