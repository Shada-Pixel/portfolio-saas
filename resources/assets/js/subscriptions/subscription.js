'use strict';
$(document).ready(function () {
    $('.payment_method').select2({
        'width': '100%',
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $(document).on('change', '.payment_method', function () {
        let payment_id = $(this).val();
        if (payment_id == 1) {
            $('.payment-stripe').removeClass('d-none');
            $('.payment-paypal').addClass('d-none');
        } else if (payment_id == 2) {
            $('.payment-stripe').addClass('d-none');
            $('.payment-paypal').removeClass('d-none');
        }
    });

    $(document).on('click', '.makePayment', function () {
        if (typeof getLoggedInUserdata != 'undefined' && getLoggedInUserdata ==
            '') {
            window.location.href = logInUrl;

            return true;
        }

        if ($(this).data('plan-price') === 0) {
            $(this).addClass('disabled');
            let data = {
                plan_id: $(this).data('id'),
                price: $(this).data('plan-price'),
            };
            $.post(makePaymentURL, data).done((result) => {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    location.reload();
                }, 5000);
            }).catch(error => {
                $(this).html(subscribeText).removeClass('disabled');
                $('.makePayment').attr('disabled', false);
                displayErrorMessage(error.responseJSON.message);
            });

            return true;
        }

        let payloadData = {
            plan_id: $(this).data('id'),
            from_pricing: typeof fromPricing != 'undefined'
                ? fromPricing
                : null,
            price: $(this).data('plan-price'),
        };
        $(this).addClass('disabled');
        $.post(makePaymentURL, payloadData).done((result) => {
            let sessionId = result.data.sessionId;
            stripe.redirectToCheckout({
                sessionId: sessionId,
            }).then(function (result) {
                $(this).html(subscribeText).removeClass('disabled');
                $('.makePayment').attr('disabled', false);
                displayErrorMessage(result.responseJSON.message);
            });
        }).catch(error => {
            $(this).html(subscribeText).removeClass('disabled');
            $('.makePayment').attr('disabled', false);
            displayErrorMessage(error.responseJSON.message);
        });
    });

    $(document).on('click', '.paymentByPaypal', function () {
        $(this).addClass('disabled');
        $.ajax({
            type: 'GET',
            url: makePaypalUrl,
            data: { 'planId': $(this).data('id'),
                'from_pricing': typeof fromPricing != 'undefined'
                    ? fromPricing
                    : null,
            },
            success: function (result) {
                if (result.url) {
                    window.location.href = result.url;
                }
                if (result.statusCode == 201) {
                    let redirectTo = '';

                    $.each(result.result.links,
                        function (key, val) {
                            if (val.rel == 'approve') {
                                redirectTo = val.href;
                            }
                        });
                    window.location.href = redirectTo;
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        });
    });
});
