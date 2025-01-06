'use strict';

$(document).ready(function () {
    
    $(document).on('focusout', '#phoneNumber', function (){
        let errorMsg = $(this).attr('data-content');
        $('#error-msg').text('');
        if (typeof errorMsg !== 'undefined' && errorMsg !== false) {
            $('#error-msg').removeClass('hide').append(errorMsg);
            $(this).focus();
        } 
    });
    $(document).on('submit', '#sendEnquiryForm', function (e) {
        e.preventDefault();
        
        let errorMsg = $('#phoneNumber').attr('data-content');
        $('#error-msg').text('');
        if (typeof errorMsg !== 'undefined' && errorMsg !== false) {
            $('#error-msg').removeClass('hide').append(errorMsg);
            $('#phoneNumber').focus();
            return false;
        }
        // if ($('#error-msg').text() !== '') {
        //     $('#phoneNumber').focus();
        //     return false;
        // }
        let loadingButton = jQuery(this).find('#enquiryBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('send.enquiry', userName),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    setTimeout(function () {
                        location.reload();
                    }, 400);
                }
            },
            error: function (result) {
                grecaptcha.reset();
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

});
