@extends('layouts.app')
@section('title')
    {{__('messages.subscription_plan')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-categories">
                    <div class="col-lg-6 col-6 custom-cat-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.subscription_plan')}}</h6>
                    </div>
                    <div class="col-lg-6 col-8 text-right d-flex experience-alignment">
                        <div class="ml-auto text-center mr-3 custom_all_button mt-2rem">
                            {{ Form::select('plan_type', $planType, null, ['id' => 'planTypeFilter', 'class' => 'form-control', 'placeholder' => 'Select Plan Type' ]) }}
                        </div>
                        <div class="mt-2rem custom_exp_button">
                        <a href="#" class="btn btn-group-lg btn-neutral custom-button-size" data-toggle="modal"
                           data-target="#subscriptionPlanModal">{{ __('messages.subscription_plans.add_subscription_plan') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('subscription_plans.table')
            </div>
        </div>
        @include('subscription_plans.create_modal')
        @include('subscription_plans.edit_modal')
        @include('subscription_plans.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let currencies = JSON.parse('@json($currency)');
        let currencySymbols = JSON.parse('@json($currencyIcon)');
        let subscriptionPlanUrl = "{{ route('subscription.plans.index') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/subscription_plans/subscription_plan.js') }}"></script>
    <script src="{{ mix('assets/js/custom/input-price-format.js') }}"></script>
@endsection

