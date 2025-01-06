'use strict';

$(document).ready(function () {
    let filename;

    $('input[name=theme_layout]:radio').click(function (ev) {
        if (ev.currentTarget.value == 1) {
            $('.active-img1').addClass('activeTheme');
            $('.active-img2, .active-img3').removeClass('activeTheme');

        } else if (ev.currentTarget.value == 2) {
            $('.active-img2').addClass('activeTheme');
            $('.active-img1, .active-img3').removeClass('activeTheme');

        } else if (ev.currentTarget.value == 3) {
            $('.active-img3').addClass('activeTheme');
            $('.active-img1, .active-img2').removeClass('activeTheme');

        }
    });

    $(document).on('change', '#companyLogo', function () {
        filename = $(this).val();
        if (isValidFile($(this), '#validationErrorsBox')) {
            displayPhoto(this, '#companyLogoPreview');
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    window.isValidFile = function (inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html('The image must be a file of type: gif, png ,jpg ,jpeg.').
                show();
            setTimeout(function (){
                $('#validationErrorsBox').delay(5000).slideUp(300);
            });
            return false;
        }
        return true;
    };

    window.displayPhoto = function (input, selector) {
        let displayPreview = true;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    $(selector).attr('src', e.target.result);
                    displayPreview = true;
                };
            };
            if (displayPreview) {
                reader.readAsDataURL(input.files[0]);
                $(selector).show();
            }
        }
    };
    
    $(document).on('change', '#favicon', function () {
        if (isValidFavicon($(this), '#validationErrorsBox')) {
            displayFavicon(this, '#faviconPreview');
        }
    });
    
    window.isValidFavicon = function (inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'ico']) == -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html('The image must be a file of type: gif, ico, png.').
                show();
            setTimeout(function (){
                $('#validationErrorsBox').delay(5000).slideUp(300);
            });
            return false;
        }
        $(validationMessageSelector).hide();
        return true;
    };

    window.displayFavicon = function (input, selector) {
        let displayPreview = true;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    if ((image.height != 16 || image.width != 16) && (image.height != 32 || image.width != 32)) {
                        $('#favicon').val('');
                        $('#validationErrorsBox').removeClass('d-none');
                        $('#validationErrorsBox').html('The image must be of pixel 16 x 16 and 32 x 32.').show();
                        setTimeout(function (){
                            $('#validationErrorsBox').delay(5000).slideUp(300);
                        });
                        return false;
                    }
                    $(selector).attr('src', e.target.result);
                    displayPreview = true;
                };
            };
            if (displayPreview) {
                reader.readAsDataURL(input.files[0]);
                $(selector).show();
            }
        }
    };

    $(document).on('click', '#addItem', function () {
        let data = {
            'uniqueId': uniqueId,
        };
        let sociualSettingHtml = prepareTemplateRender(
            '#socialSettingTemplate', data);
        $('.social-setting-container').append(sociualSettingHtml);

        //initial iconpicker
        $('#iconPicker' + uniqueId).iconpicker();

        //when change icon, get icon value and set value. 
        $('.socialSettingIcon').on('change', function (event) {
            let recordId = $(event.currentTarget).data('id');
            $('.social-icon' + recordId).val(event.icon);
            console.log($('.social-icon' + recordId).val());
        });

        uniqueId++;
        resetSocialSettingIndex();
    });
    
    $(document).on('click', '.delete-social-icon', function () {
        $(this).parents('tr').remove();
        resetSocialSettingIndex();
    });

    function resetSocialSettingIndex () {
        let index = 1;
        $('.social-setting-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
    }

    //edit record when change edit iconpicker
    $('.editSocialSettingIcon').on('change', function (event) {
        let recordId = $(event.currentTarget).data('id');
        $('.edit-social-setting-icon' + recordId).val('').val(event.icon);
    });
    
    $(document).on('submit', '#editSetting', function (e) {
        e.preventDefault();
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }
        if (typeof termsAndConditionsDescription != 'undefined' &&
            typeof privacyPolicyDescription != 'undefined') {
            if ($('#termsAndConditions').summernote('isEmpty')) {
                displayErrorMessage('Terms and Conditions is required.');

                return false;
            }
            if ($('#privacyPolicy').summernote('isEmpty')) {
                displayErrorMessage('Privacy Policy is required.');

                return false;
            }
            let description = $('<div />').
                html($('#termsAndConditions').summernote('code'));
            let empty = description.text().trim().replace(/ \r\n\t/g, '') ===
                '';

            if ($('#termsAndConditions').summernote('isEmpty')) {
                $('#termsAndConditions').val('');
            } else if (empty) {
                displayErrorMessage(
                    'Terms and Conditions field is not contain only white space');
                return false;
            }

            let privacyPolicy = $('<div />').
                html($('#privacyPolicy').summernote('code'));
            let privacyPolicyEmpty = privacyPolicy.text().
                trim().
                replace(/ \r\n\t/g, '') === '';

            if ($('#privacyPolicy').summernote('isEmpty')) {
                $('#privacyPolicy').val('');
            } else if (privacyPolicyEmpty) {
                displayErrorMessage(
                    'Privacy Policy field is not contain only white space');
                return false;
            }
        }
        processingBtn('#editSetting', '#btnSave',
            'loading');
        $('#editSetting')[0].submit();
    });

    // privacy script
    if (typeof termsAndConditionsDescription != 'undefined' &&
        typeof privacyPolicyDescription != 'undefined') {
        $('#termsAndConditions').summernote({
            placeholder: typeof termsAndConditionsDescription != 'undefined'
                ? termsAndConditionsDescription
                : '',
            minHeight: 300,
            toolbar: [
                ['style', ['style']],
                [
                    'font',
                    ['bold', 'underline', 'italic', 'strikethrough', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });

        $('#privacyPolicy').summernote({
            placeholder: typeof privacyPolicyDescription != 'undefined'
                ? privacyPolicyDescription
                : '',
            minHeight: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'strikethrough', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });

        setTimeout(function () {
            $('#termsAndConditions').summernote('code', termsAndConditions);
            $('#privacyPolicy').summernote('code', privacyPolicy);
        }, 1000);
    }

    let maxLength = 250;
    let contactUsDescriptionlength = $('#contactUsDescription').val();
    if (contactUsDescriptionlength != null) {
        $('#characterCount').
            text(maxLength - $('#contactUsDescription').val().length);
        charactorsCount('#contactUsDescription', maxLength, '#characterCount');
    }
});
