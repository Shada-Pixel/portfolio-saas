<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Repositories\SubscriptionPlanRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SubscriptionPricingPlanController extends Controller
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
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->subscriptionPlanRepository->getSubscriptionPlansData();

        return view('subscription_pricing_plans.index')->with($data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function paymentMethod($id)
    {

        $planMethod = SubscriptionPlan::PLAN_METHOD;
        $subscriptionPricingPlan = SubscriptionPlan::findOrFail($id);

        return view('subscription_pricing_plans.payment_method', compact('planMethod', 'subscriptionPricingPlan'));
    }
}
