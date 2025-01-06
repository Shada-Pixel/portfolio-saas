<?php

namespace App\Http\Controllers;

use App\DataTable\SubscriptionPlanDataTable;
use App\Http\Requests\CreateSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use App\Models\Currency;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Repositories\SubscriptionPlanRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubscriptionPlanController extends AppBaseController
{
    /**
     * @var
     */
    private $subscriptionPlanRepository;

    /**
     * @param  SubscriptionPlanRepository  $subscriptionPlanRepo
     */
    public function __construct(SubscriptionPlanRepository $subscriptionPlanRepo)
    {
        $this->subscriptionPlanRepository = $subscriptionPlanRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new SubscriptionPlanDatatable())->get($request->only('plan_type')))->make(true);
        }

        $currency = Currency::orderBy('id')->pluck('currency_name', 'id')->toArray();
        $currencyIcon = Currency::orderBy('id')->pluck('currency_icon', 'id')->toArray();
        $planType = SubscriptionPlan::PLAN_TYPE;

        return view('subscription_plans.index', compact('currency', 'currencyIcon', 'planType'));
    }

    /**
     * @param  CreateSubscriptionPlanRequest  $request
     *
     *
     * @return mixed
     */
    public function store(CreateSubscriptionPlanRequest $request)
    {
        $input = $request->all();
        $this->subscriptionPlanRepository->store($input);

        return $this->sendResponse($input, 'Subscription Plan created successfully.');
    }

    /**
     * @param  SubscriptionPlan  $subscriptionPlan
     *
     * @return mixed
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $result = Subscription::where('subscription_plan_id', $subscriptionPlan->id)->where('status',
            Subscription::ACTIVE)->count();
        if ($result > 0) {
            return $this->sendError('Subscription Plan can\'t be deleted.');
        }
        $subscriptionPlan->delete();

        return $this->sendSuccess('Subscription Plan Deleted Successfully.');
    }

    /**
     * @param  SubscriptionPlan  $subscriptionPlan
     *
     * @return mixed
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return $this->sendResponse($subscriptionPlan, 'Subscription plan retrieved successfully');
    }

    /**
     * @param  UpdateSubscriptionPlanRequest  $request
     *
     * @return mixed
     */
    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        $input = $request->all();
        $this->subscriptionPlanRepository->update($input, $subscriptionPlan->id);

        return $this->sendSuccess('Subscription plan updated successfully.');
    }
}
