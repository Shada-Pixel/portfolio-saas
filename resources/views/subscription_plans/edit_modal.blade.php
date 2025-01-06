<div class="modal fade pr-0 overflow-hidden" id="editSubscriptionPlanModal" role="dialog"
     aria-labelledby="editSubscriptionPlanModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="editSubscriptionPlanModalLabel">{{__('messages.subscription_plans.edit_subscription_plan')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert-danger alert d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'editSubscriptionForm','method'=>'post']) }}
                {{ Form::hidden('id', null, ['id' => 'subscriptionId']) }}
                <div class="row">
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('name', __('messages.subscription_plans.name').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('name', null , ['class' => 'form-control','required','placeholder' => __('Entry Plan Name'),'id'=>'editName']) }}
                    </div>
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('currency', __('messages.subscription_plans.currency').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::select('currency_id', [], null, ['placeholder' => 'Select Currency','required','id' => 'editCurrency', 'class' => 'select2Selector']) }}
                    </div>
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('price', __('messages.subscription_plans.price').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('price', null , ['class' => 'form-control price-input edit-price','required','placeholder' => 'Enter price','maxlength' => '4','id'=>'editPrice']) }}
                    </div>
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('plan_type', __('messages.subscription_plans.plan_type').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::select('plan_type', $planType, null, ['required', 'id' => 'editPlanType']) }}
                    </div>
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('valid_until', __('messages.subscription_plans.valid_until').':') }}<span
                                class="text-danger">*</span><i
                                class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                                data-placement="top"
                                title="{{__('messages.subscription_plans.valid_until_tooltip')}}"></i>
                        {{ Form::text('valid_until', null , ['class' => 'form-control edit-valid-until','required','maxlength' => '4','placeholder' => 'Enter valid until','id'=>'editValidUntil','onkeyup' => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"]) }}
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


