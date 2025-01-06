'use strict';

$(document).ready(function () {

    let tablename = $('#countriesTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('countries.index'),
        },
        columnDefs: [
            {
                'targets': [3],
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
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    if (row.short_code !== '')
                        return row.short_code;
                    else
                        return 'N/A';
                },
                name: 'short_code',
            },
            {
                data: 'phone_code',
                name: 'phone_code',
            },
            {
                data: function (row) {
                    let url = route('countries.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#countriesTemplate', data);
                }, name: 'id',
            },
        ],
    });

    $(document).on('submit', '#createCountryForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('countries.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#countryModal').modal('hide');
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

    $('#countryModal').on('hidden.bs.modal', function () {
        resetModalForm('#createCountryForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('countries.edit', id),
            type: 'GET',
            success: function (result) {
                $('#countryFieldId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editShortCode').val(result.data.short_code);
                $('#editPhoneCode').val(result.data.phone_code);
                $('#editModal').modal('show');
            },
        });

    }

    $(document).on('submit', '#editCountryForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#editSaveBtn');
        loadingButton.button('loading');
        let id = $('#countryFieldId').val();
        $.ajax({
            url: route('countries.update', id),
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
        let countryId = $(event.currentTarget).data('id');
        let deleteCountryUrl = route('countries.destroy', countryId);
        deleteItem(deleteCountryUrl, '#countriesTable', 'Country');
    });
});
