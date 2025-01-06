'use strict';

$(document).ready(function () {
    let tablename = $('#sectionFiveTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('section-five.index'),
        },
        columnDefs: [
            {
                'targets': [1],
                'className': 'text-wrap',
            },
            {
                'targets': [0],
                'width': '7%',
            },
            {
                'targets': [2],
                'width': '7%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a href="#" class="show-btn text-blue"  data-id="' +
                        row.id +
                        '">' + row.text_main + ' </a>';
                },
                name: 'text_main',
            },
            {
                data: 'text_secondary',
                name: 'text_secondary',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];

                    return prepareTemplateRender('#sectionFiveTemplate', data);
                }, name: 'id',
            },
        ],
    });

    let filename = '';
    $(document).on('change', '#editImage', function () {
        if (isValidImage($(this), '#editValidationErrorsBox')) {
            sectionFiveDisplayImage(this, '#editImagePreview');
        }
        $('#editValidationErrorsBox').delay(3000).slideUp(300);
    });

    $(document).on('submit', '#sectionFiveForm', function (e) {
        e.preventDefault();

        let loadingButton = jQuery(this).find('#sectionFiveSaveBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('section-five.store'),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addSectionFiveModal').modal('hide');
                   tablename.DataTable().ajax.reload(null, false);
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

    $('#addSectionFiveModal').on('hidden.bs.modal', function () {
        resetModalForm('#sectionFiveForm', '#validationErrorsBoxTestimonial');
    });

    $('#editSectionFiveModal').on('hidden.bs.modal', function () {
        $('#editImagePreview').attr('src','');
        resetModalForm('#sectionFiveUpdateForm', '#editValidationErrorsBox');
    });

    $('.addSectionFiveModal').on('click', function (e) {
        $('#addSectionFiveModal').appendTo('body').modal('show');
    });

    $(document).on('click', '.show-btn', function (event) {
        let sectionFiveId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('section-five.show', sectionFiveId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('.text-main').html('');
                    $('.text-title-secondary').html('');
                    $('.section-five-title').html('');
                    $('.show-image').html('');
                    $('.show-created-on').html('');
                    $('.show-updated-on').html('');
                    $('.text-main').append(result.data[0].text_main);
                    $('.text-title-secondary').append(result.data[0].text_secondary);
                    $('.section-five-title').append(result.data[1].sectionFiveFront.s5_text_title);
                    $('.show-image').attr('src', result.data[1].sectionFiveFront.s5_main_image);
                    $('.show-created-on').
                        append(moment(result.data[0].created_at).fromNow());
                    $('.show-updated-on').
                        append(moment(result.data[0].updated_at).fromNow());
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
        $.ajax({
            url: route('section-five.edit', id),
            type: 'GET',
            success: function (result) {
                $('#sectionFiveId').val(result.data[1].id);
                $('#textMain').val(result.data[1].text_main);
                $('#textSecondary').val(result.data[1].text_secondary);
                $('#showCreatedOn').val(result.data[1].created_at);
                $('#showUpdatedOn').val(result.data[1].updated_at);
                $('#sectionFiveTitle').val(result.data[0].sectionFiveFront.s5_text_title);
                $('#editImagePreview').attr('src',result.data[0].sectionFiveFront.s5_main_image);
                $('#editSectionFiveModal').modal('show');
            },
        });
    }

    $(document).on('submit', '#sectionFiveUpdateForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#sectionFiveUpdateSaveBtn');
        loadingButton.button('loading');

        let id = $('#sectionFiveId').val();
        $.ajax({
            url: route('section-five.update', id),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                $('#editSectionFiveModal').modal('hide');
                displaySuccessMessage(result.message);
                tablename.DataTable().ajax.reload(null, false);
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
        let sectionFiveId = $(event.currentTarget).data('id');
        let deleteSectionFiveUrl = route('section-five.destroy', sectionFiveId);
        deleteItem(deleteSectionFiveUrl, '#sectionFiveTable', 'Section Five');
    });

    window.sectionFiveDisplayImage = function (input, selector, validationMessageSelector) {
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
