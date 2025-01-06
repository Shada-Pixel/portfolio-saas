<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Repositories\SubscriptionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class SubscriptionController
 */
class SubscriptionController extends AppBaseController
{

    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepo;

    /**
     * @param  SubscriptionRepository  $subscriptionRepo
     */
    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepo = $subscriptionRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws ApiErrorException
     *
     * @return mixed
     */
    public function purchaseSubscription(Request $request)
    {
        $subscriptionPlanId = $request->get('plan_id');
        $result = $this->subscriptionRepo->purchaseSubscription($subscriptionPlanId);
        // returning from here if the plan is free.
        if ($request->get('price') == 0) {
            return $this->sendSuccess($result->subscriptionPlan->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));
        }

        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @throws \Stripe\Exception\ApiErrorException
     * 
     * @return Application|RedirectResponse|Redirector
     */
    public function paymentSuccess(Request $request)
    {
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscription = $subscriptionRepo->paymentUpdate($request);
        Flash::success($subscription->subscriptionPlan->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));

        if (session('from_pricing')) {
            return redirect(route('front.pricing'));
        } else {
            return redirect(route('subscription.pricing.plans.index'));
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function handleFailedPayment()
    {
        $subscriptionPlanId = session('subscription_plan_id');
        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->paymentFailed($subscriptionPlanId);
        Flash::error('Unable to process the payment at the moment. Try again later.');

        if (session('from_pricing')) {
            return redirect(route('front.pricing'));
        } else {
            return redirect(route('subscription.pricing.plans.index'));
        }
    }
}
