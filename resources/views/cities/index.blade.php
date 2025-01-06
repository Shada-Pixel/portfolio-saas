@extends('layouts.app')
@section('title')
    {{__('messages.cities.cities')}}
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
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.cities.cities')}}</h6>
                    </div>
                    <div class="px-3 ml-auto text-right d-flex flex-wrap address-container">
                        <div class="ml-auto text-center mr-3 custom_address_button">
                            {{ Form::select('state', $states, null, ['id' => 'filterState', 'class' => 'form-control' ,'placeholder' => __('messages.select_state')]) }}
                        </div>
                        <div class="custom_city_button">
                            <a href="#" class="btn btn-group-lg btn-neutral custom-button-size" data-toggle="modal"
                               data-target="#cityModal">{{__('messages.cities.new_city')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('cities.table')
            </div>
        </div>
        @include('cities.create_modal')
        @include('cities.edit_modal')
        @include('cities.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let message = '{{__('messages.select_state')}}';
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/cities/cities.js')}}"></script>
@endsection

