@extends('layouts.app')
@section('title')
    {{__('messages.experiences')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-experience-edit">
                    <div class="col-lg-6 col-4 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.experiences')}}</h6>
                    </div>
                    <div class="col-lg-6 col-8 text-right d-flex experience-alignment">
                        <div class="ml-auto text-center mr-3 custom_all_button mt-2rem">
                            {{ Form::select('work_here', $workArr, null, ['id' => 'work_here', 'class' => 'form-control' ,'placeholder' => __('messages.experience_placeholder.select_work_here')]) }}
                        </div>
                        <div class="mt-2rem custom_exp_button">
                            <a href="{{route('experiences.create')}}" class="btn btn-group-lg btn-neutral btn-exp-size">{{__('messages.new_experience')}}</a>
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
                @include('experience.table')
            </div>
        </div>
        @include('experience.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/experience/experience.js')}}"></script>
@endsection
