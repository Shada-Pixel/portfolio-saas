@extends('layouts.front.app')
@section('title')
    {{__('messages.subscription_plan')}}
@endsection
@section('page_css')
    <link href="{{ asset('assets/front/css/pricing.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <section class="pricing-list py-5 px-sm-0 px-3">
        <div class="container">
            <div class="row">
                @include('flash::message')
                <div class="d-flex justify-content-center">
                    @include('front.pricing.pricing_plan_button')
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" aria-labelledby="month-card-tab" id="month-card">
                    <div class="row mt-5 g-4 d-flex justify-content-center">
                        @forelse($subscriptionPricingMonthPlans as $subscriptionsPricingPlan)
                            @include('front.pricing.pricing_plan_section')
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
                <div class="tab-pane fade" aria-labelledby="year-card-tab" id="year-card">
                    <div class="row mt-5 g-4 d-flex justify-content-center">
                        @forelse($subscriptionPricingYearPlans as $subscriptionsPricingPlan)
                            @include('front.pricing.pricing_plan_section')
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
    </section>
@endsection
@section('scripts')
    <script>
        let getLoggedInUserdata = "{{ getLoggedInUser() }}";
        let logInUrl = "{{ url('login') }}";
        let fromPricing = true;
        let trialPlanUrl = "{{ route('purchase-subscription') }}";
        let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";
    </script>
    <script src="{{ mix('assets/js/subscriptions/free-subscription.js') }}"></script>
@endsection
