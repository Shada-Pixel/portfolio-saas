<?php

namespace App\Http\Controllers;

use App\DataTable\AchievementDataTable;
use App\Http\Requests\CreateAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Repositories\AchievementRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class AchievementController extends AppBaseController
{
    /**
     * @var AchievementRepository
     */
    private $achievementRepo;

    /**
     * AboutMeController constructor.
     *
     * @param  AchievementRepository  $achievementRepository
     */
    public function __construct(AchievementRepository $achievementRepository)
    {
        $this->achievementRepo = $achievementRepository;
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
            return DataTables::of((new AchievementDataTable())->get())->make(true);
        }

        return view('achievements.index');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAchievementRequest  $request
     * 
     * @return Response
     */
    public function store(CreateAchievementRequest $request)
    {
        $input = $request->all();
        if ($input['icon'] == 'empty') {
            return $this->sendError('Icon is required.');
        }
        if ($input['dark_icon'] == 'empty') {
            return $this->sendError('DarkIcon is required.');
        }

        $this->achievementRepo->store($input);

        return $this->sendSuccess('Achievement  created successfully.');
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
        $achievement = Achievement::findOrFail($id);

        return $this->sendResponse($achievement, 'Achievement  retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateAchievementRequest  $request
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(UpdateAchievementRequest $request, $id)
    {
        $input = $request->all();
        $achievement = Achievement::findOrFail($id);
        if ($input['icon'] == 'empty') {
            return $this->sendError('Icon is required.');
        }
        if ($input['dark_icon'] == 'empty') {
            return $this->sendError('DarkIcon is required.');
        }

        $this->achievementRepo->update($input, $id);

        return $this->sendSuccess('Achievement update successfully.');
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
        $achievement = Achievement::findOrFail($id);

        return $this->sendResponse($achievement, 'Achievement retrieved successfully.');
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
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();

        return $this->sendSuccess('Achievement deleted successfully.');
    }
}
