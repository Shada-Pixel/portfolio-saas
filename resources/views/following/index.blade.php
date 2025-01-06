@extends('layouts.app')
@section('title')
    {{__('messages.followers.following')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-4 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.followers.following')}}</h6>
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
                @include('following.table')
            </div>
        </div>
        @include('following.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let unfollowUser = "{{ route('following.unfollowUser') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/following/following.js')}}"></script>
@endsection
