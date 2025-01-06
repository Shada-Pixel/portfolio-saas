<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('job_title', __('messages.job_title').':') }}<span class="text-danger">*</span>
            {{ Form::text('job_title', null , ['class' => 'form-control','placeholder' => __('messages.enter_job_title'),'maxlength' => 170,'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('company', __('messages.company').':') }}<span class="text-danger">*</span>
            {{ Form::text('company', null , ['class' => 'form-control','placeholder' => __('messages.experience_placeholder.enter_company_name'),'maxlength' => 170,'required']) }}
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
            {{ Form::text('start_date',null, ['class' => 'form-control datepicker','required','placeholder'=> __('messages.select_start_date'),'data-date-end-date'=>"0d",'autocomplete'=>'off', 'id'=>'startDate']) }}
        </div>
    </div>

    <div class="col-lg-4 col-md-6 d-none endDateDiv">
        <div class="form-group">
            {{ Form::label('end_date', __('messages.end_date').':') }}<span class="text-danger">*</span>
            {{ Form::text('end_date',null, ['class' => 'form-control datepicker end-date','placeholder'=> __('messages.select_end_date'),'data-date-end-date'=>"0d",'autocomplete'=>'off', 'id'=>'endDate']) }}
        </div>
    </div>

    <div class="form-group col-lg-4 col-md-6">
        {{ Form::label('city',__('messages.current_work_here').':') }}<br>
        <label class="custom-toggle">
            <input type="checkbox" name="currently_work_here" value="1" checked class="currentWorkHere">
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>
    </div>

    <div class="col-12 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('experiences.index') }}" class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
