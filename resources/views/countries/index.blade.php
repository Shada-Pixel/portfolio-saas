@extends('layouts.app')
@section('title')
    {{__('messages.countries.countries')}}
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
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.countries.countries')}}</h6>
                    </div>
                    <div class="col-lg-6 col-6 text-right categories-btn">
                        <a href="#" class="btn btn-group-lg btn-neutral custom-button-size" data-toggle="modal"
                           data-target="#countryModal">{{__('messages.countries.new_country')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('countries.table')
            </div>
        </div>
        @include('countries.create_modal')
        @include('countries.edit_modal')
        @include('countries.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/countries/countries.js')}}"></script>
@endsection

