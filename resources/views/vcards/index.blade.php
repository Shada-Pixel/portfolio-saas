@extends('layouts.app')
@section('title')
    {{__('messages.vCards.VCards')}}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-skill">
                    <div class="col-lg-6 col-7 custom-skill-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.vCards.VCards')}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right btn-skill">
                        <a href="{{route('vcards.create')}}"
                           class="btn btn-group-lg btn-neutral custom-skill-btn">{{__('messages.vCards.new_vcards')}}
                        </a>
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
                @include('vcards.table')
            </div>
        </div>
        @include('vcards.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/vcards/vcards.js') }}"></script>
@endsection

