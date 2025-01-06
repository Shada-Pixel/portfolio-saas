<!-- skills section starts -->
@if($skills->count() > 0)
    <section class="skills padding-top-100 padding-top-md-50" id="skills">
        <div class="first-content text-center">
            <h2 class="first-content__heading skill_underline position-relative text-uppercase mb-5 custom_heading_tag custom-skill-border custom-mb-2"
                data-aos="fade-up"
                data-aos-once="true">
                Skills
            </h2>
        </div>
        <div class="container">
            <div class="skills__block">
                <div class="row justify-content-center">
                    @forelse($skills as $key => $skill)
                        @if($loop->iteration <= 6)
                            <figure class=" mb-4 text-center circle d-flex justify-content-center ml-3 mr-3">
                                <figcaption>
                                    <div class="chart text-center" id="graph{{$key+1}}"
                                         data-percent="{{ $skill->percentage }}"
                                         data-color="#FF4C60">
                                        <div class="skill_section">
                                            <span class="d-block">{{ $skill->percentage }}%</span>
                                            <h5 class="skill_name">{{$skill->name}}</h5>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        @else
                            <div class="show-more-skills">
                                <figure class=" mb-4 text-center circle d-flex justify-content-center ml-3 mr-3">
                                    <figcaption>
                                        <div class="chart text-center" id="graph{{$key+1}}"
                                             data-percent="{{ $skill->percentage }}"
                                             data-color="#FF4C60">
                                            <div class="skill_section">
                                                <span class="d-block">{{ $skill->percentage }}%</span>
                                                <h5 class="skill_name">{{$skill->name}}</h5>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        @endif
                    @empty
                        <h5>No Data Found</h5>
                    @endforelse
                    @if($skills->count() > 6)
                        <div class="col-12 text-center">
                            <a href="#/" class="btn show-more-link show-more-link-skill">Show More</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
