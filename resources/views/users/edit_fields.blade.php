<div class="row">
    <div class="form-group col-md-6">
        {{ Form::label('first_name', __('messages.first_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('first_name', null, ['class' => 'form-control', 'maxlength' => 255, 'required', 'placeholder' =>  __('messages.enter_first_name')]) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('first_name', __('messages.last_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => 255, 'required', 'placeholder' => __('messages.enter_last_name')]) }}
    </div>


{{--    <div class="form-group col-md-6">--}}
{{--        {{ Form::label('phone', __('messages.phone').':') }}<span class="text-danger">*</span>--}}
{{--        {{ Form::tel('phone', isset($user)?$user->phone:null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber', 'required']) }}--}}
{{--        {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}--}}
{{--        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>--}}
    {{--        <span id="error-msg" class="hide"></span>--}}
    {{--    </div>--}}

    <div class="form-group col-md-6">
        {{ Form::label('phone', __('messages.phone').':') }}<span class="text-danger">*</span>
        <div class="d-flex">
            <div class="region-code">
                <button type="button" class="btn btn-default mr-0 f16 dropdown-toggle region-code-button"
                        id="dropdownMenuButton" data-toggle="dropdown">
                    <span class="flag {{ (isset($user) && !empty($user->region_code_flag)) ? $user->region_code_flag : getAdminSettingValue('default_region_code_flag') }}"
                          id="btnFlag"></span>
                    <span class="btn-cc">&nbsp;&nbsp;{{ isset($user) && !empty($user->region_code) ? '+'.$user->region_code : '+'.getAdminSettingValue('default_region_code') }}&nbsp;&nbsp;</span>
                    <span class="caretButton"></span>
                </button>
                <div class="region-code-div" aria-labelledby="dropdownMenuButton">
                    <ul class="f16 dropdown-menu region-code-ul">
                        <div class="region-code-ul-input-div"><input type="text" class="form-control search-country"/>
                        </div>
                        <div class="region-code-ul-div"></div>
                    </ul>
                </div>
            </div>
            <input type="tel" class="form-control" name="phone" id="phoneNumber"
                   value="{{ isset($user) ? $user->phone :null }}"
                   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required/>
            <input type="hidden" name="region_code" id="regionCode"
                   value="{{ isset($user) && !empty($user->region_code) ? $user->region_code : getAdminSettingValue('default_region_code')  }}"/>
            <input type="hidden" name="region_code_flag" id="regionCodeFlag"
                   value="{{ isset($user) && !empty($user->region_code_flag) ? $user->region_code_flag : getAdminSettingValue('default_region_code_flag') }}"/>
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
    </div>


    <div class="form-group col-md-6">
        {{ Form::label('email', __('messages.email').':') }}<span class="text-danger">*</span>
        {{ Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.enter_email')]) }}
    </div>

    {{--    <div class="col-md-4">--}}
    {{--        <div class="form-group">--}}
    {{--            {{ Form::label('password', 'Password:') }}<span class="text-danger">*</span>--}}
    {{--            {{ Form::password('password', ['class' => 'form-control','required','min' => '6','max' => '10','placeholder'=>'Enter Password']) }}--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="col-md-4">--}}
    {{--        <div class="form-group">--}}
    {{--            {{ Form::label('password_confirmation', 'Confirmation Password:') }}<span class="text-danger">*</span>--}}
    {{--            {{ Form::password('password_confirmation', ['class' => 'form-control','required','min' => '6','max' => '10', 'placeholder'=>'Enter Confirm Password']) }}--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('dob', __('messages.dob').':') }}
            {{ Form::text('dob', !empty($user->dob) ? \Carbon\Carbon::parse($user->dob)->format('m/d/Y') : null, ['class' => 'form-control datepicker', 'placeholder' => __('messages.select_dob'), 'data-date-end-date'=>"0d", 'autocomplete'=>'off']) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('experience', __('messages.experience').':') }}<span>{{__('messages.in_year')}}</span>
            {{ Form::text('experience',null , ['class' => 'form-control', 'step'=>'any', 'placeholder' => __('messages.enter_experience'),'min'=>0,'maxlength'=>'2', 'onkeyup'=>"if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"]) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('job_title', __('messages.job_title').':') }}<span class="text-danger">*</span>
            {{ Form::text('job_title', null, ['class' => 'form-control', 'required', 'placeholder' =>  __('messages.enter_job_title')]) }}
        </div>
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('country',__('messages.country').':') }}<span class="text-danger">*</span>
        {{ Form::select('country_id', $countries, null, ['id'=>'countryId', 'class' => 'form-control', 'placeholder' => __('messages.select_country'), 'required']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('state',__('messages.state').':') }}<span class="text-danger">*</span>
        {{ Form::select('state_id', (isset($states) && $states != null ? $states : []), null, ['id'=>'stateId', 'class' => 'form-control', 'placeholder' => __('messages.select_state'), 'required']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('city',__('messages.city').':') }}<span class="text-danger">*</span>
        {{ Form::select('city_id', (isset($cities) && $cities != null ? $cities :[]), null, ['id'=>'cityId', 'class' => 'form-control', 'placeholder' => __('messages.select_city'),'required']) }}
    </div>
    <div class="form-group col-md-12 custom-control-alternative custom-checkbox ml-4 p-3">
        <input type="checkbox" id="remember" name="available_as_freelancer" value="1" class="custom-control-input"
               @if($user->available_as_freelancer == true) checked @endif>
        <label class="custom-control-label" for="remember"><h4
                    class="font-weight-normal text-dark">{{__('messages.available_as_freelancer')}}</h4>
        </label>
    </div>

    <div class="col-md-6 theme-setting-field d-none">
        <div class="form-group">
            {{ Form::label('project', __('messages.project').':') }}<span>{{__('messages.in_year')}}</span>
            {{ Form::text('project', null, ['class' => 'form-control', 'maxlength' => 4, 'placeholder' =>  __('messages.enter_project')]) }}
        </div>
    </div>
    <div class="col-md-6 theme-setting-field d-none">
        <div class="form-group">
            {{ Form::label('support', __('messages.support').':') }}
            {{ Form::text('support', null, ['class' => 'form-control', 'maxlength' => 15, 'placeholder' =>  __('messages.enter_support')]) }}
        </div>
    </div>
    <div class="col-md-12 theme-setting-field d-none">
        <div class="form-group">
            {{ Form::label('job_description', __('messages.job_description').':') }}
            {{ Form::textarea('job_description', null, ['class' => 'form-control', 'cols' =>3, 'id'=>'userJobDescription', 'placeholder' => __('messages.job_description')]) }}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('about_me', __('messages.about_me').':') }}<span class="text-danger">*</span>
            {{ Form::textarea('about_me', null, ['class' => 'form-control', 'cols'=>3, 'id'=>'userAboutMe', 'required', 'placeholder' => __('messages.about_me_text')]) }}
        </div>
    </div>

    <div class="form-group col-sm-12 d-flex">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnProfileSave', 'data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-light text-dark">{{__('messages.cancel')}}</a>
    </div>
</div>
