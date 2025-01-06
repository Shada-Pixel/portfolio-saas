@extends('layouts.app')
@section('title')
    {{__('messages.recent_work_details')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-pricing">
                    <div class="col-lg-6 col-7 custom-pricing-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.recent_work_details')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right custom-recent-work-size-btn">
                        <a href="{{route('recent-works.index')}}" class="btn btn-neutral btn-group-lg recent-work-btn">{{__('messages.back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4"> 
            <div class="card-body">
                @include('recent_work.show_field')
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/recent_works/recent_work.js')}}"></script>
@endsection
