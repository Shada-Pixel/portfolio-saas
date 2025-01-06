@extends('layouts.front.app')
@section('title')
    {{__('messages.subscription_plans.payment_method')}}
@endsection
@section('page_css')
    <link href="{{ asset('assets/front/css/pricing.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')
    <section class="pricing-list py-5 px-sm-0 px-3">
        <div class="container">
            <div class="row">
                @include('flash::message')
            </div>
            <div class="row mt-5 g-4 d-flex justify-content-center">
                <div class="col-lg-4 col-sm-6 col-12">
                    @php
                        $planActive = false;
                        if(($subscriptionPricingPlan->plan_type == \App\Models\SubscriptionPlan::MONTH || $subscriptionPricingPlan->plan_type == \App\Models\SubscriptionPlan::YEAR) && (isset($subscriptionPricingPlan->plan->status)) && ($subscriptionPricingPlan->plan->status == \App\Models\Subscription::ACTIVE && $subscriptionPricingPlan->plan->user_id == getLoggedInUserId()))
                            $planActive = true;
                    @endphp
                    <div class="card pricing-list__card position-relative overflow-hidden">
                        <div class="pricing-list__head d-flex justify-content-center align-items-center {{ $planActive ? 'bg-success' : ''}}">
                            <h4 class="mb-0 text-center text-white">{{ $subscriptionPricingPlan->name }}</h4>
                        </div>
                        <div class="pricing-list__price px-4 pt-sm-4 pt-3">
                            <h2 class="mb-0 text-center">
                                <sup>{{ $subscriptionPricingPlan->currency->currency_icon }}</sup>{{ number_format($subscriptionPricingPlan->price) }}
                            </h2>
                            <span class="text-center d-block"> {{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionPricingPlan->plan_type] }}</span>
                        </div>
                        <div class="pricing-list__validity p-4">
                            <ul class="list-unstyled mb-0">
                                <li class="text-center">
                                    <i class="fas fa-check me-2 check-icon"></i>
                                    <span>{{ __('messages.subscription_plans.valid_until') }} : {{ $subscriptionPricingPlan->valid_until }}
                                        {{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionPricingPlan->plan_type] }}
                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="p-4 pricing-list__choose-payment-method justify-content-center">
                            <h4 class="mb-3 text-center">{{ __('messages.subscription_plans.choose_payment_method') }}</h4>
                            {{ Form::select('payment_method', $planMethod, 1,['class' => 'form-control pricing-list payment_method']) }}
                        </div>
                        <div class="p-4 d-flex justify-content-center">
                            <button type="button"
                                    class="btn btn-primary pricing-list__footer-btn rounded-pill mx-auto payment-stripe makePayment"
                                    data-id="{{ $subscriptionPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionPricingPlan->price }}">{{ __('messages.subscription_plans.processing_payment') }}</button>
                            <button type="button"
                                    class="btn btn-primary pricing-list__footer-btn rounded-pill mx-auto payment-paypal paymentByPaypal d-none"
                                    data-id="{{ $subscriptionPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionPricingPlan->price }}">{{ __('messages.subscription_plans.processing_payment') }}</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let getLoggedInUserdata = "{{ getLoggedInUser() }}";
        let logInUrl = "{{ url('login') }}";
        let fromPricing = true;
        let makePaypalUrl = "{{ route('paypal.purchase.subscription') }}";
        let makePaymentURL = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.processing_payment') }}";
        let stripe = Stripe('{{ config('services.stripe.key') }}');
    </script>
    <script src="{{ mix('assets/js/subscriptions/subscription.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endsection
