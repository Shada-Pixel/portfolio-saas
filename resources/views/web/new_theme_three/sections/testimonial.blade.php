@if($testimonials->count()>0)
    {{-- testimonial --}}
    <div class="testimonial-section py-5 active-link-class" id="testimonial">
        <div class="testimonial-heading text-center">
            <h1 class="mb-2">Testimonial</h1>
            <div class="container">
                <div class="row d-flex justify-content-center testimonial-slick">
                    @forelse($testimonials as $key => $testimonial)
                        <div class="testimonial-slider col-lg-6">
                            <div class="testimonial-circle">
                                <img src="{{asset($testimonial->image_url)}}"/>
                            </div>
                            <div class="testimonial-contents mt-4">
                                {!!  $testimonial->description  !!}
                            </div>
                            <div class="mt-4">
                                <span>{{$testimonial->name}}</span>
                                <p class="testimonial-text">{{$testimonial->position}}</p>
                            </div>
                        </div>
                    @empty
                        <h5>Testimonial not available</h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endif
