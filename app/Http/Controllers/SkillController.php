<?php

namespace App\Http\Controllers;

use App\DataTable\SkillDataTable;
use App\Http\Requests\CreateSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Repositories\SkillRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class SkillController extends AppBaseController
{

    /**
     * @var SkillRepository 
     */
    private $skillRepo;

    /**
     * SkillController constructor.
     * 
     * @param  SkillRepository  $skillRepository
     */
    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepo = $skillRepository;
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
            return Datatables::of((new SkillDataTable())->get())->make(true);
        }
        
        return view('skills.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSkillRequest  $request
     * 
     * @return Response
     */
    public function store(CreateSkillRequest $request)
    {
        $input = $request->all();
        $this->skillRepo->store($input);
        
        return $this->sendSuccess('Skill created successfully.');
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
        $skill = Skill::findOrFail($id);

        return $this->sendResponse($skill, 'Skill retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSkillRequest  $request
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(UpdateSkillRequest $request, $id)
    {
        $skill = Skill::findOrFail($id);
        $input = $request->all();
        $this->skillRepo->update($input, $skill->id);

        return $this->sendSuccess('Skill updated successfully.');
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
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return $this->sendSuccess('Skill deleted successfully.');
    }
}
