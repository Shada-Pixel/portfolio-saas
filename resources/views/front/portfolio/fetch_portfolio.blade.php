@foreach($portfolios as $portfolio)
    <div class="col-lg-4 col-md-6">
        <div class="card text-center featured_card">
            <div class="card-body d-flex align-items-center justify-content-center">
                <div>
                    <img src="{{ $portfolio->profile_image }}" alt="profile-icon"
                         class="mb-3 rounded-circle featured-profile-image"/>
                    <h3 class="card-title">{{ $portfolio->full_name }}</h3>
                    <p class="card-text">
                        {!! Str::limit($portfolio->about_me, 100) !!}
                    </p>
                    <a href="{{ route('portfolio.front', $portfolio->user_name) }}"
                       class="button button-border rounded-pill" target="_blank">
                        View Portfolio
                    </a>
                    @if(getLoggedInUser() == null || getLoggedInUser()->hasRole('admin') && getLoggedInUserId() !=  $portfolio->id)
                        <?php $followingIds = $portfolio->following()->where('following_id',
                            getLoggedInUserId())->pluck('follower_id')->toArray() ?>
                        <a href="javascript:void(0)"
                           class="button button-border rounded-pill follow-portfolio {{ in_array($portfolio->id,$followingIds) ? 'bg-dark text-white' : '' }} "
                           data-id="{{ $portfolio->id }}" target="_blank">
                            <i class="{{ in_array($portfolio->id,$followingIds) ? 'fas fa-user-minus' : 'fas fa-user-plus' }}"></i>
                            <span class="favorite-text">
                                        @if(in_array($portfolio->id, $followingIds) )
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
    </div>
@endforeach
