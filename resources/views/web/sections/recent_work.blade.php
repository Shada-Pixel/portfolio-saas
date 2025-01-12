<!-- recent work section start -->
@if(\App\Models\RecentWork::count() > 0)
    <section class="recent-work padding-top-100 padding-top-md-50 custom-padding-top-25" id="recent-work">
        <div class="first-content text-center">
            <h2 class="first-content__heading position-relative text-uppercase mb-5 custom_heading_tag custom-mb-1"
                data-aos="fade-up" data-aos-once="true">
                Recent Works
            </h2>
        </div>
        <div class="container">
            <div class="recent-work__block tab ">
                <nav class="nav nav-tabs">
                    @forelse($recentWorksType as $key => $recentWorkType)
                        <a href="#/"
                           class="col-sm-3 d-flex justify-content-center nav-item nav-link tablinks recent-work-field pb-3"
                           data-field="{{$recentWorkType->id}}">
                            <span class="{{$loop->first ? 'active':''}} recent-work-details">{{$recentWorkType->name}}</span>
                        </a>
                    @empty
                        <h5>Recent work not available</h5>
                    @endforelse
                </nav>

                <div class="recent-work-div-front">
                    <section class="gallery">
                        <div class="container p-0">
                            <div class="grid">
                                <div class="tab-content">
                                    @forelse($recentWorksType as $recentWorkType)
                                        <div id="{{$recentWorkType->id}}" class="tabcontent p-0">
                                            <div class="row">
                                                @foreach($recentWorkType->recentWorks as $key=> $recentWork)
                                                    @if ($recentWork->video_link != null )
                                                    <div class="col-xs-4 col-md-12 pl-0 pr-0 d-flex justify-content-center">
                                                        <iframe width="560" height="315" src="{{$recentWork->video_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>

                                                    @endif
                                                    @if($recentWork->media_url_arr != '')
                                                        @foreach($recentWork->media_url_arr as $key => $urlLink)
                                                            {{--                                                    @if($loop->iteration == 1 || $loop->iteration == 2 || $loop->iteration == 3)--}}
                                                            <div class="col-xs-4 col-md-4 pl-0 pr-0">
                                                                {{--   @elseif($loop->iteration == 4 || $loop->iteration == 5)--}}
                                                                {{--                                                                <div class="col-xs-4 col-md-4 pl-0 pr-0">--}}
                                                                {{--                                                                    @else--}}
                                                                {{--                                                                        <div class="col-xs-4 col-md-4 pl-0 pr-0">--}}
                                                                {{--                                                                            @endif--}}

                                                                @if(strpos($recentWork->link,'https://') !== false || strpos($recentWork->link,'http://') !== false || is_null($recentWork->link))
                                                                    <a class="text-center"
                                                                       href="{{ isset($recentWork->link) ? $recentWork->link : 'javascript:void(0)' }}">
                                                                        @else
                                                                            <a class="text-center"
                                                                               href="//{{ isset($recentWork->link) ? $recentWork->link : 'javascript:void(0)' }}/">
                                                                                @endif
                                                                                <figure class="img-container mb-0">
                                                                                    <img data-src="{{$urlLink}}"
                                                                                         class="recent-work-img mb-0 lazy">
                                                                                    <h3 class="img-title text-decoration-none text-dark text-wrap">{{$recentWork->title}}</h3>
                                                                                </figure>
                                                                            </a>
                                                                    </a>
                                                            </div>
                                                            {{--                                                                </div>--}}
                                                            {{--                                                        </div>--}}

                                                        @endforeach
                                                    @else
                                                        <div class="col-xs-4 col-md-4 pl-0 pr-0">
                                                            @if(strpos($recentWork->link,'https://') !== false || strpos($recentWork->link,'http://') !== false || is_null($recentWork->link))
                                                                <a class="text-center"
                                                                   href="{{ isset($recentWork->link) ? $recentWork->link : 'javascript:void(0)' }}">
                                                                    @else
                                                                        <a class="text-center"
                                                                           href="//{{ isset($recentWork->link) ? $recentWork->link : 'javascript:void(0)' }}/">
                                                                            @endif
                                                                            <figure class="img-container mb-0">
                                                                                <img data-src="{{$recentWork->attachment_url}}"
                                                                                     class="recent-work-img mb-0 lazy">
                                                                                <h3 class="img-title text-decoration-none text-dark text-wrap">{{$recentWork->title}}</h3>
                                                                            </figure>
                                                                        </a>
                                                                </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @empty
                                        <h5>Recent work not available</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endif
