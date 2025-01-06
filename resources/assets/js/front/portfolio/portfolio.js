'use strict';
$(document).ready(function () {
    $('#showMoreFeaturedPortfolio').on('click', function () {
        let featuredPortfolioCount = parseInt($('#currentFeaturedCount').val());
        let totalRecordsCount = parseInt($('#totalRecordsCount').val());
        if (featuredPortfolioCount !== totalRecordsCount) {
            $.ajax({
                url: route('front.show.more.portfolio'),
                data: { 'currentFeaturedCount': featuredPortfolioCount },
                beforeSend: function () {
                    $('.featured-portfolio-show-more>i').removeClass('d-none');
                },
                success: function (response) {

                    $('#featuredPortfolioCard:last').
                        append(response.data.featuredPortfolios);
                    $('#currentFeaturedCount').
                        val(parseInt($('#currentFeaturedCount').val()) +
                            response.data.recordCount);
                },
                complete: function () {
                    $('.featured-portfolio-show-more>i').addClass('d-none');
                },
            });
            $('.show-more-featured-portfolio').slideToggle(200);
        } else {
            $('.featured-portfolio-show-more>i').removeClass('d-none');
            $(this).empty();
            $(this).append('No more results');
        }
    });

    $(document).on('click', '.follow-portfolio', function (e) {
        e.preventDefault();
        if (typeof getLoggedInUserdata != 'undefined' && getLoggedInUserdata ==
            '') {
            window.location.href = logInUrl;
        }
        let userId = $(this).data('id');
        let obj = $(this);
        $.ajax({
            url: followPortfolioUrl,
            type: 'GET',
            data: { 'id': userId },
            success: function (result) {
                if (result.success)
                    if (result.data) {
                        obj.addClass('bg-dark text-white');
                        obj.find('i').
                            removeClass('fas fa-user-plus').
                            addClass('fas fa-user-minus');
                        obj.find('.favorite-text').text(unfollowText);
                    } else {
                        obj.removeClass('bg-dark text-white');
                        obj.find('i').
                            removeClass('fas fa-user-minus').
                            addClass('fas fa-user-plus');
                        obj.find('.favorite-text').text(followText);
                    }
                displaySuccessMessage(result.message);
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });
});

