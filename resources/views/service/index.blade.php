@extends('layouts.app')
@section('title')
    {{__('messages.services')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/nano.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-services">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 custom-services-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.services')}}</h6>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right custom-services-btn">
                        <a href="#" class="btn btn-group-lg btn-neutral addNewServices services-btn">{{__('messages.new_service')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('service.table')
            </div>
        </div>
        @include('service.templates.templates')
        @include('service.create_model')
        @include('service.edit_model')
        @include('service.show')
    </div>
@endsection
@section('scripts')
    <script>
        let serviceDefaultColor = "#f5365c";
        let serviceDescription = '{{__('messages.service_placeholder.add_service_description')}}'
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/pickr.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/color-picker.js') }}"></script>
    <script src="{{mix('assets/js/service/service.js')}}"></script>
@endsection
