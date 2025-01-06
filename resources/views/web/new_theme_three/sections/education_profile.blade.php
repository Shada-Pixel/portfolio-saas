{{--Education & Experience--}}
@if($educations->count() > 0 || $experiences->count() > 0)
<section class="main-education active-link-class" id="experienceEducation">
    <div class="container">
        <div class="education-section">
            <div class="education-content ">
                <div class="d-flex justify-content-center">
                    <div class="row education-info">
                        <div class="col-lg-6 col-12 pe-xl-4 mb-lg-0 mb-4">
                            <div class="position-relative">
                                <div class="education-title d-flex justify-content-center mb-3">
                                    <h3 class="mb-0 education-logo"> Education</h3>
                                </div>
                                <div class="experience-line">
                                    @forelse($educations as $education )
                                        <div class="education-data">
                                            <div class="ms-5">
                                                <div>
                                                    <span class="fw-bold edu-title">{{$education->qualification}}</span>
                                                    <p class="mb-0 edu-text">{{ $education->school_name}}</p>
                                                </div>
                                                <div>
                                                    <p class="year fw-bold edu-text">
                                                        @if($education->currently_studying_here)
                                                            {{ $education->start_date->format('F Y') }} - currently
                                                        @else
                                                            {{ $education->start_date->format('F Y') }}
                                                            -  {{ $education->end_date ? $education->end_date->format('F Y') : '-' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h5>Education not available</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        {{-- Expiereince--}}

                        <div class="col-lg-6 col-12">
                            <div class="position-relative">
                                <div class="experience-title d-flex justify-content-center mb-3">
                                    <h3 class="mb-0 experience-logo">Experience</h3>
                                </div>
                                <div class="experience-line">
                                    @forelse($experiences as $experience)
                                        <div class="education-data">
                                            <div class="ms-5">
                                                <div>
                                                    <span class="fw-bold edu-title">{{$experience->job_title}}</span>
                                                    <p class="mb-0 edu-text">{{$experience->company}}</p>
                                                </div>
                                                <div>
                                                    <p class="year fw-bold edu-text">
                                                        @if($experience->currently_work_here)
                                                            {{ $experience->start_date->format('F Y') }} - currently
                                                        @else
                                                            {{ $experience->start_date->format('F Y') }}
                                                            -  {{ $experience->end_date ? $experience->end_date->format('F Y') : '-' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h5>Experience not available</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endif
