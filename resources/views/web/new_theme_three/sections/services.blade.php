@if($services->count() > 0)
    {{--Services--}}
    <div class="services-section pt-5 pb-sm-5 pb-4 active-link-class" id="services">
        <div class="services-heading text-center mb-sm-4">
            <h1 class="mb-2 text-white">Services</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center py-5 container">
            <div class="row d-flex justify-content-center g-3 w-100">
                @forelse($services as $service)
                    @if($loop->iteration <= 3)
                        <div class="col-xl-4 col-lg-6">
                            <div class="card services border-0">
                                <div class="card-body d-flex align-items-center p-0 services-box">
                                    <div class="services-icon d-flex justify-content-center align-items-center">
                                        <img src="{{asset($service->icon_image)}}" class="service-image">
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 services-title">{{$service->name}}</p>
                                        <p class="services-info">
                                            {!! nl2br($service->description)  !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-4 col-lg-6 view-all-services">
                            <div class="card services border-0">
                                <div class="card-body d-flex align-items-center p-0 services-box">
                                    <div class="services-icon d-flex justify-content-center align-items-center">
                                        <img src="{{asset($service->icon_image)}}" class="service-image">
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 services-title">{{$service->name}}</p>
                                        <p class="services-info">
                                            {!! nl2br($service->description)  !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <h5>Services not available</h5>
                @endforelse
            </div>
        </div>
        @if($services->count() > 3)
            <div class="text-center offer-section">
                <button class="btn offer-btn px-5 view-more-link-services">View All</button>
            </div>
        @endif
    </div>
@endif
