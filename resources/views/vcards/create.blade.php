@extends('layouts.app')
@section('title')
    {{__('messages.vCards.VCards')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/web/vcard-template.css') }}" type="text/css"/>
    <link href="{{asset('assets/css/bootstrap-iconpicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/nano.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-pricingplan">
                    <div class="col-lg-6 col-7 pri-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.vCards.new_vCards')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right custom-pri-button">
                        <a href="{{route('vcards.index')}}" class="btn btn-group-lg btn-neutral pri-btn-size">{{__('messages.back')}}</a>
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
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                {{ Form::open(['route' => 'vcards.store','method'=>'post','id' =>'createVCardsForm', 'files' => true,]) }}
                @include('vcards.fields')
                {{ Form::close() }}
            </div>
        </div>
        @include('vcards.templates.templates')
    </div>
@endsection
@section('page_js')
    <script>
        let uniqueId = 2;
        let edit = false;
        let pricingDefaultColor = "#f5365c";
    </script>
    <script src="{{ asset('assets/js/pickr.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/color-picker.js') }}"></script>
    <script src="{{ mix('assets/js/vcards/create-edit.js') }}"></script>
    <script src="{{ asset('assets/js/autoNumeric.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
@endsection
