{{--  Pricing Plan--}}
@if($pricingPlans->count() > 0)
    <div class="pricing-plan_section active-link-class" id="pricingPlan">
        <div class="pricing-heading">
            <h1 class="text-center">Pricing Plans</h1>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center g-4">
                @forelse($pricingPlans as $pricingPlan)
                    <div class="col-xl-4 col-md-6 main-card">
                        <?php
                        $inStyle = 'style';
                        $style = 'border-top: 7px solid';
                        ?>
                        <div class="card pricing-card">
                            <div class="card-body pricing-body">
                                <div class="text-center">
                                    <span class="card-title pricing-title">{{\App\Models\PricingPlan::PRICING_PLAN_TYPE[$pricingPlan->type]}}</span>
                                    <div class="mt-3">
                                        <img src="{{$pricingPlan->icon_image}}" class="img-fluid pricing-image"/>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-3">
                                        <p class="pricing-amount">{{ !empty($pricingPlan->currency->currency_icon) ? $pricingPlan->currency->currency_icon : '$'}}</p>
                                        <p class="mb-3 pricing-amount">{{$pricingPlan->price}}</p>
                                        <span class="text-secondary">/{{\App\Models\PricingPlan::PLAN_TYPE[$pricingPlan->plan_type]}}</span>
                                    </div>
                                </div>
                                <p class="text-center mb-4">For most businesses that want to optimize web queries</p>

                                <ul class="mb-5 pricing-list">
                                    @foreach($pricingPlan->planAttributes as $planAttribute)
                                        <li class="list-item mb-4 px-0 text-secondary">
                                            <i class="{{$planAttribute->attribute_icon}} pr-1 me-2"></i>
                                            {{$planAttribute->attribute_name}}
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-center pt-3">
                                    <button class="btn pricing-btn px-3" id="createModel">Choose Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5>Pricing plan not available</h5>
                @endforelse
            </div>
        </div>
    </div>
@endif
