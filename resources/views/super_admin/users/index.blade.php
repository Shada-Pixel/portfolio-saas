@extends('layouts.app')
@section('title')
    {{__('messages.admin_users.users')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/nano.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 d-flex content-responsive">
                    <div class="col-lg-3 col-md-3 col-5 content-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.admin_users.users')}}</h6>
                    </div>
                    <div class="col-lg-9 col-md-8 col-6   text-right d-flex experience-alignment">
                        <div class="ml-auto text-center available-freelancer mt-2rem">
                            {{ Form::select('available_as_freelancer', $available_as_freelancer, null, ['id' => 'available_as_freelancer', 'class' => 'form-control', 'placeholder' => 'Select Freelancer' ]) }}
                        </div>
                        <div class="text-center custom_all_button mt-2rem">
                            {{ Form::select('status', $userStatus, null, ['id' => 'status', 'class' => 'form-control', 'placeholder' => 'Select Status' ]) }}
                        </div>
                        <div class="mt-2rem custom_exp_button">
                            <a href="{{route('users.create')}}"
                               class="btn btn-group-lg btn-neutral btn-exp-size">{{__('messages.admin_users.new_user')}}</a>
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
                @include('super_admin.users.table')
            </div>
        </div>
        @include('super_admin.users.templates.templates')
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/admin_users/users.js') }}"></script>
@endsection
