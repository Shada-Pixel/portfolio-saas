'use strict';

$(document).ready(function () {
    let tablename = $('#achievementTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('achievements.index'),
        },
        columnDefs: [
            {
              'targets': [0],
              'className': 'text-wrap', 
            },
            {
                'targets': [1],
                'className': 'text-center',
                'orderable': false,
                'width': '5%',
            },
            {
                'targets': [2],
                'className': 'text-center',
                'orderable': false,
                'width': '5%',
            },
            {
                'targets': [3],
                'orderable': false,
                'width': '7%',
                'className': 'text-center'
            },
            {
                'targets': [4],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a  href="#" class="show-btn text-blue"  data-id="' + row.id + '">' + row.title + ' </a>';
                },
                name: 'title',
            },
            {
                data: function (row) {
                    if (row.icon != 'empty' && !isEmpty(row.icon)) {
                        return '<i class="about-me-font-icon ' + row.icon +
                            '"></i>';
                    }

                    return 'N/A';
                },
                name: 'icon',
            },
            {
                data: function (row) {
                    if (row.dark_icon != 'empty' && !isEmpty(row.dark_icon) && row.dark_icon != null) {
                        return '<i class="about-me-font-icon ' + row.dark_icon +
                            '"></i>';
                    }

                    return 'N/A';
                },
                name: 'dark_icon',
            },
            {
                data: function (row) {
                    let inStyle = 'style';
                    if (row.color == '#FFFFFF'){
                        return `<span class="badge data-table-common-color d-block" ${inStyle}="background:#f5365c"></span>`;
                    }else {
                        return `<span class="badge data-table-common-color d-block" ${inStyle}="background: ${row.color}"></span>`;
                    }
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let url = route('achievements.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#achievementTemplate', data);
                }, name: 'id',
            },
        ],
    });

    //create new record
    const pickr = createColorPicker();
    let picked = false;
    pickr.on('change', function () {
        const color = pickr.getColor().toHEXA().toString();
        pickr.setColor(color);
        $('#color').val(color);
        picked = true;
    });

    //edit record
    const editPickr = editColorPicker();
    setTimeout(function () {
        pickr.setColor(achievementDefaultColor);
    }, 100);
    
    editPickr.on('change', function () {
        const color = editPickr.getColor().toHEXA().toString();
        editPickr.setColor(color);
        $('#edit_color').val(color);
    });

    $('#achievementModal, #editModal').on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
    });
    
    $(document).on('click', '.achievementModal', function (event) {
        $('.pcr-button').
            css({ 'color': '#f5365c', 'border': '1px solid grey' });
        $('#achievementModal').appendTo('body').modal('show');
    });

    
    $(document).on('submit', '#achievementForm', function (e) {
        e.preventDefault();
        let empty = $('#description').val().trim().replace(/ \r\n\t/g, '') === '';
       if (empty) {
            displayErrorMessage(
                'Short description field is not contain only white space');
            return false;
        }
        let loadingButton = jQuery(this).find('#achievementSaveBtn');
        loadingButton.button('loading');
        $.ajax({
            url: route('achievements.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#achievementModal').modal('hide');
                    $('#achievementTable').DataTable().ajax.reload(null, false);
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

    //create - when change icon than icon value set.
    $('#defaultIconPicker').on('change', function (event) {
        $('.achievementIcon').val(event.icon);
    });
    
    $('#defaultDarkIconPicker').on('change', function (event) {
        $('.achievementDarkIcon').val(event.icon);
    });
 
    //edit - when change icon than icon value set.
    $('#editDefaultIconPicker').on('change', function (event) {
        $('.editAchievementIcon').val(event.icon);
    });

    $('#editDefaultDarkIconPicker').on('change', function (event) {
        $('.editAchievementDarkIcon').val(event.icon);
    });

    $('#achievementModal').on('hidden.bs.modal', function () {
        $('#characterCount').text(maxLength);
        pickr.setColor('#000000');
        pickr.hide();
        resetModalForm('#achievementForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });
    
    function renderData (id) {
        let maxLength = 155;
        $.ajax({
            url: route('achievements.edit', id),
            type: 'GET',
            success: function (result) {
                $('#achievementId').val(result.data.id);
                $('#editTitle').val(result.data.title);
                $('#showCreatedOn').val(result.data.created_at);
                $('#showUpdatedOn').val(result.data.updated_at);
                $('#editDescription').text(result.data.short_description);
                $('#editCharacterCount').
                    text(maxLength - $('#editDescription').val().length);
                editPickr.setColor(result.data.color);
                $('#editDefaultIconPicker').attr('data-icon', result.data.icon).iconpicker('setIcon', result.data.icon);
                $('#editDefaultIconPicker > i').attr('class', '').addClass(result.data.icon);
                if (result.data.dark_icon != null){
                    $('#editDefaultDarkIconPicker').attr('data-icon', result.data.dark_icon).iconpicker('setIcon', result.data.dark_icon);
                    $('#editDefaultDarkIconPicker > i').attr('class', '').addClass(result.data.dark_icon);                    
                }
                $('.editAchievementIcon').val(result.data.icon);
                $('#editModal').modal('show');
            },
        });
    }
    
    $(document).on('submit', '#editAchievementForm', function (e) {
        e.preventDefault();
        let empty = $('#editDescription').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty) {
            displayErrorMessage(
                'Short description field is not contain only white space');
            return false;
        }
        let loadingButton = jQuery(this).find('#editAchievementSaveBtn');
        loadingButton.button('loading');
        let id = $('#achievementId').val();
        $.ajax({
            url: route('achievement-update', id),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#achievementTable').DataTable().ajax.reload(null, false);
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
        resetModalForm('#editAchievementForm', '#editValidationErrorsBox');
    });

    $(document).on('click', '.show-btn', function (event) {
        let achievementId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('achievements.show', achievementId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#showTitle').html('');
                    $('.showColor').html('');
                    $('#showDescription').html('');
                    $('#showCreatedOn').html('');
                    $('#showUpdatedOn').html('');
                    $('#showIcon').html('');
                    $('#showDarkIcon').html('');
                    $('#showTitle').append(result.data.title);
                    $('#showIcon').append(`<i class="about-me-font-icon ${ result.data.icon}"></i>`);
                    if (result.data.dark_icon != null){
                        $('#showDarkIcon').append(`<i class="about-me-font-icon ${ result.data.dark_icon}"></i>`);
                    }else {
                        $('#showDarkIcon').append(`N/A`);
                    }
                    if (result.data.color == '#FFFFFF'){
                        $('.showColor').css('background','#f5365c');
                    }else {
                        $('.showColor').css('background',result.data.color);
                    }
                    let element = document.createElement('textarea');
                    element.innerHTML = (!isEmpty(result.data.short_description))
                        ? result.data.short_description
                        : 'N/A';
                    $('#showDescription').html(element.value);
                    $('#showCreatedOn').
                        append(moment(result.data.created_at).fromNow());
                    $('#showUpdatedOn').
                        append(moment(result.data.updated_at).fromNow());
                    $('#showModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });
    
    $(document).on('click', '.delete-btn', function (event) {
        let achievementId = $(event.currentTarget).data('id');
        let deleteAchievementUrl = route('achievements.destroy', achievementId);
        deleteItem(deleteAchievementUrl, tablename, 'Achievement');
    });

    let maxLength = 155;
    $('#characterCount').text(maxLength);
    $('#editCharacterCount').text(maxLength);
    charactorsCount('#description', maxLength, '#characterCount');
    charactorsCount('#editDescription', maxLength, '#editCharacterCount');
});
