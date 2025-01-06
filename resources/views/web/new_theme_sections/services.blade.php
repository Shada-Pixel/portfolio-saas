@if($services->count() > 0)
    <div class="offer-section py-5 active-header" id="services">
        <div class="offer-heading text-center mb-4">
            <h1 class="mb-2">Services</h1>
        </div>
        <div class="py-5 container">
            <div class="row d-flex justify-content-center g-3">
                @forelse($services as $service)
                    @if($loop->iteration <= 4)
                        <div class="col-lg-3 col-sm-6 mb-xl-0 mb-5">
                            <div class="card offer-contents">
                                <img src="{{asset($service->icon_image)}}"
                                     class="offer-icon d-flex justify-content-center align-items-center">
                                <div class="offer-box">
                                    <p class="mb-2 offer-title">{{$service->name}}</p>
                                    <p class="offer-info mb-0">
                                        {!! nl2br($service->description)  !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-3 col-sm-6 mb-xl-0 mb-5 mt-5 view-all-services">
                            <div class="card offer-contents">
                                <img src="{{asset($service->icon_image)}}"
                                     class="offer-icon d-flex justify-content-center align-items-center">
                                <div class="offer-box">
                                    <p class="mb-2 offer-title">{{$service->name}}</p>
                                    <p class="offer-info mb-0">
                                        {!! nl2br($service->description)  !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <h5>Services not available</h5>
                @endforelse
            </div>
        </div>
        @if($services->count() > 4)
            <div class="text-center">
                <button class="btn offer-btn px-5 view-more-link-services">View All</button>
            </div>
        @endif
    </div>
@endif
