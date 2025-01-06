<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="planCurrencyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planCurrencyModalLabel">{{__('messages.pricing_plan_currency.edit_plan_currency')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert-danger alert d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'planCurrencyUpdateForm','method'=>'post']) }}
                {{ Form::hidden('id',null,['id' => 'planCurrencyId']) }}
                <div class="form-group">
                    {{ Form::label('currency name', __('messages.pricing_plan_currency.currency_name').':') }}<span class="text-danger">*</span>
                    {{ Form::text('currency_name', null , ['class' => 'form-control','id' => 'editName','placeholder' => __('messages.pricing_plan_currency.enter_currency_name'),'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('currency code', __('messages.pricing_plan_currency.currency_code').':') }}<span class="text-danger">*</span>
                    {{ Form::text('currency_code', null , ['class' => 'form-control','id' => 'editCode','placeholder' => __('messages.pricing_plan_currency.enter_currency_code'),'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('currency icon', __('messages.pricing_plan_currency.currency_icon').':') }}<span class="text-danger">*</span>
                    {{ Form::text('currency_icon', null , ['class' => 'form-control','id' => 'editIcon','placeholder' => __('messages.pricing_plan_currency.enter_currency_icon'), 'required']) }}
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'planCurrencySaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


