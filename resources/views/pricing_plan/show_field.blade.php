<div class="row details-page">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.name').':') }}
        <p>{{ html_entity_decode($pricingPlan->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('type', __('messages.type').':') }}
        <p>{{ \App\Models\PricingPlan::PRICING_PLAN_TYPE[$pricingPlan->type] }}</p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('Image', __('messages.image').':') }}
        <br><img src="{{ $pricingPlan->icon_image}}" height="50" width="50" alt="">
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('color', __('messages.color').':') }}
        @php
            $inStyle = 'style';
            $color = 'background:'.$pricingPlan->color.';height:50px'.';width:50px';
        @endphp
        <p {{ ($pricingPlan->color == '#FFFFFF') ? $inStyle."=background:#f5365c;height:50px;width:50px;" : $inStyle.'='.$color }}></p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('price', __('messages.price').':') }}
        <p>{{ html_entity_decode($pricingPlan->price) }}</p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('currency', __('messages.pricing_plan_currency.plan_currency').':') }}
        <p>{{ html_entity_decode(!empty($pricingPlan->currency->currency_icon) ? $pricingPlan->currency->currency_icon.$pricingPlan->currency->currency_name: 'N/A') }}</p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('plan type', __('messages.plan_type').':') }}
        <p>{{ \App\Models\PricingPlan::PLAN_TYPE[$pricingPlan->plan_type] }}</p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($pricingPlan->created_at)) }}">{{ $pricingPlan->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($pricingPlan->updated_at)) }}">{{ $pricingPlan->updated_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="col-sm-12 mt-3">
        <div class="mb-1 form-group">
            {{ Form::label('plan attribute', __('messages.plan_attributes').':') }}
        </div>
        <table class="table table-bordered table-responsive-sm">
            <thead class="text-center">
            <tr>
                <th class="plan-attribute-filed">{{__('messages.attribute_icon')}}
                </th>
                <th class="plan-attribute-filed">{{__('messages.attribute_name')}}
                </th>
            </tr>
            </thead>
            <tbody class="plan-attribute-container">
            @forelse($pricingPlan->planAttributes as $planAttribute)
                <tr>
                    <td>
                        @if($planAttribute->attribute_icon == 'empty')
                            <p>N/A</p>
                        @else
                            <i class="{{$planAttribute->attribute_icon}} about-me-font-icon"></i>
                        @endif
                    </td>
                    <td>
                        {{$planAttribute->attribute_name}}
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" align="center">{{__('messages.no_available_attribute')}}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
