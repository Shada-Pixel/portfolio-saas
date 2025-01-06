<?php

namespace App\Http\Controllers;

use App\DataTable\PricingPlanDataTable;
use App\Http\Requests\CreatePricingPlanRequest;
use App\Http\Requests\UpdatePricingPlanRequest;
use App\Models\PlanCurrency;
use App\Models\PricingPlan;
use App\Repositories\PricingPlanRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class PricingPlanController extends AppBaseController
{
    /**
     * @var PricingPlanRepository
     */
    private $pricingPlanRepo;

    public function __construct(PricingPlanRepository $pricingPlanRepo)
    {
        $this->pricingPlanRepo = $pricingPlanRepo;
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
            return Datatables::of((new PricingPlanDataTable())->get($request->only(['type', 'planType'])))->make(true);
        }
        $types = PricingPlan::PRICING_PLAN_TYPE_ARRAY;
        $planType = PricingPlan::PLAN_TYPE_ARRAY;
        
        return view('pricing_plan.index', compact('types', 'planType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $plans = PricingPlan::PRICING_PLAN_TYPE;
        $planType = PricingPlan::PLAN_TYPE;
        /** @var PlanCurrency $planCurrency */
        $planCurrency = PlanCurrency::toBase()->get();
        $planCurrencies = [];
        foreach ($planCurrency as $item) {
            $planCurrencies[$item->id]  = $item->currency_icon.' '.$item->currency_name;
        }
        
        return \view('pricing_plan.create', compact('plans', 'planType', 'planCurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePricingPlanRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreatePricingPlanRequest $request)
    {
        $input = $request->all();
        $pricingPlan = $this->pricingPlanRepo->store($input);

        Flash::success('Pricing Plan create successfully.');

        return redirect()->route('pricing-plans.index');
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
        $pricingPlan = PricingPlan::with(['planAttributes', 'currency'])->findOrFail($id);

        return \view('pricing_plan.show', compact('pricingPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $plans = PricingPlan::PRICING_PLAN_TYPE;
        $planType = PricingPlan::PLAN_TYPE;
        $pricingPlan = PricingPlan::findOrFail($id);
        $pricingPlan->load('planAttributes');
        $planCurrency = PlanCurrency::toBase()->get();
        $planCurrencies = [];
        foreach ($planCurrency as $item) {
            $planCurrencies[$item->id] = $item->currency_icon.' '.$item->currency_name;
        }
        
        return view('pricing_plan.edit', compact('plans', 'pricingPlan', 'planType', 'planCurrencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePricingPlanRequest  $request
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(UpdatePricingPlanRequest $request, $id)
    {
        $input = $request->all();
        $pricingPlan = PricingPlan::findOrFail($id);
        $pricingPlan = $this->pricingPlanRepo->editRecord($input, $pricingPlan);

        Flash::success('Pricing Plan updated successfully.');

        return redirect()->route('pricing-plans.index');
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
        $pricingPlan = PricingPlan::findOrFail($id);
        $pricingPlan->delete();

        return $this->sendSuccess('Pricing Plan deleted successfully.');
    }
}
