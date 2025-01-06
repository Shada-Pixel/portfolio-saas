<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use PayPalHttp\IOException;

class PaypalController extends AppBaseController
{

    /**
     * @param  Request  $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function paypalPurchaseSubscription(Request $request)
    {
        /** @var SubscriptionPlan $subscriptionPlan */
        $subscriptionPlan = SubscriptionPlan::with('currency')->findorfail($request->get('planId'));
        if ($subscriptionPlan->currency != null && ! in_array($subscriptionPlan->currency->currency_code,
                getPayPalSupportedCurrencies())) {
            Flash::error('This currency is not supported by PayPal for making payments.');

            if ($request->get('from_pricing')) {
                return response()->json(['url' => route('front.pricing')]);
            } else {
                return response()->json(['url' => route('subscription.pricing.plans.index')]);
            }
        } else {
            $input = [
                'type'                 => Subscription::TYPE_PAYPAL,
                'amount'               => $subscriptionPlan->price,
                'user_id'              => getLoggedInUser()->id,
                'subscription_plan_id' => $subscriptionPlan->id,
            ];

            $subscription = Subscription::create($input);
            session(['subscription_plan_id' => $subscription->id]);
            session(['from_pricing' => $request->get('from_pricing')]);

            $clientId = config('payments.paypal.client_id');
            $clientSecret = config('payments.paypal.client_secret');
            $mode = config('payments.paypal.mode');

            if ($mode == 'live') {
                $environment = new ProductionEnvironment($clientId, $clientSecret);
            } else {
                $environment = new SandboxEnvironment($clientId, $clientSecret);
            }

            $client = new PayPalHttpClient($environment);

            $request = new OrdersCreateRequest();
            $request->prefer('return=representation');
            $request->body = [
                "intent"              => "CAPTURE",
                "purchase_units"      => [
                    [
                        "reference_id" => $subscription->id,
                        "amount"       => [
                            "value"         => $subscriptionPlan->price,
                            "currency_code" => $subscriptionPlan->currency->currency_code,
                        ],
                    ],
                ],
                "application_context" => [
                    "cancel_url" => route('paypal.payment.failed'),
                    "return_url" => route('paypal.payment.success'),
                ],
            ];
            $order = $client->execute($request);

            return response()->json($order);
        }
    }

    /**
     * @param  Request  $request
     *
     * @throws IOException
     *
     * @return Application|RedirectResponse|Redirector|void
     */
    public function paypalPaymentSuccess(Request $request)
    {
        $clientId = config('payments.paypal.client_id');
        $clientSecret = config('payments.paypal.client_secret');
        $mode = config('payments.paypal.mode');
        if ($mode == 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }
        $request = new OrdersCaptureRequest($request->get('token'));
        $request->prefer('return=representation');
        $client = new PayPalHttpClient($environment);

        try {
            DB::beginTransaction();
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            $subscriptionPlanId = $response->result->purchase_units[0]->reference_id;
            $transactionID = $response->result->id;

            // Current User Subscription
            $currentSubscription = Subscription::whereUserId(getLoggedInUserId())->where('status',
                Subscription::ACTIVE);
            $currentSubscription->update([
                'status' => Subscription::INACTIVE,
            ]);
            // New Plan Subscribe
            $subscription = Subscription::with('subscriptionPlan')->findOrFail($subscriptionPlanId);
            if ($subscription->subscriptionPlan->plan_type == SubscriptionPlan::MONTH) {
                $subscription->update([
                    'meta'           => json_encode($response),
                    'transaction_id' => $transactionID,
                    'start_date'     => Carbon::now(),
                    'end_date'       => Carbon::now()->addMonths($subscription->subscriptionPlan->valid_until),
                    'status'         => Subscription::ACTIVE,
                ]);
            } else {
                if ($subscription->subscriptionPlan->plan_type == SubscriptionPlan::YEAR) {
                    $subscription->update([
                        'meta'           => json_encode($response),
                        'transaction_id' => $transactionID,
                        'start_date'     => Carbon::now(),
                        'end_date'       => Carbon::now()->addMonths($subscription->subscriptionPlan->valid_until),
                        'status'         => Subscription::ACTIVE,
                    ]);
                }
            }

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            Flash::success($subscription->subscriptionPlan->name.' '.__('messages.subscription_pricing_plans.has_been_subscribed'));

            DB::commit();
            
            if (session('from_pricing')) {
                return redirect(route('front.pricing'));
            } else {
                return redirect(route('subscription.pricing.plans.index'));
            }
        } catch (HttpException $ex) {
            DB::rollBack();
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

    /**
     *
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function paypalPaymentFailed(Request $request)
    {
        try {
            $subscription = session('subscription_plan_id');

            /** @var SubscriptionRepository $subscriptionRepo */
            $subscriptionPlan = Subscription::findOrFail($subscription);
            $subscriptionPlan->delete();

            Flash::error('Unable to process the payment at the moment. Try again later.');

            if (session('from_pricing')) {
                return redirect(route('front.pricing'));
            } else {
                return redirect(route('subscription.pricing.plans.index'));
            }
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
