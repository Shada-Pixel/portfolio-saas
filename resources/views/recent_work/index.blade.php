@extends('layouts.app')
@section('title')
    {{__('messages.recent_works')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 content-responsive">
                    <div class="col-lg-5 col-4 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.recent_works')}}</h6>
                    </div>
                    <div class="col-lg-7 col-8 text-right d-flex recent-alignment">
                        <div class="ml-auto text-left mr-3 custom_recent_button mt-2rem">
                            {{Form::select('type', $recentWorkTypes, null, ['id' => 'type_filter', 'class' => 'form-control','placeholder' => __('messages.recent_work_placeholder.select_work_type')]) }}
                        </div>
                        <div class="mt-2rem custom-recent-btn">
                            <a href="#" class="btn btn-group-lg btn-neutral btn-recent-size" data-toggle="modal"
                               data-target="#recentWorksModal">{{__('messages.new_recent_work')}}</a>
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
                @include('recent_work.table')
            </div>
        </div>
        @include('recent_work.create_model')
        {{--        @include('recent_work.attachment_modal')--}}
        @include('recent_work.edit_model')
        @include('recent_work.templates.templates')
    </div>
@endsection
@section('page_js')
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/recent_works/recent_work.js')}}"></script>
    <script>
        let downloadAttachments = '{{__('messages.download')}}'
    </script>
@endsection

