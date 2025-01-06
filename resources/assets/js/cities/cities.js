'use strict';

$(document).ready(function () {
    $('#stateFieldID,#editStateFieldID').select2({
        'width': '100%',
        'placeholder': message,
    });
    $('#filterState').select2({
        width: '170px',
    });

    $('#cityModal, #editModal').on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
    });

    let tablename = $('#citiesTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('cities.index'),
            data: function (data) {
                data.state_id = $('#filterState').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [2],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
            },
        ],
        columns: [
            {
                data: function (row) {
                    if (row.name !== '')
                        return row.name;
                    else
                        return 'N/A';
                },
                name: 'name',
            },
            {
                data: 'state.name',
                name: 'state_id',
            },
            {
                data: function (row) {
                    let url = route('cities.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#citiesTemplate', data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filterState', function () {
                $('#citiesTable').DataTable().ajax.reload(null, true);
            });
        },
    });

    $(document).on('submit', '#createCityForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('cities.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#cityModal').modal('hide');
                    $(tablename).DataTable().ajax.reload(null, false);
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

    $('#cityModal').on('hidden.bs.modal', function () {
        $('#stateFieldID').val([]).trigger('change');
        resetModalForm('#createCityForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('cities.edit', id),
            type: 'GET',
            success: function (result) {
                $('#cityFieldId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editStateFieldID').
                    val(result.data.state_id).
                    trigger('change.select2');
                $('#editModal').modal('show');
            },
        });

    }

    $(document).on('submit', '#editCityForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#editSaveBtn');
        loadingButton.button('loading');
        let id = $('#cityFieldId').val();
        $.ajax({
            url: route('cities.update', id),
            type: 'PUT',
            data: $(this).serialize(),
            success: function (result) {
                $('#editModal').modal('hide');
                displaySuccessMessage(result.message);
                $(tablename).DataTable().ajax.reload(null, false);
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
        let cityId = $(event.currentTarget).data('id');
        let deleteCityUrl = route('cities.destroy', cityId);
        deleteItem(deleteCityUrl, '#citiesTable', 'City');
    });
});
