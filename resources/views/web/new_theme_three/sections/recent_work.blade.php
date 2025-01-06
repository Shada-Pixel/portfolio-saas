@if($recentWorksType->count()> 0)
    <div class="container pt-5 active-link-class" id="recentWork">
        <div class="recent-work_section">
            <div class="recent-heading text-center mb-5">
                <h1>Recent Work</h1>
            </div>
            <nav class="head-nav">
                <div class="nav nav-tabs recent-nav d-flex justify-content-center" id="nav-tab" role="tablist">
                    @forelse($recentWorksType as $key => $recentWorkType)
                        <button class="nav-link recent-work-field {{$loop->first ? 'active':''}}"
                                id="{{$recentWorkType->id}}" data-bs-toggle="tab"
                                data-count="{{ $recentWorkType->recentWorks->count() }}"
                                data-bs-target="#nav-home{{$key}}" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">{{$recentWorkType->name}}
                        </button>
                    @empty
                        <h5>Recent work not available</h5>
                    @endforelse
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="recent-gallery mt-4 tab-content">
                    @forelse($recentWorksType as $key => $recentWorkType)
                        <div class="count-of-tab tab-pane fade {{$loop->first ? 'active show' : ''}}"
                             id="nav-home{{$key}}" role="tabpanel" aria-labelledby="{{$recentWorkType->id}}"
                             data-id="nav-home{{$key}}">
                            <div class="row d-flex justify-content-center g-3">
                                @foreach($recentWorkType->recentWorks as $key=> $recentWork)
                                    @if($loop->iteration == 1 || $loop->iteration == 2 || $loop->iteration == 3)
                                        <div class="col-lg-4 col-md-12 ps-0 pe-0 overflow-hidden position-relative">
                                            @elseif($loop->iteration == 4 || $loop->iteration == 5)
                                                <div class="col-lg-4 col-md-12 ps-0 pe-0 overflow-hidden position-relative">
                                                    @else
                                                        <div class="col-lg-4 col-md-12 ps-0 pe-0 overflow-hidden position-relative">
                                                            @endif
                                                            <div class="bg-image hover-overlay ripple shadow-1-strong overflow-hidden m-2"
                                                                 data-ripple-color="light">
                                                                <a href="{{ isset($recentWork->link) ? $recentWork->link : 'javascript:void(0)' }}">
                                                                    @if($loop->iteration <7)
                                                                        <img src="{{$recentWork->attachment_url}}"
                                                                             class="recent-work-image w-100">
                                                                    @else
                                                                        <img src="{{$recentWork->attachment_url}}"
                                                                             class="recent-work-image w-100 view-all-recent-work">
                                                                    @endif
                                                                    <h3 class="img-title text-wrap">{{Str::limit($recentWork->title,100,'.')}}</h3>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                </div>
                                        </div>
                                        @empty
                                            <h5>Recent work not available</h5>
                                        @endforelse
                            </div>
                            {{--                            <div class="text-center mt-5">--}}
                            <button class="btn recent-btn px-5 py-2 view-more-link-recent-work mt-5 mx-auto d-block {{ $recentWorksType->first()->recentWorks->count() <= 6 ? 'd-none' : '' }}">
                                View All
                            </button>
                            {{--                            </div>--}}
                        </div>
                </div>
            </div>
@endif
