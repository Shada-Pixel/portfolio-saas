'use strict';

$(document).ready(function () {
    $('input').blur();

    let showMoreServices = false;
    $('.view-more-link-services').on('click', function () {
        $('.view-all-services').slideToggle(200);
        if (showMoreServices) {
            $(this).text('').text('View All');
            showMoreServices = false;
        } else {
            showMoreServices = true;
            $(this).text('').text('View Less');
        }
    });

    //recent work
    let showMoreRecentWork = false;
    $('.view-more-link-recent-work').on('click', function () {
        $('.view-all-recent-work').slideToggle(200);
        if (showMoreRecentWork) {
            $(this).text('').text('View All');
            showMoreRecentWork = false;
        } else {
            showMoreRecentWork = true;
            $(this).text('').text('View Less');
        }
    });
    //about me
    let showMoreAboutMe = false;
    $('.view-all-about-me-link').on('click', function () {
        $('.view-all-about-me').slideToggle(200);
        if (showMoreAboutMe) {
            $(this).text('').text('View All');
            showMoreAboutMe = false;
        } else {
            showMoreAboutMe = true;
            $(this).text('').text('View Less');
        }
    });

    let showMoreSkills = false;
    $('.view-more-link-skills').on('click', function () {
        $('.view-all-skills').slideToggle(200);
        if (showMoreSkills) {
            $(this).text('').text('View All');
            showMoreSkills = false;
        } else {
            showMoreSkills = true;
            $(this).text('').text('View Less');
        }
    });

    $('.testimonial-slick').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                    arrows: false,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                },
            },
        ],
    });

    // go to specific section
    let url = $(location).attr('href');
    let id = url.substring(url.lastIndexOf('/'));
    id = '#'+id.split('#')[1];
    if (!isEmpty(id) && id !== '#undefined') {
        $('nav .navbar-collapse  ul li .profile').removeClass('active');
        $('html, body').animate({
            scrollTop: $(id).offset().top,
        }, 500);
    } else {
        $('nav .navbar-collapse  ul li .profile').addClass('active');
    }

    $(document).on('click', '.nav-link', function () {
        $(this).addClass('active');
        let url = $(this).attr('href');
        let id = url.substring(url.lastIndexOf('/') + 1);
        id = '#' + id.split('#')[1];
        $('html, body').animate({
            scrollTop: $(id).offset().top,
        }, 500);
    });

    //active header js
    const sections = document.querySelectorAll('.active-header');
    const navLi = document.querySelectorAll('nav .navbar-collapse  ul li a');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - sectionHeight / 2) {
                current = section.getAttribute('id');
            }
        });
        navLi.forEach(li => {
            $(li).removeClass('active');
            if ($(li).hasClass(current)) {
                $(li).addClass('active');
            }
        });
    });

    $(document).on('click', '.recent-work-field', function () {
        let count = $(this).attr('data-count');
        if ($(this).hasClass('active')) {
            if (count > 6) {
                $('.view-more-link-recent-work').removeClass('d-none');
            } else {
                $('.view-more-link-recent-work').addClass('d-none');
            }
        }
    });

    let btn_top = $('#go-to-top');
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn_top.addClass('show_top_page');
        } else {
            btn_top.removeClass('show_top_page');
        }
    });

    btn_top.on('click', function () {
        $('html, body').animate({ scrollTop: 0 });
    });

});
