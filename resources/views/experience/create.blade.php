@extends('layouts.app')
@section('title')
    {{__('messages.create_experiences')}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-experience-edit">
                    <div class="col-lg-6 col-7 experience-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.new_experience')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right exp-size">
                        <a href="{{route('experiences.index')}}" class="btn btn-group-lg btn-neutral exp-btn">{{__('messages.back')}}</a>
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
                {{ Form::open(['route' => 'experiences.store','method'=>'post','id' =>'createExperienceForm']) }}
                @include('experience.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let edit = false;
        let selectState = "{{ __('messages.select_state') }}";
        let selectCity = "{{ __('messages.select_city') }}";
    </script>
    <script src="{{ mix('assets/js/experience/create-edit.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{ mix('assets/js/custom/country-state-city.js') }}"></script>
@endsection
