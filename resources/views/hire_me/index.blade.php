@extends('layouts.app')
@section('title')
{{__('messages.hire_requests')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 d-flex">
                    <div class="col-lg-6 col-12 custom-hireme-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.hire_requests')}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('hire_me.table')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/hire_me/hire_me.js') }}"></script>
@endsection
