<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

/**
 * Class SubscriptionRepository
 */
class SubscriptionRepository extends BaseRepository
{

    protected $fieldSearchable = [
        'user_id',
        'stripe_id',
        'stripe_status',
        'stripe_plan',
        'subscription_plan_id',
        'transaction_id',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Subscription::class;
    }

    /**
     * @param $subscriptionPlanId
     *
     * @throws ApiErrorException
     *
     * @return array
     */
    public function purchaseSubscription($subscriptionPlanId)
    {
        /** @var SubscriptionPlan $subscriptionPlan */
        $subscriptionPlan = SubscriptionPlan::with('currency')->findOrFail($subscriptionPlanId);

        $subscriptionPlan->refresh();
        if ($subscriptionPlan->price == 0.00) {
            $input = [
                'user_id'              => getLoggedInUser()->id,
                'subscription_plan_id' => $subscriptionPlan->id,
            ];

            $subscription = Subscription::create($input);
            $subscription->load('subscriptionPlan');

            // Current User Subscription
            $currentSubscription = Subscription::whereUserId(getLoggedInUserId())->where('status',
                Subscription::ACTIVE);
            $currentSubscription->update([
                'status' => Subscription::INACTIVE,
            ]);

            // New Plan Subscribe
            if ($subscription->subscriptionPlan->plan_type == SubscriptionPlan::MONTH) {
                $subscription->update([
                    'start_date' => Carbon::now(),
                    'end_date'   => Carbon::now()->addMonths($subscription->subscriptionPlan->valid_until),
                    'status'     => Subscription::ACTIVE,
                ]);
            } else {
                if ($subscription->subscriptionPlan->plan_type == SubscriptionPlan::YEAR) {
                    $subscription->update([
                        'start_date' => Carbon::now(),
                        'end_date'   => Carbon::now()->addYears($subscription->subscriptionPlan->valid_until),
                        'status'     => Subscription::ACTIVE,
                    ]);
                }
            }

            return $subscription;
        }

        $planAmount = null;
        if ($subscriptionPlan->currency != null && in_array($subscriptionPlan->currency->currency_code,
                zeroDecimalCurrencies())) {
            $planAmount = (int) $subscriptionPlan->price;
        } else {
            $planAmount = $subscriptionPlan->price * 100;
        }
        setStripeApiKey();
        /** @var User $user */
        $user = getLoggedInUser();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => $user->email,
            'line_items'           => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => $subscriptionPlan->name,
                        ],
                        'unit_amount'  => $planAmount,
                        'currency'     => $subscriptionPlan->currency->currency_code,
                    ],
                    'quantity'    => 1,
                    'description' => 'Subscribing for the plan named '.$subscriptionPlan->name,
                ],
            ],
            'mode'                 => 'payment',
            'success_url'          => url('payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('failed-payment?error=payment_cancelled'),
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        $input = [
            'user_id'              => $user->id,
            'subscription_plan_id' => $subscriptionPlan->id,
            'type'                 => Subscription::TYPE_STRIPE,
            'amount'               => $subscriptionPlan->price,
        ];
        $subscribedPlan = Subscription::create($input);
        session(['subscription_plan_id' => $subscribedPlan->id]);
        session(['from_pricing' => request()->get('from_pricing')]);

        return $result;
    }

    /**
     * @throws ApiErrorException
     */
    public function paymentUpdate($request)
    {
        try {
            DB::beginTransaction();
            setStripeApiKey();
            $subscriptionPlanId = session('subscription_plan_id');
            // Current User Subscription
            $currentSubscription = Subscription::whereUserId(getLoggedInUserId())->where('status',
                Subscription::ACTIVE);
            $currentSubscription->update([
                'status' => Subscription::INACTIVE,
            ]);
            // New Plan Subscribe
            $stripe = new \Stripe\StripeClient(
                config('services.stripe.secret_key')
            );
            $sessionData = $stripe->checkout->sessions->retrieve(
                $request->session_id,
                []
            );

            // New Plan Subscribe
            $subscription = Subscription::with('subscriptionPlan')->findOrFail($subscriptionPlanId);
            if ($subscription->subscriptionPlan->plan_type == SubscriptionPlan::MONTH) {
                $subscription->update([
                    'transaction_id' => $request->get('session_id'),
                    'meta'           => json_encode($sessionData),
                    'start_date'     => Carbon::now(),
                    'end_date'       => Carbon::now()->addMonths($subscription->subscriptionPlan->valid_until),
                    'status'         => Subscription::ACTIVE,
                ]);
            } else {
                if ($subscription->subscriptionPlan->plan_type == SubscriptionPlan::YEAR) {
                    $subscription->update([
                        'transaction_id' => $request->get('session_id'),
                        'meta'           => json_encode(),
                        'start_date'     => Carbon::now(),
                        'end_date'       => Carbon::now()->addYears($subscription->subscriptionPlan->valid_until),
                        'status'         => Subscription::ACTIVE,
                    ]);
                }
            }

            DB::commit();

            return $subscription;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $subscriptionPlanId
     */
    public function paymentFailed($subscriptionPlanId)
    {
        $subscriptionPlan = Subscription::findOrFail($subscriptionPlanId);
        $subscriptionPlan->delete();

    }
}
