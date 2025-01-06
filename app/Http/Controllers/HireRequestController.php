<?php

namespace App\Http\Controllers;

use App\DataTable\HireRequestDataTable;
use App\Http\Requests\CreateHireMeRequest;
use App\Models\HireRequest;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\DataTables;

class HireRequestController extends AppBaseController
{
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
            return DataTables::of((new HireRequestDataTable())->get())
                ->orderColumn('budget', function ($query, $order) {
                    $query->orderBy(DB::raw('cast(budget AS unsigned)'), $order);
                })->make(true);
        }
        
        return view('hire_me.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateHireMeRequest  $request
     *
     * @return Response
     */
    public function store(CreateHireMeRequest $request)
    {
        $input = $request->all();
//        $input['modile'] = preparePhoneNumber($input['mobile'],$input['region_code']);
        try {
            $input['budget'] = removeCommaFromNumbers($input['budget']);
            HireRequest::create($input);
            
            return $this->sendSuccess('Hire me request send successfully');
        }catch(Exception $e)
        {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $hireMe = HireRequest::findOrFail($id);

        return view('hire_me.show', compact('hireMe'));
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
        $hireMe = HireRequest::findOrFail($id);
        $hireMe->delete();

        return $this->sendSuccess('Hire request deleted successfully.');
    }
}
