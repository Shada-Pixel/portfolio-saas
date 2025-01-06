@extends('settings.index')
@section('title')
    {{ __('messages.privacy_settings') }}
@endsection
@section('section')
    {{ Form::open(['route' => [getLoggedInUser()->hasRole('super_admin') ? 'admin.settings.update' : 'settings.update'],'method'=>'post','id'=>'editSetting','files'=>true]) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    @method('PUT')
    <div class="row">
        @role('super_admin')
        <div class="form-group col-md-12 general-setting">
            {{ Form::label('terms & condition', __('messages.terms_conditions').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('terms_conditions', null, ['class' => 'form-control', 'id' => 'termsAndConditions']) }}
        </div>
        <div class="form-group col-md-12 general-setting">
            {{ Form::label('privacy policy', __('messages.privacy_policy').':') }}<span class="text-danger">*</span>
            {{ Form::textarea('privacy_policy', null, ['class' => 'form-control', 'id' => 'privacyPolicy']) }}
        </div>
        <div class="form-group col-sm-12 mt-3">
            {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        </div>
        @endrole
    </div>

    {{ Form::close() }}
@endsection
