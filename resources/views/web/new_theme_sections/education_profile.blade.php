{{--Education & Experience--}}
@if($educations->count() > 0 || $experiences->count() > 0)
    <section class="main-education active-header" id="experienceEducation">
        <div class="container">
            <div class="education-section">
                <div class="education-heading text-center">
                    <h1 class="mb-5"> Education & Experience</h1>
                </div>
                <div class="education-content ">
                    <div class="d-flex justify-content-center">
                        <div class="row education-info">
                            <div class="col-lg-6 col-12">
                                <div class="position-relative">
                                <div class="education-title d-flex mb-5">
                                    <img src="{{asset('assets/img/frame6.png')}}" class="me-3 education-logo">
                                    <h3 class="mb-0">Education</h3>
                                </div>
                                @forelse($educations as $education )
                                    <div class="education-data">
                                        <div class="ms-3">
                                            <div>
                                                <h5 class="fw-bold-500">{{$education->qualification}}</h5>
                                                <p class="mb-0">{{ $education->school_name}}</p>
                                            </div>
                                            <div>
                                                <p class="year fw-bold"> @if($education->currently_studying_here)
                                                        {{ $education->start_date->format('F Y') }} - currently
                                                    @else
                                                        {{ $education->start_date->format('F Y') }}
                                                        -  {{ $education->end_date ? $education->end_date->format('F Y') : '-' }}
                                                    @endif</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h5>Education not available</h5>
                                @endforelse

                            </div>
                        </div>


                        {{-- Expiereince--}}

                        <div class="col-lg-6 col-12">
                            <div class="experience-title d-flex mb-5">
                                <img src="{{asset('assets/img/frame7.png')}}" class="me-3 experience-logo">
                                <h3 class="mb-0">Experience</h3>
                            </div>
                            @forelse($experiences as $experience)
                                <div class="education-data">
                                    <div class="ms-3">
                                        <div>
                                            <h5>{{$experience->company}}</h5>
                                            <p class="mb-0">{{$experience->job_title}}</p>
                                        </div>
                                        <div>
                                            <p class="year fw-bold">@if($experience->currently_work_here)
                                                    {{ $experience->start_date->format('F Y') }} - currently
                                                @else
                                                    {{ $experience->start_date->format('F Y') }}
                                                    -  {{ $experience->end_date ? $experience->end_date->format('F Y') : '-' }}
                                                @endif</p>
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


