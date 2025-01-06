@extends('layouts.app')
@section('title')
{{__('messages.experience_details')}}
@endsection
@section('css')

@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-title">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 custom-title-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.experience_details')}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right custom-size-btn">
                        <a href="{{route('experiences.index')}}"
                           class="btn btn-group-lg btn-neutral custom-btn1">{{__('messages.back')}}</a>
                        <a href="{{route('experiences.edit',$experience->id)}}"
                           class="btn btn-group-lg btn-white custom-btn2">{{__('messages.edit')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('experience.show_field')
            </div>
        </div>
    </div>
@endsection
@section('page_js')

@endsection
