@extends('layouts.app')
@section('title')
    {{__('messages.pricing_plan_currency.plan_currencies')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-skill">
                    <div class="col-lg-6 col-7 custom-skill-text">
                        <h6 class="h2 text-white d-inline-block mb-0">    {{__('messages.pricing_plan_currency.plan_currencies')}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right btn-skill">
                        <a href="#" class="btn btn-group-lg btn-neutral custom-skill-btn" data-toggle="modal"
                           data-target="#planCurrenciesModal">{{__('messages.pricing_plan_currency.new_plan_currency')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('plan_currencies.table')
            </div>
        </div>
        @include('plan_currencies.create_model')
        @include('plan_currencies.edit_model')
        @include('plan_currencies.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/plan_currency/plan_currency.js')}}"></script>
@endsection

