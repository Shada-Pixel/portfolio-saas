<script>let landing = true;</script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
<script src="{{ asset('assets/front/js/functions.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom.js') }}"></script>
<script src="{{ asset('assets/front/js/landing.js') }}"></script>
{{-- <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/front/js/landing.js') }}"></script> --}}
<script>
    // Owl Carousel Scripts
    jQuery(window).on('pluginCarouselReady', function () {
        $('#oc-services').owlCarousel({
            items: 1,
            margin: 30,
            nav: false,
            dots: true,
            smartSpeed: 400,
            responsive: {
                576: { stagePadding: 30, items: 1 },
                768: { stagePadding: 30, items: 2 },
                991: { stagePadding: 150, items: 3 },
                1200: { stagePadding: 150, items: 3 },
            },
        });
    });
</script>
