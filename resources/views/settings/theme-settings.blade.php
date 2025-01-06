@extends('settings.index')
@section('title')
    {{__('messages.theme_settings')}}
@endsection
@section('section')
    @php
        $themeLayout = getSettingValue('theme_layout')
    @endphp
    {{ Form::open(['route' => ['settings.updateTheme'],'method'=>'post']) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('choose_template', __('messages.choose_theme').':') }}<span
                    class="text-danger">*</span>
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 vcard-template">
            <label class="img-btn w-100">
                <input type="radio" class="theme-layout" name="theme_layout"
                       value="1" {{$themeLayout == \App\Models\Setting::TEMPLATE_ONE ? 'checked' : ''}}>
                <div class="image-theme w-100">
                    <img src="{{ asset('assets/web/css/images/theme1.png') }}"
                         class="img-thumbnail-preview active-img1 {{$themeLayout == \App\Models\Setting::TEMPLATE_ONE ? 'activeTheme' : ''}} height-inherit w-100"
                         alt="Theme 1">
                </div>
            </label>
            <a class="btn btn-primary btn-block" href="{{ asset('assets/web/css/images/theme1_preview.png') }}"
               target="_blank">Preview</a>
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 vcard-template">
            <label class="img-btn w-100">
                <input type="radio" class="theme-layout" name="theme_layout"
                       value="2" {{$themeLayout == 2 ? 'checked' : ''}}>
                <div class="image-theme w-100">
                    <img src="{{ asset('assets/web/css/images/theme2.png') }}" id="#img2"
                         class="img-thumbnail-preview active-img2  {{$themeLayout == \App\Models\Setting::TEMPLATE_TWO ? 'activeTheme' : ''}} height-inherit w-100"
                         alt="Theme 2">
                </div>
            </label>
            <a class="btn btn-primary btn-block" href="{{ asset('assets/web/css/images/theme2_preview.png') }}"
               target="_blank">Preview</a>
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 vcard-template">
            <label class="img-btn w-100">
                <input type="radio" class="theme-layout" name="theme_layout"
                       value="3" {{$themeLayout == 3 ? 'checked' : ''}}>
                <div class="image-theme w-100">
                    <img src="{{ asset('assets/web/css/images/theme3.png') }}" id="#img3"
                         class="img-thumbnail-preview active-img3  {{$themeLayout == \App\Models\Setting::TEMPLATE_THREE ? 'activeTheme' : ''}} height-inherit w-100"
                         alt="Theme 3">
                </div>
            </label>
            <a class="btn btn-primary btn-block" href="{{ asset('assets/web/css/images/theme3_preview.png') }}"
               target="_blank">Preview</a>
        </div>
    </div>
    <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('settings.index') }}" class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
    {{ Form::close() }}
@endsection
