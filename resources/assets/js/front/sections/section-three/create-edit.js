'use strict';

$(document).ready(function () {
    let filename;
    let attachmentPreviewNo;

    $(document).on('change', '.cms-attachment', function () {
        filename = $(this).val();
        attachmentPreviewNo = $(this).data('attachment-preview');
        if (isValidFile($(this), '#validationErrorsBox')) {
            attachmentPreviewNo = $(this).data('attachment-preview');
            displayPhoto(this, '#attachmentPreview_' + attachmentPreviewNo);
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    window.isValidFile = function (inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        let fileTypeArray = ['gif', 'png', 'jpg', 'jpeg'];
        let fileTypeMessage = 'The image must be a file of type: gif, png ,jpg ,jpeg.';
        if ($('#sectionNo').val() == 3) {
            fileTypeArray.push('svg');
            fileTypeMessage = 'The image must be a file of type: gif, png ,jpg ,jpeg, svg.';
        }

        if ($.inArray(ext, fileTypeArray) == -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html(fileTypeMessage).
                show();
            setTimeout(function () {
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

    $(document).on('submit', '#createSectionThreeForm', function (e) {
        e.preventDefault();
        if (filename == null || filename == '') {
            displayErrorMessage('Please select image');
            return false;
        }
        let empty = $('#slider_text').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty) {
            displayErrorMessage('Slider Text does not contain only white space');
            return false;
        }
        processingBtn('#createSectionThreeForm', '#btnSave', 'loading');
        $('#createSectionThreeForm')[0].submit();
    });

    $(document).on('submit', '#editSectionThreeForm', function (e) {
        e.preventDefault();
        let empty = $('#slider_text').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty) {
            displayErrorMessage('Slider Text does not contain only white space');
            return false;
        }
        processingBtn('#editSectionThreeForm', '#btnSave', 'loading');
        $('#editSectionThreeForm')[0].submit();
    });
});
