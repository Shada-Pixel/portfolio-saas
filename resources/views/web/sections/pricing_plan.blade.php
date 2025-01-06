<!-- pricing plan section starts -->
@if($pricingPlans->count() > 0)
    <section class="pricing-plans padding-top-100 padding-top-md-50" id="pricing-plan">
        <div class="first-content text-center">
            <h2 class="first-content__heading position-relative text-uppercase mb-5 custom_heading_tag custom-mb-2"
                data-aos="fade-up"
                data-aos-once="true">
                Pricing Plans
            </h2>
        </div>
        <div class="container" data-aos="fade-right" data-aos-duration="1500" data-aos-once="true">
            <div class="pricing-plans__block mt-2 d-inline-block w-100">
                <div class="row justify-content-center">
                    @forelse($pricingPlans as $pricingPlan)
                        <div class="col-lg-4 col-md-6 main-card fadeInLeft front-animation">
                            <?php
                            $inStyle = 'style';
                            $style = 'border-top: 7px solid';
                            ?>
                            <div class="card text-center position-relative h-100" {{$inStyle}}=
                            "{{$style}} {{ ($pricingPlan->color == '#FFFFFF') ? '#f5365c' : $pricingPlan->color}};">
                            <img
                                    src="{{$pricingPlan->icon_image}}"
                                    data-alt="plan-icon"
                                    class="mb-3 card-img-top lazy"
                                    width="70px"
                                    height="72px"
                            />
                            <div class="card-body">
                                <strong class="card-title text-uppercase d-block custom-space">{{\App\Models\PricingPlan::PRICING_PLAN_TYPE[$pricingPlan->type]}}</strong>
                            </div>
                                <ul class="list-group-flush ml-0 mb-2 h-100">
                                    @foreach($pricingPlan->planAttributes as $planAttribute)
                                        <li class="list-group-item mb-0 px-0">
                                            <i class="{{$planAttribute->attribute_icon}} pr-1"></i>
                                            {{$planAttribute->attribute_name}}
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mb-0 px-0 main-card__price-div">
                                    <sup class="main-card__price-symbol">{{ !empty($pricingPlan->currency->currency_icon) ? $pricingPlan->currency->currency_icon : '$'}}</sup>
                                    <span class="main-card__price">{{$pricingPlan->price}}</span>
                                    <span>Per/{{\App\Models\PricingPlan::PLAN_TYPE[$pricingPlan->plan_type]}}</span>
                                </div>
                                @if(getLoggedInUser() == null)
                                    <div class="card-footer bg-white px-0 pb-0 mt-0 border-0">
                                        <a href="javascript:void(0)" class="btn btn-primary custom-btn mb-4 mt-3"
                                           id="createModel">
                                            Hire Me
                                        </a>
                                    </div>
                                @endif
                        </div>
                </div>
                @empty
                    <h5>Pricing plan not available</h5>
                @endforelse
            </div>
        </div>
        </div>
    </section>
@endif
