@if($pricingPlans->count() > 0)
    <div class="pricing-plan_section py-5 active-header" id="pricingPlan">
        <div class="pricing-heading">
            <h1 class="text-center">Pricing Plans</h1>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center d-flex">
                @forelse($pricingPlans as $pricingPlan)
                    <div class="col-lg-8 col-xl-4 main-card">
                        <?php
                        $inStyle = 'style';
                        $style = 'border-top: 7px solid';
                        ?>
                        <div class="card pricing-card custom-pricing-plan-card">
                            <div class="card-body">
                                <img
                                        src="{{$pricingPlan->icon_image}}"
                                        data-alt="plan-icon"
                                        class="mb-3 card-img-top lazy pricingP-plan-image"
                                        width="70px"
                                        height="72px"
                                />
                                <span class="text-center card-title pricing-title">{{\App\Models\PricingPlan::PRICING_PLAN_TYPE[$pricingPlan->type]}}</span>
                                <div class="d-flex justify-content-start align-items-center">
                                    <p class="pricing-amount">{{ !empty($pricingPlan->currency->currency_icon) ? $pricingPlan->currency->currency_icon : '$'}}</p>
                                    <p class="mb-3 pricing-amount">{{$pricingPlan->price}}</p>
                                    <span class="text-secondary">/{{\App\Models\PricingPlan::PLAN_TYPE[$pricingPlan->plan_type]}}</span>
                                </div>
                                <p class="text-secondary pricing-content">For most businesses that want to
                                    optimize web queries</p>
                                <ul class="mb-5 pricing-list">
                                    @foreach($pricingPlan->planAttributes as $planAttribute)
                                        <li class="list-item mb-3 px-0 text-secondary">
                                            <i class="{{$planAttribute->attribute_icon}} pr-1 me-2"></i>
                                            {{$planAttribute->attribute_name}}
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="text-center">
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
    
