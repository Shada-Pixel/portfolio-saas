@if($recentWorksType->count()> 0)
    <div class="container py-5 active-header" id="recentWork">
        <div class="recent-work_section">
            <div class="recent-heading text-center">
                <h1>Recent Work</h1>
            </div>
            <ul class="nav d-flex nav-tabs justify-content-center border-0 recent-nav" id="myTab">
                @forelse($recentWorksType as $key => $recentWorkType)
                    <li class="nav-item">
                        <a class="text-dark nav-link cursor-pointer border-0 recent-work-field {{$loop->first ? 'active':''}}"
                           id="{{$recentWorkType->id}}" data-bs-toggle="tab" data-bs-target="#recentWork{{$key}}"
                           aria-current="page" data-count="{{ $recentWorkType->recentWorks->count() }}"><span
                                    class=" ">{{$recentWorkType->name}}</span></a>
                    </li>
                @empty
                    <h5>Recent work not available</h5>
                @endforelse
            </ul>
            <div class="recent-gallery mt-4 tab-content">
                @forelse($recentWorksType as $key => $recentWorkType)
                    <div class="count-of-tab tab-pane fade {{$loop->first ? 'active show' : ''}}"
                         id="recentWork{{$key}}" role="tabpanel" aria-labelledby="{{$recentWorkType->id}}"
                         data-id="recentWork{{$key}}">
                        <div class="row hover-overlay d-flex justify-content-center">
                            @foreach($recentWorkType->recentWorks as $key=> $recentWork)
                                @if($loop->iteration == 1 || $loop->iteration == 2 || $loop->iteration == 3)
                                    <div class="col-xs-4 col-lg-4 col-md-6 ps-0 pe-0 overflow-hidden position-relative">
                                        @elseif($loop->iteration == 4 || $loop->iteration == 5)
                                            <div class="col-xs-4 col-lg-4 col-md-6 ps-0 pe-0 overflow-hidden position-relative">
                                                @else
                                                    <div class="col-xs-4 col-lg-4 col-md-6 ps-0 pe-0 overflow-hidden position-relative">
                                                        @endif
                                                        <a href="{{ isset($recentWork->link) ? $recentWork->link : 'javascript:void(0)' }}">
                                                            @if($loop->iteration <7)
                                                                <img data-src="{{$recentWork->attachment_url}}"
                                                                     class="recent-work-img mb-0 lazy">
                                                            @else
                                                                <img data-src="{{$recentWork->attachment_url}}"
                                                                     class="recent-work-img mb-0 lazy view-all-recent-work">
                                                            @endif
                                                            <h3 class="img-title text-wrap">{{Str::limit($recentWork->title,100,'.')}}</h3>
                                                        </a>

                                                    </div>
                                                    @endforeach
                                            </div>
                                    </div>
                                    @empty
                                        <h5>Recent work not available</h5>
                                    @endforelse
                        </div>
                        <div class="text-center mt-5">
                            <button class="btn recent-btn px-5 py-2 view-more-link-recent-work {{ $recentWorksType->first()->recentWorks->count() <= 6 ? 'd-none' : '' }}">
                                View All
                            </button>
                        </div>
                    </div>
            </div>
@endif
