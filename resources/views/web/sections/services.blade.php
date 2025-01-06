<!-- services section starts  -->
@if($services->count() > 0)
<section class="services padding-top-100 padding-top-md-50 custom-padding-top-15" id="service">
    <div class="first-content text-center">
        <h2 class="first-content__heading position-relative service_underline text-uppercase mb-5 custom_heading_tag custom-serv-border custom-mb-2"
            data-aos="fade-up"
            data-aos-once="true">
            Services
        </h2>
    </div>
    <div class="container" data-aos="fade-up" data-aos-once="true">
        <div class="services__block">
            <div class="row justify-content-center">
                @forelse($services as $service)
                    @if($loop->iteration <= 3)
                        <div class="col-lg-4 col-md-6 service-card mb-4">
                            <div class="card border-0">
                                <img
                                        data-src="{{$service->icon_image}}"
                                        alt="award-icon"
                                        class="mb-3 card-img-top service-img lazy"
                                height="72px" width="70px"/>
                                <div class="card-body pb-0 px-0">
                                    <h3 class="card-title text-center custom_service_heading_tag">{{$service->name}}</h3>
                                    <div class="custom_service_desc card-text p-1 pb-0">
                                        {!! nl2br($service->description)  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-4 col-md-6 service-card mb-4 show-more-services">
                            <div class="card border-0">
                                <img
                                        data-src="{{$service->icon_image}}"
                                        alt="award-icon"
                                        class="mb-3 card-img-top service-img lazy"
                                        height="72px" width="70px"/>
                                <div class="card-body pb-0 px-0">
                                    <h3 class="card-title text-center custom_service_heading_tag">{{$service->name}}</h3>
                                    <div class="custom_service_desc card-text p-1 pb-0">
                                        {!! nl2br($service->description)  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <h5>Services not available</h5>
                @endforelse
                @if($services->count() > 3)
                    <div class="col-12 text-center mt-4 custom-mt-0">
                        <a href="#/" class="btn show-more-link show-more-link-services" data-content="toggle-text">Show
                            More</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
