@extends('layouts.front.app')
@section('title')
    {{ __('messages.featured_portfolio.portfolio') }}
@endsection
@section('content')
    <!-- Content
		============================================= -->
    <section id="content">

        <div class="content-wrap py-0">

            <div class="section m-0 pt-5">
                <div class="container">
                    <div class="row align-items-end justify-content-between mb-3">
                        <div class="col-lg-12">
                            <h3 class="fw-bolder display-4 mb-3"><span class="gradient-text gradient-horizon">Featured Portfolio's</span>
                            </h3>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="row justify-content-center mt-3 g-4" id="featuredPortfolioCard">
                        <input type="hidden" name="current_featured_count" id="currentFeaturedCount"
                               value="{{ count($featuredPortfolios) }}"/>
                        <input type="hidden" name="total_records_count" id="totalRecordsCount"
                               value="{{ $featuredPortfoliosCount }}"/>
                        @forelse($featuredPortfolios as $featuredPortfolio)
                            <div class="col-lg-4 col-md-6">
                                <div class="card text-center featured_card">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <div>
                                            <img src="{{ $featuredPortfolio->profile_image }}" alt="profile-icon"
                                                 class="mb-3 rounded-circle featured-profile-image"/>
                                            <h3 class="card-title">{{ $featuredPortfolio->full_name }}</h3>
                                            <p>Follower: {{$featuredPortfolio->followers->count()}}</p>
                                            <p class="card-text">
                                                {!! Str::limit($featuredPortfolio->about_me, 100) !!}
                                            </p>
                                            <a href="{{ route('portfolio.front', $featuredPortfolio->user_name) }}"
                                               class="button button-border rounded-pill" target="_blank">
                                                View Portfolio
                                            </a>
                                            @if(getLoggedInUser() == null || getLoggedInUser()->hasRole('admin') && getLoggedInUserId() != $featuredPortfolio->id)
                                                <?php $followingIds = $featuredPortfolio->following()->where('following_id',
                                                    getLoggedInUserId())->pluck('follower_id')->toArray() ?>
                                                <a href="javascript:void(0)"
                                                   class="button button-border rounded-pill {{ in_array($featuredPortfolio->id,$followingIds) ? 'bg-dark text-white' : '' }} follow-portfolio"
                                                   data-id="{{ $featuredPortfolio->id }}">
                                                    <i class="{{ in_array($featuredPortfolio->id,$followingIds) ? 'fas fa-user-minus' : 'fas fa-user-plus' }}"></i>
                                                    <span class="favorite-text">
                                                        @if(in_array($featuredPortfolio->id,$followingIds) )
                                                            Unfollow
                                                        @else
                                                            Follow
                                                        @endif
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-4 col-md-6">
                                <div class="card text-center empty_featured_card">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <div>
                                            <div class="empty-featured-portfolio">
                                                <i class="fas fa-question"></i>
                                            </div>

                                            <h3 class="card-title mt-3">
                                                {{ __('messages.featured_portfolio.no_feature_portfolio_found') }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if($featuredPortfoliosCount > 6)
                        <div class="d-flex align-items-center justify-content-center mt-3">
                            <a href="javascript:void(0)"
                               class="button h-translatey-3 bg-dark text-capitalize rounded-pill featured-portfolio-show-more"
                               id="showMoreFeaturedPortfolio" data-content="toggle-text">
                                <i class="icon-line-loader icon-spin m-0  d-none" id="showMoreSpin"></i>
                                Show More
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </section>
    <!-- #content end -->
@endsection
@section('page_js')
    <script>
        let followPortfolioUrl = "{{ route('front.follow.portfolio') }}";
        let followText = "{{ __('messages.followers.follow') }}";
        let unfollowText = "{{ __('messages.followers.unfollow') }}";
        let logInUrl = "{{ url('login') }}";
        let getLoggedInUserdata = "{{ getLoggedInUser() }}";
    </script>
    <script src="{{ mix('assets/js/front/portfolio/portfolio.js') }}"></script>
@endsection
