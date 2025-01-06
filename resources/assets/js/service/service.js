'use strict';

$(document).ready(function () {

    //create new record
    const pickr = createColorPicker();
    setTimeout(function () {
        pickr.setColor(serviceDefaultColor);
    }, 100);
    let picked = false;
    pickr.on('change', function () {
        const color = pickr.getColor().toHEXA().toString();
        pickr.setColor(color);
        $('#color').val(color);
        picked = true;
    });

    //edit record
    const editPickr = editColorPicker();
    editPickr.on('change', function () {
        const color = editPickr.getColor().toHEXA().toString();
        editPickr.setColor(color);
        $('#edit_color').val(color);
    });

    let tablename = $('#serviceTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[4, 'desc']],
        ajax: {
            url: route('services.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'className': 'text-center',
                'orderable': false,
                'width': '5%',
            },
            {
              'targets': [1],
              'className': 'text-wrap',  
            },
            {
                'targets': [2],
                'width': '7%',
                'className': 'text-center',
                'orderable': false,
            },
            {
                'targets': [3],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
            {
                'targets': [4],
                'visible': false,
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<img src="' + row.icon_image +
                        '" class="rounded-circle thumbnail-rounded"' +
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
                data:function (row) {
                    let inStyle = 'style';
                    if (row.color == '#FFFFFF'){
                        return `<span class="badge data-table-common-color d-block" ${inStyle}="background:#f5365c"></span>`;
                    }else {
                        return `<span class="badge data-table-common-color d-block" ${inStyle}="background: ${row.color}"></span>`;
                    }
                },
                name:'id',
            },
            {
                data: function (row) {
                    let url = route('services.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#serviceTemplate', data);
                }, name: 'id',
            },
            {
                data: function (row) {
                    return row.created_at;
                },
                name: 'created_at',
            },
        ],
    });

    $(document).on('click', '.addNewServices', function (event) {
        $('.pcr-button').
            css({ 'color': '#f5365c', 'border': '1px solid grey' });
        $('#serviceModal').appendTo('body').modal('show');
    });
    
    let filename;
    $(document).on('change', '#icon', function () {
        filename = $(this).val();
        if (isValidImg($(this), '#validationErrorsBox')) {
            serviceDisplayPhoto(this, '#iconPreview');
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    $(document).on('change', '#editIcon', function () {
        filename = $(this).val();
        if (isValidImg($(this), '#editValidationErrorsBox')) {
            serviceDisplayPhoto(this, '#editIconPreview');
        }
        $('#editValidationErrorsBox').delay(3000).slideUp(300);
    });

    
    $(document).on('submit', '#serviceForm', function (e) {
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
        if (!picked) {
            displayErrorMessage('Please select color.');
            return false;
        }

        let loadingButton = jQuery(this).find('#serviceSaveBtn');
        loadingButton.button('loading');
        $.ajax({
            url: route('services.store'),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#serviceModal').modal('hide');
                    $('#serviceTable').DataTable().ajax.reload(null, false);
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

    $('#serviceModal').on('hidden.bs.modal', function () {
        $('#characterCount').text(maxLength);
        $('#iconPreview').attr('src', defaultImage);
        filename = null;
        pickr.setColor('#000000');
        pickr.hide();
        resetModalForm('#serviceForm', '#validationErrorsBox');
    });
    
    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });
    
    function renderData (id) {
        let maxLength = 355;
        $.ajax({
            url: route('services.edit', id),
            type: 'GET',
            success: function (result) {
                $('#serviceId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#showCreatedOn').val(result.data.created_at);
                $('#showUpdatedOn').val(result.data.updated_at);
                $('#editDescription').
                    text(result.data.description);
                $('#editCharacterCount').
                    text(maxLength - $('#editDescription').val().length);
                editPickr.setColor(result.data.color);
                $('#editIconPreview').attr('src', result.data.icon_image);
                $('#editModal').modal('show');
            },
        });

    }

    $(document).on('submit', '#serviceUpdateForm', function (e) {
        let empty = $('#editDescription').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty) {
            displayErrorMessage(
                'Description field is not contain only white space');
            return false;
        }
        e.preventDefault();
        let loadingButton = jQuery(this).find('#serviceSaveBtn');
        loadingButton.button('loading');
        let id = $('#serviceId').val();
        $.ajax({
            url: route('service.update', id),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                $('#editModal').modal('hide');
                displaySuccessMessage(result.message);
                $('#serviceTable').DataTable().ajax.reload(null, false);
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#editModal').on('hidden.bs.modal', function () {
        $('#editCharacterCount').text(maxLength);
        editPickr.hide();
        resetModalForm('#serviceUpdateForm', '#editValidationErrorsBox');
    });

    $(document).on('click', '.show-btn', function (event) {
        let servicelId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('services.show', servicelId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#showName').html('');
                    $('#showDescription').html('');
                    $('#iconPreview').attr('');
                    $('#showCreatedOn').html('');
                    $('#showUpdatedOn').html('');
                    $('.showColor').html('');
                    $('#showName').append(result.data.name);
                    let element = document.createElement('textarea');
                    element.innerHTML = (!isEmpty(result.data.description))
                        ? result.data.description
                        : 'N/A';
                    $('#showDescription').html(element.value);
                    if (result.data.color == '#FFFFFF'){
                        $('.showColor').css('background','#f5365c');
                    }else {
                        $('.showColor').css('background',result.data.color)
                    }
                    $('#showCreatedOn').
                        append(moment(result.data.created_at).fromNow());
                    $('#showUpdatedOn').
                        append(moment(result.data.updated_at).fromNow());
                    $('#showIconPreview').attr('src', result.data.icon_image);
                    $('#showModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let serviceId = $(event.currentTarget).data('id');
        let deleteServiceUrl = route('services.destroy', serviceId);
        deleteItem(deleteServiceUrl, tablename, 'Service');
    });

    window.serviceDisplayPhoto = function (input, selector, validationMessageSelector) {
        let displayPreview = true;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    // if ((image.height < 300 || image.width < 300)) {
                    //     $('#iconicon').val('');
                    //     $('#editIcon').val('');
                    //     $(validationMessageSelector).removeClass('d-none');
                    //     displayErrorMessage('The image must be grater than of pixel 300x300.')
                    //     return false;
                    // }
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

    let maxLength = 355;
    $('#characterCount').text(maxLength);
    $('#editCharacterCount').text(maxLength);
    charactorsCount('#description', maxLength, '#characterCount');
    charactorsCount('#editDescription', maxLength, '#editCharacterCount');
});
