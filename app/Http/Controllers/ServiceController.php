<?php

namespace App\Http\Controllers;

use App\DataTable\serviceDataTable;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class ServiceController extends AppBaseController
{
    /**
     * @var ServiceRepository
     */
    private $serviceRepo;

    /**
     * ServiceController constructor.
     * 
     * @param  ServiceRepository  $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepo = $serviceRepository;
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
            return DataTables::of((new serviceDataTable())->get())->make(true);
        }

        return view('service.index');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateServiceRequest  $request
     *
     * @return void
     */
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();
        $this->serviceRepo->store($input);

        return $this->sendSuccess('Service created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return $this->sendResponse($service, 'Services retrieved successfully.');
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
        $service = Service::findOrFail($id);

        return $this->sendResponse($service, 'Services retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateServiceRequest  $request
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        $input = $request->all();
        $service = Service::findOrFail($id);
        $this->serviceRepo->update($input, $id);

        return $this->sendSuccess('Service updated successfully.');
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
        $service = Service::findOrFail($id);
        $service->delete();

        return $this->sendSuccess('Service deleted successfully.');
    }
}
