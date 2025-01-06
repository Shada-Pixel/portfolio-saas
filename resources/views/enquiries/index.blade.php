@extends('layouts.app')
@section('title')
{{__('messages.enquires')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 d-flex enquires-alignment">
                    <div class="col-lg-6 col-7 enquires-title">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.enquires')}}</h6>
                    </div>
                    <div class="ml-auto text-center enquires-btn mt-2rem">
                        {{ Form::select('status', $statusArr, null, ['id' => 'filter_status', 'class' => 'form-control status-filter' , 'placeholder' => __('messages.enquiries.select_status')]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('enquiries.table')
            </div>
        </div>
        @include('enquiries.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let userRole = '{{getLoggedInUser()->hasRole('super_admin')}}';
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/enquiry/enquiry.js') }}"></script>
@endsection
