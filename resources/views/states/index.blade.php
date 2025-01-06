@extends('layouts.app')
@section('title')
    {{__('messages.states.states')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 d-flex address_header_container">
                    <div class="px-3 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.states.states')}}</h6>
                    </div>
                    <div class="px-3 ml-auto text-right d-flex flex-wrap address-container">
                        <div class="ml-auto text-center mr-3 custom_address_button">
                            {{ Form::select('country', $countries, null, ['id' => 'filterCountry', 'class' => 'form-control' ,'placeholder' => __('messages.select_country')]) }}
                        </div>
                        <div class="custom_city_button">
                            <a href="#" class="btn btn-group-lg btn-neutral custom-button-size" data-toggle="modal"
                               data-target="#stateModal">{{__('messages.states.new_state')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('states.table')
            </div>
        </div>
        @include('states.create_modal')
        @include('states.edit_modal')
        @include('states.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let message = '{{__('messages.select_country')}}';
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/states/states.js')}}"></script>
@endsection

