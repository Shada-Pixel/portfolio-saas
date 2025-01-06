'use strict';
$(document).ready(function () {

    $(document).on('submit', '#createBlogForm', function (e) {
        e.preventDefault();
        let $description = $('<div />').
            html($('#description').summernote('code'));
        let empty = $description.text().trim().replace(/ \r\n\t/g, '') === '';

        if ($('#description').summernote('isEmpty')) {
            displayErrorMessage('Body field is required.');
            return false;
        } else if (empty) {
            displayErrorMessage(
                'Body field is not contain only white space');
            return false;
        }

        processingBtn('#createBlogForm', '#btnSave', 'loading');
        $('#createBlogForm')[0].submit();
        return true;
    });

    $(document).on('submit', '#updateBlogForm', function (e) {
        e.preventDefault();
        let $description = $('<div />').
            html($('#editDescription').summernote('code'));
        let empty = $description.text().trim().replace(/ \r\n\t/g, '') === '';

        if ($('#editDescription').summernote('isEmpty')) {
            displayErrorMessage('Description field is required.');
            return false;
        } else if (empty) {
            displayErrorMessage(
                'Description field is not contain only white space');
            return false;
        }

        processingBtn('#updateBlogForm', '#btnSave', 'loading');
        $('#updateBlogForm')[0].submit();
        return true;
    });

    $('#description , #editDescription, #categoryDescription, #editCategoryDescription').summernote({
        placeholder: blogBody,
        minHeight: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#category, #editCategory').select2();

    let filename = '';
    $(document).on('change', '#img', function () {
        filename = $(this).val();
        if (isValidImage($(this), '#validationErrorsBox')) {
            blogDisplayImage(this, '#imgPreview');
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    $(document).on('keyup', '#blogTitle', function () {
        let slug = $(this).
            val().
            toLowerCase().
            replace(/ /g, '-').
            replace(/[^\w-]+/g, '');
        $('#slugValue').val(slug);
    });

    window.blogDisplayImage = function (input, selector, validationMessageSelector) {
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

    $(document).on('submit', '#createCategoryForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        $.ajax({
            url: route('category.get'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#categoryModal').modal('hide');
                    let data = {
                        id: result.data.id,
                        text: result.data.name
                    }
                    let newOption = new Option(data.text, data.id, false, true);
                    $('#category').append(newOption).trigger('change');
                    $('#editCategory').append(newOption).trigger('change');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#categoryModal').on('hidden.bs.modal', function () {
        resetModalForm('#createCategoryForm', '#validationErrorsBox');
        $('#categoryDescription').summernote('code', '');
    });

    $(document).on('keyup','#categoryTitle',function () {
        let slug = $(this).val().toLowerCase().replace(/ /g, '-').
            replace(/[^\w-]+/g, '');
        $('#categorySlugValue').val(slug);
    });
});
