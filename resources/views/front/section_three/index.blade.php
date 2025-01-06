@extends('layouts.app')
@section('title')
    {{__('messages.front_side_cms.section_three')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-testimonials">
                    <div class="px-3 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.front_side_cms.section_three')}}</h6>
                    </div>
                    <div class="px-3 ml-auto text-right custom-test-btn">
                        <a href="{{route('section-three.create')}}"
                           class="btn btn-group-lg btn-neutral btn-exp-size">{{__('messages.front_side_cms.create_section')}}</a>
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
                @include('front.section_three.table')
            </div>
        </div>
        @include('front.section_three.templates.templates')
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/front/sections/section-three/section-three.js') }}"></script>
@endsection
