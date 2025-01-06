'use strict';

$(document).ready(function () {
    let tablename = $('#skillsTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('skills.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'className': 'text-wrap',
            },
            {
                'targets': [1],
                'className':'text-center',
                'width': '5%',
            },
            {
                'targets': [2],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'percentage',
                name: 'percentage',
            },
            {
                data: function (row) {
                    let url = route('skills.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#skillsTemplate', data);
                }, name: 'id',
            },
        ],
    });

    $(document).on('submit', '#skillForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#skillSaveBtn');
        loadingButton.button('loading');

        let formData = $(this).serialize();
        $.ajax({
            url: route('skills.store'),
            type: 'POST',
            data: formData,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#skillsModal').modal('hide');
                    $('#skillsTable').DataTable().ajax.reload(null, false);
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

    $('#skillsModal').on('hidden.bs.modal', function () {
        resetModalForm('#skillForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('skills.edit', id),
            type: 'GET',
            success: function (result) {
                $('#skillId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editPercentage').val(result.data.percentage);
                $('#editModal').modal('show');
            },
        });

    }

    $(document).on('submit', '#skillUpdateForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#skillSaveBtn');
        loadingButton.button('loading');
        let formData = $(this).serialize();
        let id = $('#skillId').val();
        $.ajax({
            url: route('skills.update', id),
            type: 'PUT',
            data: formData,
            success: function (result) {
                $('#editModal').modal('hide');
                displaySuccessMessage(result.message);
                $('#skillsTable').DataTable().ajax.reload(null, false);
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
        let skillId = $(event.currentTarget).data('id');
        let deleteSkillUrl = route('skills.destroy', skillId);
        deleteItem(deleteSkillUrl, '#skillsTable', 'Skill');
    });

});
