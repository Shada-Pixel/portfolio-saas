'use strict';

$(document).ready(function () {
    $('input').blur();

    //start script of sidebar close on click of link
    $(document).on('click', '.navbar-collapse .navbar-nav .nav-item .nav-link, .filter-backdrop', function () {
        $('.navbar-collapse').collapse('hide');
        
        if ($('.side-menubar').hasClass('sidebar-hide')) {
            $('.side-menubar').removeClass('sidebar-hide');
            $('.filter-backdrop').removeClass("show");
        }

        if ($('.hamburger').hasClass('is-active')) {
            $('.hamburger').removeClass('is-active');
        }
    });

    $(document).on('click', '.navbar-toggler', function () {
        if (!$('.navbar-collapse').hasClass('show')) {
            $('.side-menubar').addClass('sidebar-hide');
            $('.filter-backdrop').addClass("show");
        }
        $('.hamburger').toggleClass('is-active');
    });
    // end script

    // $('.side-menubar').midnight({
    //     headerClass: 'midnightHeader',
    //     defaultClass: 'default',
    // });

    // $(document).ready(function () {
    //     // Change this to the correct selector for your nav.
    //     $('.side-menubar.fixed').midnight();
    // });
    //
    // $('.side-menubar.white').midnight({
    //     // By default, sectionSelector is 'midnight'. It will switch only on elements that have the data-midnight attribute.
    //     sectionSelector: 'midnight',
    // });
    //
    // $('.side-menubar.default').midnight({
    //     // We want this nav to switch only on elements that have the data-noon attribute.
    //     sectionSelector: 'midnight',
    // });

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
    // //recent work
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

    let showMoreskills = false;
    $('.view-more-link-skills').on('click', function () {
        $('.view-all-skills').slideToggle(200);
        if (showMoreskills) {
            $(this).text('').text('View All');
            showMoreskills = false;
        } else {
            showMoreskills = true;
            $(this).text('').text('View Less');
        }
    });

    $('.testimonial-slick').slick({
        dots: true,
        infinite: true,
        speed: 300,
        arrows: false,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    //
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
    //
    $(document).on('click', '.sidebar-url', function () {
        $(this).addClass('active');
        let url = $(this).attr('href');
        let id = url.substring(url.lastIndexOf('/') + 1);
        $('html, body').animate({
            scrollTop: $(id).offset().top,
        }, 500);
    });

    //active header js
    const sections = document.querySelectorAll('.active-link-class');
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

    var btn_top = $('#go-to-top');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn_top.addClass('show_top_page');
        } else {
            btn_top.removeClass('show_top_page');
        }
    });
    //
    btn_top.on('click', function () {
        $('html, body').animate({ scrollTop: 0 });
    });
});
