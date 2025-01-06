<!-- testimonial section starts  -->
@if($testimonials->count() > 0)
<section class="testimonial padding-top-100 padding-top-md-50 custom-padding-top-15" id="testimonial">
    <div class="first-content text-center">
        <h2 class="first-content__heading position-relative text-uppercase mb-5 custom_heading_tag custom-mb-2"
            data-aos="fade-up"
            data-aos-once="true">
            Testimonials
        </h2>
    </div>
    <div class="container">
        <div class="testimonial__block overflow-hidden custom-padding-top-15">
            <div class="testimonial__sliders">
                @forelse($testimonials as $testimonial)
                    <div class="row d-flex justify-content-center align-items-start pt-5 mr-0 ml-0">
                        <div class="col-lg-3 mr-md-4 mr-0">
                            <div class="text-center text-lg-left mb-4 mb-lg-0">
                                <div class="testimonial-profile text-center position-relative d-inline-block">
                                    <img data-src="{{$testimonial->image_url}}" alt="award-icon" class="img-fluid mb-3 lazy"/>
                                    <h3 class="testimonial-profile__name mb-2 custom_test_profile_name">
                                        {{$testimonial->name}}
                                    </h3>
                                    <h4 class="testimonial-profile__profile-name mb-0">
                                        {{$testimonial->position}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 review-block">
                            <div class="all-reviews position-relative">
                                <span class="text-white mb-0 custom_testimonial_text">{!!  $testimonial->description  !!}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5>Testimonial not available</h5>
                @endforelse
            </div>
            <!-- <div class="testimonial__sliders">

                </div>
                <div class="testimonial__sliders">

                </div> -->
        </div>
    </div>
</section>
@endif
