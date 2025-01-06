'use strict';

$(document).ready(function () {
    if (themeLayout == 2 || themeLayout == 3) {
        $('.theme-setting-field').removeClass('d-none');
    } else {
        $('.theme-setting-field').addClass('d-none');
    }

    $(document).on('change', '.profile_image', function () {
        if (isValidProfile($(this), $('#validationErrorsBox'))) {
            displayPhoto(this, $('#profilePreview'));
        } else {
            setTimeout(function () { $('.alert').fadeOut('slow'); }, 3000);
            return false;
        }
        $.ajax({
            url: route('update.profile.image'),
            type: 'POST',
            data: new FormData($('#profileImageUpdate')[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    function isValidProfile (inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'gif']) == -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html('The image must be a file of type: jpg, jpeg, png, gif.').
                show();
            return false;
        }
        $(validationMessageSelector).hide();
        return true;
    };

    $(document).on('submit', '#updateUserForm', function (e) {
        e.preventDefault();
        processingBtn('#updateUserForm', '#btnProfileSave', 'loading');
        let empty = $('#userAboutMe').val().trim().replace(/ \r\n\t/g, '') ===
            '';
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            processingBtn('#updateUserForm', '#btnProfileSave', 'reset');
            return false;
        } else if (empty) {
            displayErrorMessage(
                'About me field is not contain only white space');
            processingBtn('#updateUserForm', '#btnProfileSave', 'reset');
            return false;
        }

        if ($('#regionCode').val() === '') {
            displayErrorMessage('Region code must be selected with Phone');
            processingBtn('#updateUserForm', '#btnProfileSave', 'reset');
            return false;
        }

        $('#updateUserForm')[0].submit();
        return true;
    });
});
