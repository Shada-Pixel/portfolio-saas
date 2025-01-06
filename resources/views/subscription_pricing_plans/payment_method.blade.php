@extends('layouts.app')
@section('title')
    {{__('messages.subscription_plans.payment_method')}}
@endsection
@section('css')
    <link href="{{ mix('assets/style/subscription_pricing_plans/subscription_pricing_plan.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 pricing-content-alignment">
                    <div class="col-lg-3 col-md-3 col-5 text-alignment">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.subscription_plans.payment_method')}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('flash::message')
                @include('layouts.errors')
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 pricing-card mb-4">
                        <div class="card pricing-card__card shadow p-4">
                            <div class="card-title">
                                <h2 class="mb-0 pricing-card__plan-title">{{ $subscriptionPricingPlan->name }}</h2>
                            </div>
                            <div class="card-body p-0">
                                <h4 class="pricing-card__price d-flex flex-wrap pb-5">{{ $subscriptionPricingPlan->currency->currency_icon }}{{ number_format($subscriptionPricingPlan->price) }}
                                    <span class="price-month">/{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionPricingPlan->plan_type] }}</span>
                                </h4>
                                <div class="pricing-card__data mt-5">
                                    <ul class="pl-4">
                                        <li>
                                            <h3>{{ __('messages.subscription_plans.valid_until') }}
                                                : {{ $subscriptionPricingPlan->valid_until }}
                                                <span>{{ \App\Models\SubscriptionPlan::PLAN_TYPE[$subscriptionPricingPlan->plan_type] }}</span>
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                                <div class="justify-content-center mt-5">
                                    <h4 class="mb-3 text-center">{{ __('messages.subscription_plans.choose_payment_method') }}</h4>
                                    {{ Form::select('payment_method', $planMethod, 1,['class' => 'form-control payment_method']) }}
                                </div>
                            </div>
                            <button type="button"
                                    class="btn btn-primary rounded-pill mx-auto payment-stripe makePayment"
                                    data-id="{{ $subscriptionPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionPricingPlan->price }}">{{ __('messages.subscription_plans.processing_payment') }}</button>
                            <button type="button"
                                    class="btn btn-primary rounded-pill mx-auto payment-paypal paymentByPaypal d-none"
                                    data-id="{{ $subscriptionPricingPlan->id }}"
                                    data-plan-price="{{ $subscriptionPricingPlan->price }}">{{ __('messages.subscription_plans.processing_payment') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let makePaypalUrl = "{{ route('paypal.purchase.subscription') }}";
        let makePaymentURL = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";
        let stripe = Stripe('{{ config('services.stripe.key') }}');
    </script>
    <script src="{{ mix('assets/js/subscriptions/subscription.js') }}"></script>
@endsection
