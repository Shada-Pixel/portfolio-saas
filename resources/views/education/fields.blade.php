<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('school_name', __('messages.school_name').':') }}<span class="text-danger">*</span>
            {{ Form::text('school_name', null , ['class' => 'form-control','placeholder' => __('messages.education_placeholder.enter_school_name'),'maxlength' => 170,'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('qualification', __('messages.qualification').':') }}<span class="text-danger">*</span>
            {{ Form::text('qualification', null , ['class' => 'form-control','placeholder' => __('messages.education_placeholder.enter_qualification'),'maxlength' => 170,'required']) }}
        </div>
    </div>

    <div class="form-group col-lg-4 col-md-6">
        {{ Form::label('country',__('messages.country').':') }}<span class="text-danger">*</span>
        {{ Form::select('country_id', $countries, null, ['id'=>'countryId','class' => 'form-control','placeholder' => __('messages.select_country'),'required']) }}
    </div>
    <div class="form-group col-lg-4 col-md-6">
        {{ Form::label('state',__('messages.state').':') }}<span class="text-danger">*</span>
        {{ Form::select('state_id', [], null, ['id'=>'stateId','class' => 'form-control','placeholder' => __('messages.select_state'),'required']) }}
    </div>
    <div class="form-group col-lg-4 col-md-6">
        {{ Form::label('city',__('messages.city').':') }}<span class="text-danger">*</span>
        {{ Form::select('city_id', [], null, ['id'=>'cityId','class' => 'form-control','placeholder' => __('messages.select_city'),'required']) }}
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('start_date', __('messages.start_date').':') }}<span class="text-danger">*</span>
            {{--            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.before_start_date')}}"></i>--}}
            {{ Form::text('start_date',null, ['class' => 'form-control datepicker', 'id'=>'startDate', 'required','placeholder'=> __('messages.select_start_date'),'data-date-end-date'=>"0d",'autocomplete'=>'off']) }}
            {{--            ,'data-date-end-date'=>"0d",'data-date-start-date'=>\Carbon\Carbon::parse(getUserDate())->format('m/d/Y')--}}
        </div>
    </div>

    <div class="col-lg-4 col-md-6 d-none endDateDiv">
        <div class="form-group">
            {{ Form::label('end_date', __('messages.end_date').':') }}
            {{ Form::text('end_date',null, ['class' => 'form-control datepicker end-date', 'id'=>'endDate', 'placeholder'=> __('messages.select_end_date'),'data-date-end-date'=>"0d",'autocomplete'=>'off']) }}
        </div>
    </div>

    <div class="form-group col-lg-4 col-md-6">
        {{ Form::label('current study here',__('messages.current_study_here').':') }}<br>
        <label class="custom-toggle">
            <input type="checkbox" name="currently_studying_here" value="1" checked class="currentStudyHere">
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>
    </div>

    <div class="col-12 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('educations.index') }}" class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
