@if($testimonials->count()>0)
    <div class="testimonial-section py-5 active-header" id="testimonial">
        <div class="testimonial-heading text-center mb-5">
            <h1 class="mb-2">Testimonial</h1>
        </div>
        <div class="container">
            <div class="testimonial-slick">
                @forelse($testimonials as $key => $testimonial)
                    <div class="card testimonial-card me-lg-5 me-0 mb-lg-0 mb-5">
                        <div class="card-body text-center">
                            <img src="{{asset('assets/img/testimonial.png')}}" class="mb-4"/>
                            <p class="card-text custom-height">{!!  $testimonial->description  !!}</p>
                            <img data-src="{{asset($testimonial->image_url)}}"
                                 class="rounded-circle custom-image lazy"/>
                            <p> {{Str::limit($testimonial->name, 30, '.')}}</p>
                        </div>
                    </div>
                @empty
                    <h5>Testimonial not available</h5>
                @endforelse
            </div>
        </div>
    </div>
@endif  

