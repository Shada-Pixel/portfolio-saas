<div class="col-lg-4 col-md-6 col-sm-6 col-12 pricing-card mb-4">
    @php
        $planActive = false;
        if(($subscriptionsPricingPlan->plan_type == \App\Models\SubscriptionPlan::MONTH || $subscriptionsPricingPlan->plan_type == \App\Models\SubscriptionPlan::YEAR) && (isset($subscriptionsPricingPlan->plan->status)) && ($subscriptionsPricingPlan->plan->status == \App\Models\Subscription::ACTIVE && $subscriptionsPricingPlan->plan->user_id == getLoggedInUserId()))
            $planActive = true;
    @endphp
    <div class="card pricing-card__card p-4 {{ $planActive ? 'bg-white' : '' }}">
        <div class="card-title">
            <h2 class="mb-0 pricing-card__plan-title">{{ $subscriptionsPricingPlan->name }}</h2>
        </div>
        <div class="card-body p-0">
            <h4 class="pricing-card__price d-flex flex-wrap pb-5">{{ $subscriptionsPricingPlan->currency->currency_icon }}{{ number_format($subscriptionsPricingPlan->price) }}
                <span class="price-month">/{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->plan_type] }}</span>
            </h4>
            <div class="pricing-card__data mt-5">
                <ul class="pl-4">
                    <li>
                        <h3>{{ __('messages.subscription_plans.valid_until') }}
                            : {{ $subscriptionsPricingPlan->valid_until }}
                            <span>{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->plan_type] }}</span>
                        </h3>
                    </li>
                </ul>
            </div>
        </div>
        @if($planActive)
            @if (isset($subscriptionsPricingPlan->plan->end_date) && \Carbon\Carbon::parse($subscriptionsPricingPlan->plan->end_date) < \Carbon\Carbon::now())
                @if($subscriptionsPricingPlan->price != 0)
                    <a type="button"
                       class="btn btn-success rounded-pill mx-auto d-block"
                       href="{{ route('payment.method', $subscriptionsPricingPlan->id) }}">{{ __('messages.subscription_pricing_plans.renew_plan') }}</a>
                @else
                    <button type="button" class="btn btn-info rounded-pill mx-auto d-block">
                        {{ __('messages.subscription_pricing_plans.renew_free_plan') }}
                    </button>
                @endif
            @else
                <button type="button"
                        class="btn btn-success rounded-pill mx-auto d-block pricing-plan-button-active"
                        data-id="{{ $subscriptionsPricingPlan->id }}">{{ __('messages.subscription_pricing_plans.currently_active') }}</button>
            @endif
        @else
            @if($subscriptionsPricingPlan->price != 0 || ($subscriptionsPricingPlan->price == 0 && $subscriptionsPricingPlan->plans->count() == 0))
                <a href="{{ $subscriptionsPricingPlan->price != 0 ? route('payment.method', $subscriptionsPricingPlan->id) : 'javascript:void(0)' }}"
                   class="btn btn-primary rounded-pill mx-auto d-block {{ $subscriptionsPricingPlan->price == 0 ? 'freePayment' : ''}}"
                   data-id="{{ $subscriptionsPricingPlan->id }}"
                   data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                    {{ __('messages.subscription_pricing_plans.choose_plan') }}
                </a>

            @else
                <button type="button" class="btn btn-info rounded-pill mx-auto d-block">
                    {{ __('messages.subscription_pricing_plans.renew_free_plan') }}
                </button>
            @endif
        @endif
    </div>
</div>
