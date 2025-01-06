@extends('layouts.app')
@section('title')
    {{__('messages.subscription_plan')}}
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
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.subscription_plan')}}</h6>
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
                <div class="nav-wrapper pt-0">
                    @include('subscription_pricing_plans.pricing_plan_button')
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                 aria-labelledby="tabs-icons-text-1-tab">
                                <div class="row justify-content-center">
                                    @forelse($subscriptionPricingMonthPlans as $subscriptionsPricingPlan)
                                        @include('subscription_pricing_plans.pricing_plan_section')
                                    @empty
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card text-center empty_featured_card">
                                                <div class="card-body d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <div class="empty-featured-portfolio">
                                                            <i class="fas fa-question"></i>
                                                        </div>

                                                        <h3 class="card-title mt-3">
                                                            {{ __('messages.subscription_month_plan_not_found') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                 aria-labelledby="tabs-icons-text-2-tab">
                                <div class="row justify-content-center">
                                    @forelse($subscriptionPricingYearPlans as $subscriptionsPricingPlan)
                                        @include('subscription_pricing_plans.pricing_plan_section')
                                    @empty
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card text-center empty_featured_card">
                                                <div class="card-body d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <div class="empty-featured-portfolio">
                                                            <i class="fas fa-question"></i>
                                                        </div>
                                                        <h3 class="card-title mt-3">
                                                            {{ __('messages.subscription_year_plan_not_found') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let trialPlanUrl = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";
    </script>
    <script src="{{ mix('assets/js/subscriptions/free-subscription.js') }}"></script>
@endsection
