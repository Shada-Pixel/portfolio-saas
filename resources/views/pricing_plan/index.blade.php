@extends('layouts.app')
@section('title')
    {{__('messages.pricing_plans')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 pricing-content-alignment">
                    <div class="col-lg-3 col-md-3 col-5 text-alignment">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.pricing_plans')}}</h6>
                    </div>
                    <div class="col-lg-9 col-md-9 col-6  text-right d-flex pricing-alignment">
                        <div class="ml-auto text-center  pricing-plan-btn mt-2rem">
                            {{Form::select('planType', $planType, null, ['id' => 'planType', 'class' => 'form-control', 'placeholder' => __('messages.pricing_plan_placeholder.select_plan_type')]) }}
                        </div>
                        <div class="text-center custom_pricing_btn mt-2rem">
                            {{Form::select('type', $types, null, ['id' => 'type', 'class' => 'form-control', 'placeholder' => __('messages.pricing_plan_placeholder.select_type')]) }}
                        </div>
                        <div class="mt-2rem custom_pricing_button">
                            <a href="{{route('pricing-plans.create')}}"
                               class="btn btn-group-lg btn-neutral btn-pricing-size">{{__('messages.new_pricing_plan')}}</a>
                        </div>
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
                @include('pricing_plan.table')
            </div>
        </div>
        @include('pricing_plan.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/pricing_plan/pricing_plan.js')}}"></script>
@endsection
