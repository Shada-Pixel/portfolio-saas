'use strict';

$(document).ready(function () {
    let tablename = $('#recentWorkTypeTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('recent-work-types.index'),
        },
        columnDefs: [
            {
                'targets': [0],
            },
            {
                'targets': [1],
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
                data: function (row) {
                    let url = route('recent-work-types.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#recentWorkTypesTemplate',
                        data);
                }, name: 'id',
            },
        ],
    });

    $(document).on('submit', '#recentWorkTypeForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');

        let formData = $(this).serialize();
        $.ajax({
            url: route('recent-work-types.store'),
            type: 'POST',
            data: formData,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#recentWorkTypesModal').modal('hide');
                    $('#recentWorkTypeTable').
                        DataTable().
                        ajax.
                        reload(null, false);
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

    $('#recentWorkTypesModal').on('hidden.bs.modal', function () {
        resetModalForm('#recentWorkTypeForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function () {
        let id = $(this).attr('data-id');

        $.ajax({
            url: route('recent-work-types.edit', id),
            type: 'GET',
            success: function (result) {
                $('#recentWorkTypeId').val(result.data.id);
                $('#editName').val(result.data.name);
            },
        });
    });

    $(document).on('submit', '#updateRecentWorkFormForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let formData = $(this).serialize();
        let id = $('#recentWorkTypeId').val();
        $.ajax({
            url: route('recent-work-types.update', id),
            type: 'PUT',
            data: formData,
            success: function (result) {
                $('#updateModal').modal('hide');
                displaySuccessMessage(result.message);
                $('#recentWorkTypeTable').DataTable().ajax.reload(null, false);
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
        let recentWorkTypeId = $(event.currentTarget).data('id');
        let deleteRecentWorkType = route('recent-work-types.destroy',
            recentWorkTypeId);
        deleteItem(deleteRecentWorkType, '#recentWorkTypeTable',
            'Recent Work Type');
    });

});
