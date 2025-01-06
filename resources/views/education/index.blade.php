@extends('layouts.app')
@section('title')
    {{__('messages.educations')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 content-responsive">
                    <div class="col-lg-6 col-4 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.educations')}}</h6>
                    </div>
                    <div class="col-lg-6 col-8 text-right d-flex education-alignment">
                        <div class="ml-auto text-center mr-3 custom_all_button mt-2rem">
                            {{ Form::select('study_here', $studyArr, null, ['id' => 'study_here', 'class' => 'form-control', 'placeholder' => __('messages.education_placeholder.select_study_here')]) }}
                        </div>
                        <div class="mt-2rem custom_edu_button">
                            <a href="{{route('educations.create')}}" class="btn btn-group-lg btn-neutral btn-edu-size">{{__('messages.new_education')}}</a>
                        </div>
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
                @include('education.table')
            </div>
        </div>
        @include('education.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/education/education.js')}}"></script>
@endsection
