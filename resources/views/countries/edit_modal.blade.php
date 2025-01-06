<div class="modal fade pr-0" id="editModal" tabindex="-1" role="dialog" aria-labelledby="countryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="countryModalLabel">{{__('messages.countries.edit_country')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert-danger alert d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'editCountryForm','method'=>'post']) }}
                {{ Form::hidden('id', null, ['id' => 'countryFieldId']) }}
                <div class="row">
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('name', __('messages.countries.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null , ['class' => 'form-control','required','placeholder' => __('messages.countries.name'),'id'=>'editName']) }}
                    </div>
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('short_code', __('messages.countries.short_code').':') }}
                        {{ Form::text('short_code', null , ['class' => 'form-control','placeholder' => __('messages.countries.short_code'),'id'=>'editShortCode']) }}
                    </div>
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('phone_code', __('messages.countries.phone_code').':') }}
                        {{ Form::text('phone_code', null , ['class' => 'form-control', 'maxlength' => '4','placeholder' => __('messages.countries.phone_code'),'id'=>'editPhoneCode']) }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'editSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


