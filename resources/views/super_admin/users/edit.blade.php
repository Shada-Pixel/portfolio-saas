@extends('layouts.app')
@section('title')
    {{__('messages.admin_users.edit_user')}}
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-experience-edit">
                    <div class="col-lg-6 col-7 experience-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.admin_users.edit_user')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right exp-size">
                        <a href="{{route('users.index')}}"
                           class="btn btn-group-lg btn-neutral exp-btn">{{__('messages.back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('layouts.errors')
                {{ Form::model($user, ['route' => ['admin.users.update',$user->id],'method'=>'put','id' =>'editUserForm']) }}
                @include('super_admin.users.edit_fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let editUsername = '{{$user->user_name}}';
    </script>
    <script src="{{ mix('assets/js/admin_users/create-edit.js') }}"></script>
@endsection
