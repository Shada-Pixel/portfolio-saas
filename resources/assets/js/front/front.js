'use strict';

$(document).ready(function () {
    $(document).on('submit', '#editSectionForm', function (e) {
        e.preventDefault();
        processingBtn('#editSectionForm', '#btnSectionSave', 'loading');
        $('#editSectionForm')[0].submit();
    });

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

        if ($.inArray(ext, fileTypeArray) == -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html('The image must be a file of type: gif, png ,jpg ,jpeg.').
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
});
