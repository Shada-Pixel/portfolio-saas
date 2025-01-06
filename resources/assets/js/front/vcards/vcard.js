'use strict';

$(document).ready(function () {
    $('.services-sliders, .testimonial-sliders').slick({
        // autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
    });

    $(document).on('click', '.service-button', function (event) {
        event.preventDefault();
        let serviceId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('vcard.service', serviceId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#showDescription').html(result.data.description);
                    $('#showVCardModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.share-vcard', function (event) {
        event.preventDefault();
        let vcardId = $(this).data('id');
        $('#shareVCardModal').appendTo('body').modal('show');
        $('.share-facebook').
            attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' +
                route('vcard', vcardId));
        $('.share-linkedin-in').
            attr('href',
                'https://www.linkedin.com/shareArticle?mini=true&url=' +
                route('vcard', vcardId));
        $('.share-twitter').
            attr('href', 'https://twitter.com/intent/tweet?text=' +
                route('vcard', vcardId));
        $('.share-whatsapp').
            attr('href', 'https://wa.me/send?text=' + route('vcard', vcardId));
    });
});
