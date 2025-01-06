<?php

namespace App\Http\Controllers;

use App\DataTable\PlanCurrencyDataTable;
use App\Http\Requests\CreatePlanCurrency;
use App\Http\Requests\UpdatePlanCurrencyRequest;
use App\Models\PlanCurrency;
use App\Models\PricingPlan;
use App\Repositories\PlanCurrencyRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PlanCurrencyController extends AppBaseController
{
    /**
     * @var PlanCurrencyRepository
     */
    private $planCurrencyRepo;

    public function __construct(PlanCurrencyRepository $planCurrencyRepository)
    {
        $this->planCurrencyRepo = $planCurrencyRepository;
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
            return DataTables::of((new PlanCurrencyDataTable())->get())->make(true);
        }
        
        return view('plan_currencies.index');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePlanCurrency  $request
     * 
     * @return Response
     */
    public function store(CreatePlanCurrency $request)
    {
        $input = $request->all();
        $planCurrency = $this->planCurrencyRepo->store($input);
        
        return $this->sendSuccess('Plan currency created successfully.');
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
        $planCurrency = PlanCurrency::findOrFail($id);

        return $this->sendResponse($planCurrency, 'Plan currency retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePlanCurrencyRequest  $request
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update(UpdatePlanCurrencyRequest $request, $id)
    {
        $input = $request->all();
        $planCurrency = PlanCurrency::findOrFail($id);
        $this->planCurrencyRepo->update($input, $planCurrency);

        return $this->sendSuccess('Plan currency updated successfully.');
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
        $planCurrency = PlanCurrency::findOrFail($id);
        $pricingModels = [
            PricingPlan::class,
        ];
        $result = canDelete($pricingModels, 'currency_id', $id);

        if ($result) {
            return $this->sendError('Currency can\'t be deleted.');
        }

        $planCurrency->delete();

        return $this->sendSuccess('Plan currency deleted successfully.');
    }
}
