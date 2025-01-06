'use strict';

$(document).ready(function () {
    let tablename = $('#testimonialTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[1, 'asc']],
        ajax: {
            url: route('testimonials.index'),
        },
        columnDefs: [
            {
              'targets': [1],
              'className': 'text-wrap',  
            },
            {
                'targets': [0],
                'width': '7%',
                'orderable': false,
                'className': 'text-center',
            },
            {
                'targets': [3],
                'width': '7%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<img src="' + row.image_url +
                        '" class="rounded-circle thumbnail-rounded"/>' +
                        '</img>';
                },
                name: 'id',
            },
            {
                data: function (row) {
                    return '<a href="#" class="show-btn text-blue"  data-id="' +
                        row.id +
                        '">' + row.name + ' </a>';
                },
                name: 'name',
            },
            {
                data: 'position',
                name: 'position',
            },
            {
                data: function (row) {
                    let url = route('testimonials.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#testimonialTemplate', data);
                }, name: 'id',
            },
        ],
    });
    
    let filename = '';
    $(document).on('change', '#image', function () {
        filename = $(this).val();
        if (isValidImage($(this), '#validationErrorsBoxTestimonial')) {
            testimonialDisplayImage(this, '#imgPreview');
        }
        $('#validationErrorsBoxTestimonial').delay(3000).slideUp(300);
    });

    $(document).on('change', '#editImage', function () {
        if (isValidImage($(this), '#editValidationErrorsBox')) {
            testimonialDisplayImage(this, '#editImagePreview');
        }
        $('#editValidationErrorsBox').delay(3000).slideUp(300);
    });

    $(document).on('submit', '#testimonialForm', function (e) {
        e.preventDefault();

        let empty = $('#description').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty) {
            displayErrorMessage(
                'Description field is not contain only white space');
            return false;
        }
        
        if (filename == null || filename == '') {
            displayErrorMessage('Please select image');
            return false;
        }

        // if (filename != null || filename != '') {
        //     filename = null;
        // }

        let loadingButton = jQuery(this).find('#testimonialSaveBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('testimonials.store'),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#testimonialModal').modal('hide');
                    $('#testimonialTable').DataTable().ajax.reload(null, false);
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

    $('#testimonialModal').on('hidden.bs.modal', function () {
        $('#characterCount').text(maxLength);
        $('#imgPreview').attr('src',defaultImage)
        $('#image').val('');
        filename = '';
        resetModalForm('#testimonialForm', '#validationErrorsBoxTestimonial');
    });

    $('#editModal').on('hidden.bs.modal', function () {
        $('#editCharacterCount').text(maxLength);
        $('#editImagePreview').attr('src','');
        resetModalForm('#testimonialUpdateForm', '#editValidationErrorsBox');
    });
    
    $('.addModalTestimonial').on('click', function (e) {
        $('#testimonialModal').appendTo('body').modal('show');
    });

    $(document).on('click', '.show-btn', function (event) {
        let testimonialId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('testimonials.show', testimonialId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#showName').html('');
                    $('#showPosition').html('');
                    $('#showDescription').html('');
                    $('#showImage').html('');
                    $('#showCreatedOn').html('');
                    $('#showUpdatedOn').html('');
                    $('#showName').append(result.data.name);
                    let element = document.createElement('textarea');
                    element.innerHTML = (!isEmpty(result.data.description))
                        ? result.data.description
                        : 'N/A';
                    $('#showDescription').html(element.value);
                    $('#showPosition').append(result.data.position);
                    $('#showImage').attr('src', result.data.image_url);
                    $('#showCreatedOn').
                        append(moment(result.data.created_at).fromNow());
                    $('#showUpdatedOn').
                        append(moment(result.data.updated_at).fromNow());
                    $('#showImage').attr('src', result.data.image_url);
                    $('#showModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        let maxLength = 295;
        $.ajax({
            url: route('testimonials.edit', id),
            type: 'GET',
            success: function (result) {
                $('#testimonialId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#showCreatedOn').val(result.data.created_at);
                $('#showUpdatedOn').val(result.data.updated_at);
                $('#editPosition').val(result.data.position);
                $('#editDescription').text(result.data.description);
                $('#editCharacterCount').
                    text(maxLength - $('#editDescription').val().length);
                $('#editImagePreview').attr('src', result.data.image_url);
                $('#editModal').modal('show');
            },
        });
    }

    $(document).on('submit', '#testimonialUpdateForm', function (e) {
        e.preventDefault();
        let empty = $('#editDescription').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty) {
            displayErrorMessage(
                'Description field is not contain only white space');
            return false;
        }
        let loadingButton = jQuery(this).find('#testimonialSaveBtn');
        loadingButton.button('loading');

        let id = $('#testimonialId').val();
        $.ajax({
            url: route('testimonial.update', id),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                $('#editModal').modal('hide');
                displaySuccessMessage(result.message);
                $('#testimonialTable').DataTable().ajax.reload(null, false);
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let testimonialId = $(event.currentTarget).data('id');
        let deleteTestimonialUrl = route('testimonials.destroy', testimonialId);
        deleteItem(deleteTestimonialUrl, '#testimonialTable', 'Testimonial');
    });

    // function checkDescription (selector) {
    //     let $description = $('<div />').html(selector.summernote('code'));
    //     let empty = $description.text().trim().replace(/ \r\n\t/g, '') === '';
    //
    //     if (selector.summernote('isEmpty')) {
    //         displayErrorMessage('Description field is required.');
    //         return false;
    //     } else if (empty) {
    //         displayErrorMessage(
    //             'Description field is not contain only white space');
    //         return false;
    //     }
    //
    //     return true;
    // }

    window.testimonialDisplayImage = function (input, selector, validationMessageSelector) {
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
    
    let maxLength = 295;
    $('#characterCount').text(maxLength);
    $('#editCharacterCount').text(maxLength);
    charactorsCount('#description', maxLength, '#characterCount');
    charactorsCount('#editDescription', maxLength, '#editCharacterCount');
    
});
