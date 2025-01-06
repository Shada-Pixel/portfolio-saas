@extends('layouts.app')
@section('title')
{{__('messages.recent_work_type')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-work-type">
                    <div class="col-lg-6 col-7 custom-work-type-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.recent_work_type')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right custom-work-btn">
                        <a href="#" class="btn btn-group-lg btn-neutral work-type-btn" data-toggle="modal"
                           data-target="#recentWorkTypesModal">{{__('messages.new_recent_work_type')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('recent_work_type.table')
            </div>
        </div>
        @include('recent_work_type.create_model')
        @include('recent_work_type.edit_model')
        @include('recent_work_type.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/recent_work_types/recent_work_type.js')}}"></script>
@endsection

