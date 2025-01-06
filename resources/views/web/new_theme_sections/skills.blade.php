@if($skills->count() > 0)
    <div class="expertise-section py-5 active-header" id="skills">
        <div class="expertise-heading text-center mb-5">
            <h1>Skills</h1>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center expertise-responsive">
                @forelse($skills as $key => $skill)
                    @if($loop->iteration < 9)
                        <div class="col-10 col-lg-5 me-0 me-lg-5 mb-lg-0 mb-5">
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
                        <div class="col-10 col-lg-5 me-0 me-lg-5 mb-lg-0 mb-5 view-all-skills">
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
        </div>
        @if($skills->count() > 8)
            <div class="text-center">
                <button class="btn offer-btn px-5 view-more-link-skills">View All</button>
            </div>
        @endif
    </div>
@endif
