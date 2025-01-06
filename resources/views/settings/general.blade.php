@extends('settings.index')
@section('title')
{{__('messages.general_settings')}}
@endsection
@section('section')
    {{ Form::open(['route' => [getLoggedInUser()->hasRole('super_admin') ? 'admin.settings.update' : 'settings.update'],'method'=>'post','id'=>'editSetting','files'=>true]) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    @method('PUT')
    <div class="row">
        <div class="form-group col-sm-6">
            {{ Form::label('company name', __('messages.company_name').':') }}<span class="text-danger">*</span>
            {{ Form::text('company_name',$settings['company_name'], ['class' => 'form-control','maxlength' => 255,'required','placeholder' => __('messages.experience_placeholder.enter_company_name'),'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('website', __('messages.website').':') }}<span class="text-danger">*</span>
            {{ Form::text('website', $settings['website'], ['class' => 'form-control','maxlength' => 255,'required','id'=>'website','placeholder' => __('messages.settings_placeholder.enter_website')]) }}
        </div>
        
{{--        <div class="form-group col-md-6">--}}
{{--            {{ Form::label('phone', __('messages.phone').':') }}<span class="text-danger">*</span>--}}
{{--            {{ Form::tel('phone', preparePhoneNumber($settings['phone'],$settings['region_code']), ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber','required']) }}--}}
{{--            {{ Form::hidden('region_code',$settings['region_code'],['id'=>'prefix_code']) }}--}}
{{--            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>--}}
        {{--            <span id="error-msg" class="hide"></span>--}}
        {{--        </div>--}}

        <div class="form-group col-md-6">
            {{ Form::label('phone', __('messages.phone').':') }}<span class="text-danger">*</span>
            <div class="d-flex">
                <div class="region-code">
                    <button type="button" class="btn mr-0 btn-default f16 dropdown-toggle region-code-button"
                            id="dropdownMenuButton" data-toggle="dropdown">
                        <span class="flag {{ isset($settings) && !empty($settings['region_code_flag']) ? $settings['region_code_flag'] : getAdminSettingValue('default_region_code_flag') }}"
                              id="btnFlag"></span>
                        <span class="btn-cc">&nbsp;&nbsp;{{  isset($settings)  && !empty($settings['region_code']) ? '+'.$settings['region_code'] : '+'.getAdminSettingValue('default_region_code') }}&nbsp;&nbsp;</span>
                        <span class="caretButton"></span>
                    </button>
                    <div class="region-code-div" aria-labelledby="dropdownMenuButton">
                        <ul class="f16 dropdown-menu region-code-ul">
                            <div class="region-code-ul-input-div">
                                <input type="text" class="form-control search-country"/>
                            </div>
                            <div class="region-code-ul-div"></div>
                        </ul>
                    </div>
                </div>
                <input type="tel" class="form-control setting-input" name="phone" id="phoneNumber"
                       value="{{ $settings['phone'] }}"
                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required/>
                <input type="hidden" name="region_code" id="regionCode" value="{{ $settings['region_code'] }}"/>
                <input type="hidden" name="region_code_flag" id="regionCodeFlag"
                       value="{{ $settings['region_code_flag'] }}"/>
                <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                <span id="error-msg" class="hide"></span>
            </div>
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('company_email', __('messages.email').':') }}<span class="text-danger">*</span>
            {{ Form::email('company_email', $settings['company_email'], ['class' => 'form-control', 'required','placeholder' => __('messages.enter_email'), 'id' => 'companyEmail']) }}
        </div>
        <div class="form-group col-md-6 general-setting">
            {{ Form::label('address', __('messages.address').':') }}<span class="text-danger">*</span>
            {{ Form::textarea('address', $settings['address'], ['class' => 'form-control','height-auto', 'rows' => 4, 'required','placeholder' => __('messages.settings_placeholder.enter_address')]) }}
        </div>
        <div class="form-group col-md-6 general-setting">
            {{ Form::label('contact_us', __('messages.contact_us').':') }}<span class="text-danger">*</span>
            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
               data-placement="top" title="{{__('messages.contact_text')}}"></i>
            {{__('messages.remaining_characters').':'}} <span id="characterCount"></span>
            {{ Form::textarea('contact_us', $settings['contact_us'], ['class' => 'form-control', 'id' => 'contactUsDescription','height-auto', 'rows' => 4,'maxlength' => '250','placeholder' => __('messages.settings_placeholder.enter_contact_us'), 'required']) }}
        </div>
        <div class="form-group col-lg-6 custom-company-logo">
            <div class="row">
                <div class="px-3">
                    {{ Form::label('company', __('messages.company_logo').':') }}<i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.company_logo_tooltip')}}"></i>
                    <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                        {{ Form::file('company_logo',['id'=>'companyLogo','class' => 'd-none']) }}
                    </label>
                </div>
                <div class="w-auto mt-2 pl-sm-0 pl-3">
                    <img id='companyLogoPreview' name="company_logo" class="img-thumbnail thumbnail-preview"
                         src="{{($settings['company_logo']) ? asset($settings['company_logo']) : asset('img/blue.png')}}">

                </div>
            </div>
        </div>
@role('super_admin')
        <div class="form-group col-lg-6 custom-company-logo">
            <div class="row">
                <div class="px-3">
                    {{ Form::label('favicon', __('messages.favicon').':') }}<i class="fas fa-question-circle ml-1 mt-1 general-question-mark"
                                                                               data-toggle="tooltip" data-placement="top"
                                                                               title="{{__('messages.favicon_text')}}"></i>
                    <label class="image__file-upload text-white">{{__('messages.choose')}}
                        {{ Form::file('favicon',['id'=>'favicon','class' => 'd-none']) }}
                    </label>
                </div>
                <div class="w-auto mt-2 pl-sm-0 pl-3">
                    <img id='faviconPreview' name="favicon" class="img-thumbnail thumbnail-preview"
                         src="{{($settings['favicon']) ? asset($settings['favicon']) : asset('img/favicon.png')}}">
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 general-setting">
            {{ Form::label('Contact Email', __('messages.contact_email').':') }}<span class="text-danger">*</span>
            {{ Form::email('contact_email', $settings['contact_email'], ['class' => 'form-control', 'required','placeholder' => __('messages.settings_placeholder.enter_contact_email'), 'id' => 'companyEmail']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('default_prefix_code', __('messages.default_prefix_code').':') }}
            <div class="d-flex">
                <div class="region-codes">
                    <button type="button" class="btn btn-default f16 dropdown-toggle region-code-button"
                            id="dropdownMenuButton" data-toggle="dropdown">
                        <span class="flag {{ $settings['default_region_code_flag'] }}" id="btnFlag"></span>
                        <span class="btn-cc">&nbsp;&nbsp;{{ '+'.$settings['default_region_code'] }}&nbsp;&nbsp;</span>
                        <span class="caretButton"></span>
                    </button>
                    <div class="default-region-code-div" aria-labelledby="dropdownMenuButton">
                        <ul class="f16 dropdown-menu default-region-code-ul">
                            <div class="default-region-code-ul-input-div">
                                <input type="text" class="form-control default-search-country"/>
                            </div>
                            <div class="default-region-code-ul-div"></div>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="default_region_code" id="regionCode"
                       value="{{ $settings['default_region_code'] }}"/>
                <input type="hidden" name="default_region_code_flag" id="regionCodeFlag"
                       value="{{ $settings['default_region_code_flag']  }}"/>
            </div>
        </div>
        @endrole
        <div class="form-group col-sm-12 mt-3">
            {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        </div>
    </div>

    {{ Form::close() }}
@endsection
