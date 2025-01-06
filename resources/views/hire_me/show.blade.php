@extends('layouts.app')
@section('title')
{{__('messages.hire_request.hire_request_details')}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-hire-details">
                    <div class="col-lg-6 col-7 custom-details-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.hire_request.hire_request_details')}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right hire-btn">
                        <a href="{{route('hire-me.index')}}"
                           class="btn btn-group-lg btn-neutral custom-hire-btn">{{{__('messages.back')}}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('hire_me.show_fields')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
