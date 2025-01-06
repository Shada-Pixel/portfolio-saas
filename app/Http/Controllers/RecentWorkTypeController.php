<?php

namespace App\Http\Controllers;

use App\DataTable\RecentWorkTypeDataTable;
use App\Http\Requests\CreateRecentWorkTypeRequest;
use App\Http\Requests\UpdateRecentWorkTypeRequest;
use App\Models\RecentWork;
use App\Models\RecentWorkType;
use App\Repositories\RecentWorkTypeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class RecentWorkTypeController extends AppBaseController
{
    /**
     * @var RecentWorkTypeRepository
     */
    private $recentWorkTypeRepo;

    public function __construct(RecentWorkTypeRepository $recentWorkTypeRepo)
    {
        $this->recentWorkTypeRepo = $recentWorkTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws \Exception
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new RecentWorkTypeDataTable())->get())->make(true);
        }

        return view('recent_work_type.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRecentWorkTypeRequest  $request
     *
     * @return Response
     */
    public function store(CreateRecentWorkTypeRequest $request)
    {
        $input = $request->all();
        $this->recentWorkTypeRepo->store($input);

        return $this->sendSuccess('Recent work type created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $recentWorkType = RecentWorkType::findOrFail($id);

        return $this->sendResponse($recentWorkType, 'Recent work type retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRecentWorkTypeRequest  $request
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(UpdateRecentWorkTypeRequest $request, $id)
    {
        $input = $request->all();
        $recentWorkType = RecentWorkType::findOrFail($id);
        $this->recentWorkTypeRepo->update($input, $recentWorkType->id);

        return $this->sendSuccess('Recent work type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $recentWorkType = RecentWorkType::findOrFail($id);
        $recentWorkExists = RecentWork::whereTypeId($recentWorkType->id)->exists();
        if ($recentWorkExists) {
            return $this->sendError('Recent work of this recent work type is Available.');
        }
        $recentWorkType->delete();

        return $this->sendSuccess('Recent work type deleted successfully.');
    }
}
