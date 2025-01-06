<div class="col-lg-4 col-sm-6 col-12">
    @php
        $planActive = false;
        if(($subscriptionsPricingPlan->plan_type == \App\Models\SubscriptionPlan::MONTH || $subscriptionsPricingPlan->plan_type == \App\Models\SubscriptionPlan::YEAR) && (isset($subscriptionsPricingPlan->plan->status)) && ($subscriptionsPricingPlan->plan->status == \App\Models\Subscription::ACTIVE && $subscriptionsPricingPlan->plan->user_id == getLoggedInUserId()))
            $planActive = true;
    @endphp
    <div class="card pricing-list__card position-relative overflow-hidden">
        <div class="pricing-list__head d-flex justify-content-center align-items-center {{ $planActive ? 'bg-success' : ''}}">
            <h4 class="mb-0 text-center text-white">{{ $subscriptionsPricingPlan->name }}</h4>
        </div>
        <div class="pricing-list__price px-4 pt-sm-4 pt-3">
            <h2 class="mb-0 text-center">
                <sup>{{ $subscriptionsPricingPlan->currency->currency_icon }}</sup>{{ number_format($subscriptionsPricingPlan->price) }}
            </h2>
            <span class="text-center d-block"> {{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->plan_type] }}</span>
        </div>
        <div class="pricing-list__validity p-4">
            <ul class="list-unstyled mb-0">
                <li class="text-center">
                    <i class="fas fa-check me-2 check-icon"></i>
                    <span>{{ __('messages.subscription_plans.valid_until') }} : {{ $subscriptionsPricingPlan->valid_until }}
                        {{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionsPricingPlan->plan_type] }}
                    </span>
                </li>
            </ul>
        </div>
        <div class="p-4 d-flex justify-content-center p-4">
            @if($planActive)
                @if (\Carbon\Carbon::parse($subscriptionsPricingPlan->plan->end_date) < \Carbon\Carbon::now())
                    @if($subscriptionsPricingPlan->price != 0)
                        <a class="btn btn-primary pricing-list__footer-renew-btn"
                           href="{{ route('front.payment.method', $subscriptionsPricingPlan->id) }}"
                           data-id="{{ $subscriptionsPricingPlan->id }}"
                           data-plan-price="{{ $subscriptionsPricingPlan->price }}">{{ __('messages.subscription_pricing_plans.renew_plan') }}</a>
                    @else
                        <button type="button" class="btn btn-info pricing-list__footer-btn-free-plan">
                            {{ __('messages.subscription_pricing_plans.renew_free_plan') }}
                        </button>
                    @endif
                @else
                    <button type="button" class="btn btn-primary pricing-list__footer-active-btn"
                            data-id="{{ $subscriptionsPricingPlan->id }}">{{ __('messages.subscription_pricing_plans.currently_active') }}</button>
                @endif
            @else
                @if($subscriptionsPricingPlan->price != 0 || ($subscriptionsPricingPlan->price == 0 && $subscriptionsPricingPlan->plans->count() == 0))
                    @if(getLoggedInUser() != null)
                        <a href="{{ $subscriptionsPricingPlan->price != 0 ? route('front.payment.method', $subscriptionsPricingPlan->id) : 'javascript:void(0)' }}"
                           class="btn btn-primary pricing-list__footer-btn {{ $subscriptionsPricingPlan->price == 0 ? 'freePayment' : ''}}"
                           data-id="{{ $subscriptionsPricingPlan->id }}"
                           data-plan-price="{{ $subscriptionsPricingPlan->price }}">
                            {{ __('messages.subscription_pricing_plans.choose_plan') }}
                        </a>
                    @else
                        <button type="button" class="btn btn-primary pricing-list__footer-btn freePayment"
                                data-id="{{ $subscriptionsPricingPlan->id }}"
                                data-plan-price="{{ $subscriptionsPricingPlan->price }}">{{ __('messages.subscription_pricing_plans.choose_plan') }}</button>
                    @endif
                @else
                    <button type="button" class="btn btn-info pricing-list__footer-btn-free-plan">
                        {{ __('messages.subscription_pricing_plans.renew_free_plan') }}
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>

