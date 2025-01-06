{{--Skills--}}
@if($skills->count() > 0)
    <div class="skill-section pt-sm-3 pt-5 pb-5 active-link-class" id="skills">
        <div class="skill-heading text-center mb-sm-5">
            <h1>Skills</h1>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                @forelse($skills as $key => $skill)
                    @if($loop->iteration < 9)
                        <div class="col-10 col-lg-5 me-0 me-lg-5 mb-lg-0 mb-3">
                            <p class="d-flex justify-content-between mb-2 expertise-content">
                                <span>{{$skill->name}}</span>
                                {{$skill->percentage}}%
                            </p>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: {{$skill->percentage.'%'}};"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @else
                        <div class="col-10 col-lg-5 me-0 me-lg-5 mb-lg-0 mb-3 view-all-skills">
                            <p class="d-flex justify-content-between mb-2 expertise-content">
                                <span>{{$skill->name}}</span>
                                {{$skill->percentage}}%
                            </p>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: {{$skill->percentage.'%'}};"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endif
                @empty
                    <h5>No Data Found</h5>
                @endforelse
            </div>
            @if($skills->count() > 8)
                <div class="text-center offer-section mt-4">
                    <button class="btn offer-btn px-5 view-more-link-skills">View All</button>
                </div>
            @endif
        </div>
    </div>
@endif
