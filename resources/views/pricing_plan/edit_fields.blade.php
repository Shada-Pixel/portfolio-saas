<div class="row">
    <div class="form-group col-md-4">
        {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
        {{ Form::text('name', null , ['class' => 'form-control','placeholder' => __('messages.pricing_plan_placeholder.enter_name'),'maxlength' => 170,'required']) }}
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('type',__('messages.type').':') }}<span class="text-danger">*</span>
        {{ Form::select('type', $plans, null, ['id'=>'type','class' => 'form-control','placeholder' => __('messages.pricing_plan_placeholder.select_type'), 'required']) }}
    </div>

    <div class="form-group col-sm-4">
        {{ Form::label('color', __('messages.color').':') }}<span class="text-danger">*</span>
        <div class="edit-color-wrapper"></div>
        {{ Form::text('color', $pricingPlan->color, ['id' => 'edit_color', 'hidden', 'class' => 'form-control color']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('price', __('messages.price').':') }}<span class="text-danger">*</span>
        {{ Form::text('price', $pricingPlan->price, ['class' => 'form-control currency', 'placeholder' => __('messages.pricing_plan_placeholder.enter_price'), 'required', 'maxlength' => '6',  'autocomplete'=>'off']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('plan currency', __('messages.pricing_plan_currency.plan_currency').':') }}<span class="text-danger">*</span>
        {{ Form::select('currency_id', $planCurrencies, null, ['class' => 'form-control','id'=>'planCurrency', 'placeholder' => __('messages.pricing_plan_currency.enter_plan_currency'), 'required', 'autocomplete'=>'off']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('plan type', __('messages.plan_type').':') }}<span class="text-danger">*</span>
        {{ Form::select('plan_type', $planType, null, ['class' => 'form-control', 'id' => 'editPlanType', 'placeholder' => __('messages.pricing_plan_placeholder.enter_plan_type'), 'required']) }}
    </div>
    <div class="form-group col-12">
        <div class="row">
            <div class="px-3">
                {{ Form::label('Image', __('messages.image').':') }}<span class="text-danger">*</span>
                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                   data-placement="top" title="{{__('messages.svgTooltipText')}}"></i>
                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                    {{ Form::file('icon',['id'=>'icon','class' => 'd-none']) }}
                </label>
            </div>
            <div class="w-auto mt-2">
                <img id='iconPreview' class="img-thumbnail thumbnail-preview"
                     src="{{isset($pricingPlan->media[0])?$pricingPlan->icon_image:asset('img/infyom-logo.png')}}">
            </div>
        </div>
    </div>
    <hr>

    <div class="col-sm-12 mt-3">
        <div class="mb-3 h5">
            {{__('messages.edit_plan_attribute')}}:<span class="text-danger">*</span>
        </div>
        <table class="table table-bordered table-responsive-sm" id="planAttributeTbl">
            <thead class="">
            <tr class="text-center">
                <th class="text-center custom-text-alignment">#</th>
                <th class="plan-attribute-filed pb-3">{{__('messages.attribute_icon')}}
                </th>
                <th class="plan-attribute-filed pb-3">{{__('messages.attribute_name')}}<span class="text-danger">*</span>
                </th>
                <th>
                    <button type="button" class="btn btn-sm btn-primary float-right w-100"
                            id="addItem"><i class="fa fa-plus"></i></button>
                </th>
            </tr>
            </thead>
            <tbody class="plan-attribute-container">
            @foreach($pricingPlan->planAttributes as $key => $planAttribute)
                <tr>
                    <td class="text-center item-number custom-number">{{$key+1}}</td>
                    <td>
                        <button class="btn btn-primary button-icon-size iconpicker dropdown-toggle editPlanAttributeIcon"
                                data-iconset="fontawesome5"
                                data-icon="{{$planAttribute->attribute_icon}}" role="iconpicker" data-original-title=""
                                title="" aria-describedby="popover984402" data-id="{{$key+1}}">
                        </button>
                        <input class="form-control plan-icon edit-plan-attribute-icon{{$key+1}}" name="attribute_icon[]"
                               type="text" hidden value="{{$planAttribute->attribute_icon}}">
                    </td>
                    <td>
                        <input class="form-control plan-name" name="attribute_name[]" pattern="^\S[a-zA-Z ]+$" title="Attribute Name Not Allowed White Space" type="text" required
                               value="{{$planAttribute->attribute_name}}" placeholder="{{__('messages.pricing_plan_placeholder.enter_attribute_name')}}">
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)"
                           class="btn btn-danger btn-icon-only-action rounded-circle delete-plan-attribute">
                            <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('pricing-plans.index') }}" class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
