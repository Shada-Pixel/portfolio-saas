<!-- exp edu section starts -->
@if($educations->count() > 0 || $experiences->count() > 0)
    <section class="experience-education padding-top-100 padding-top-md-50 custom-padding-top-15"
             id="education-profile">
        <div class="container">
            <div class="tabs-penal" data-aos="fade-up" data-aos-once="true">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item d-flex flex-row">
                        @if($experiences->count() > 0)
                            <a href="#uncontrolled-tab-example-tab-experience"
                               class="nav-item nav-link custom_heading_tag custom-exp-border {{ $experiences->count() > 0 ? 'active' : '' }}"
                               data-toggle="tab">Experience</a>
                        @endif
                        @if($educations->count() > 0)
                            <a href="#uncontrolled-tab-example-tab-education" id="educationDetails"
                               class="nav-item nav-link custom_heading_tag custom-edu-border {{ $experiences->count() == 0 && $educations->count() > 0 ? 'active' : '' }}"
                               data-toggle="tab">Education</a>
                        @endif
                    </li>
                </ul>
                <div class="tab-content custom-mt-0" data-aos="fade-up" data-aos-once="true">
                    <div id="uncontrolled-tab-example-tab-experience"
                         aria-labelledby="uncontrolled-tab-example-tab-experience" role="tabpanel"
                         class="fade tab-pane {{ $experiences->count() > 0 ? 'active show' : '' }} inner-content custom-m-top">
                        <div class="nav-tabs-content mt-5">
                            <div class="all-details position-relative">
                                @forelse($experiences as $experience)
                                    <div class="all-details__block pb-md-5 pb-4 position-relative" data-aos="fade-up"
                                         data-aos-once="true">
                                        <span class="all-details__circle-button @if($loop->first) active-details @endif"></span>
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <span
                                                        class="all-details__position d-inline-block align-middle pr-3">{{$experience->job_title}}</span>
                                                <span
                                                        class="all-details__company-name d-inline-block align-middle">- {{$experience->company}}</span>
                                                <strong
                                                        class="d-block mt-md-1 mt-2 mb-md-0 mb-2">{{$experience->state->name}}
                                                    , {{ $experience->country->name}}</strong>
                                            </div>
                                            <div class="col-md-4 col-12 text-md-right pl-md-0 d-flex d-md-block flex-wrap justify-content-between">
                                                <span class="all-details__old-time d-block mb-2 pr-md-0 pr-3">
                                                    {{ formatStartAndEndDate($experience->start_date, !is_null($experience->end_date) ? $experience->end_date : \Carbon\Carbon::now()) }}
                                                </span>
                                                <span class="all-details__currently-time d-block custom_currently_time">
                                                    @if($experience->currently_work_here)
                                                        {{ $experience->start_date->format('F Y') }} - currently
                                                    @else
                                                        {{ $experience->start_date->format('F Y') }}
                                                        -  {{ $experience->end_date ? $experience->end_date->format('F Y') : '-' }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div id="uncontrolled-tab-example-tab-education"
                         aria-labelledby="uncontrolled-tab-example-tab-experience" role="tabpanel"
                         class="fade tab-pane {{ $experiences->count() == 0 && $educations->count() > 0 ? 'active show' : '' }} inner-content custom-m-top">
                        <div class="nav-tabs-content mt-5">
                            <div class="all-details position-relative {{ $experiences->count() == 0 && $educations->count() > 0 ? 'education-block' : '' }}">
                                @forelse($educations as $education)
                                    <div class="all-details__block pb-md-5 pb-4 position-relative" >
                                        <span class="all-details__circle-button  @if($loop->first) active-details @endif"></span>
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <span
                                                        class="all-details__position d-inline-block align-middle pr-3">{{$education->qualification}}</span>
                                                <span
                                                        class="all-details__company-name d-inline-block align-middle">- {{ $education->school_name}}</span>
                                                <strong
                                                        class="d-block mt-md-1 mt-2 mb-md-0 mb-2">{{$education->state->name}}
                                                    , {{ $education->country->name}}</strong>
                                            </div>
                                            <div
                                                    class="col-md-4 col-12 text-md-right pl-md-0 d-flex d-md-block flex-wrap justify-content-between">
                                                <span
                                                        class="all-details__old-time d-block mb-2 pr-md-0 pr-3">
                                                    {{ formatStartAndEndDate($education->start_date, !is_null($education->end_date) ? $education->end_date : \Carbon\Carbon::now()) }}
                                                </span>
                                                <span class="all-details__currently-time d-block custom_currently_time"> 
                                                    @if($education->currently_studying_here)
                                                        {{ $education->start_date->format('F Y') }} - currently
                                                    @else
                                                        {{ $education->start_date->format('F Y') }}
                                                        -  {{ $education->end_date ? $education->end_date->format('F Y') : '-' }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
