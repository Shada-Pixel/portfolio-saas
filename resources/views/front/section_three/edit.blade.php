@extends('layouts.app')
@section('title')
    {{__('messages.front_side_cms.edit_section')}}
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-experience-edit">
                    <div class="col-lg-6 col-7 experience-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.front_side_cms.edit_section')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right exp-size">
                        <a href="{{route('section-three.index')}}"
                           class="btn btn-group-lg btn-neutral exp-btn">{{__('messages.back')}}</a>
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
                {{ Form::model($sectionThree, ['route' => ['section-three.update',$sectionThree->id],'method'=>'put','id' =>'editSectionThreeForm', 'files' => true]) }}
                {{ Form::hidden('section',\App\Models\FrontCms::SECTION_THREE, ['id' => 'sectionNo']) }}
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                @include('front.section_three.edit_fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script src="{{ mix('assets/js/front/sections/section-three/create-edit.js') }}"></script>
@endsection
