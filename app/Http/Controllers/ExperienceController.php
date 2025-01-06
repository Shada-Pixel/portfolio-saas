<?php

namespace App\Http\Controllers;

use App\DataTable\ExperienceDataTable;
use App\Http\Requests\CreateExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use App\Repositories\ExperienceRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends AppBaseController
{
    /**
     * @var ExperienceRepository
     */
    private $experienceRepo;

    public function __construct(ExperienceRepository $experienceRepo)
    {
        $this->experienceRepo = $experienceRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ExperienceDataTable())->get($request->only(['work_here'])))->make(true);
        }

        $workArr = Experience::CURRENTLY_WORK;

        return view('experience.index', compact('workArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $data = $this->experienceRepo->getExperienceCreateData();

        return \view('experience.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateExperienceRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateExperienceRequest $request)
    {
        $input = $request->all();

        $experience = $this->experienceRepo->create($input);

        Flash::success('Experience create Successfully.');

        return redirect()->route('experiences.index');
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
        $experience = Experience::findOrFail($id);

        return \view('experience.show', compact('experience'));
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
        $experience = Experience::findOrFail($id);
        $data = $this->experienceRepo->getExperienceCreateData();
        $states = [];
        $cities = [];
        if ($experience->country_id) {
            $states = getStates($experience->country_id);
        }
        if ($experience->state_id) {
            $cities = getCities($experience->state_id);
        }
        $data['states'] = $states;
        $data['cities'] = $cities;

        return \view('experience.edit', compact('experience'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateExperienceRequest  $request
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateExperienceRequest $request, $id)
    {
        $input = $request->all();
        $experience = Experience::findOrFail($id);
        if (! $experience) {
            return redirect()->back()->withInput($input)->withErrors('Experience Not Found.');
        }

        $experience = $this->experienceRepo->updateRecord($input, $experience);

        Flash::success('Experience updated Successfully.');

        return redirect()->route('experiences.index');
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
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return $this->sendSuccess('Experience deleted Successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function experienceWorkHere($id)
    {
        $experience = Experience::findOrFail($id);
        $workHere = $experience->currently_work_here;
        $experience->update(['currently_work_here' => ! $workHere, 'end_date' => null]);

        return $this->sendSuccess('Currently work here changed successfully.');
    }
}
