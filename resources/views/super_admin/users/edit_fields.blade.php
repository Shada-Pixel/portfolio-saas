<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('first_name', __('messages.admin_users.first_name').':') }}<span class="text-danger">*</span>
            {{ Form::text('first_name', null , ['class' => 'form-control','placeholder' => __('messages.admin_users.first_name'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('last_name', __('messages.admin_users.last_name').':') }}<span class="text-danger">*</span>
            {{ Form::text('last_name', null , ['class' => 'form-control','placeholder' => __('messages.admin_users.last_name'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('user_name', __('messages.admin_users.user_name').':') }}<span class="text-danger">*</span>
            {{ Form::text('user_name', null , ['class' => 'form-control','placeholder' => __('messages.admin_users.user_name'), 'required', 'readonly', 'id' => 'editUsername']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('email', __('messages.admin_users.email').':') }}<span class="text-danger">*</span>
            {{ Form::email('email', null , ['class' => 'form-control','placeholder' => __('messages.admin_users.email'), 'required']) }}
        </div>
    </div>
    <div class="col-12 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('users.index') }}" class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
