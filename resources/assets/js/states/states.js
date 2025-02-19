'use strict';

$(document).ready(function () {
    $('#countryFieldID,#editCountryFieldID').select2({
        'width': '100%',
        'placeholder': message,
    });
    $('#filterCountry').select2({
        width: '170px',
    });

    $('#stateModal, #editModal').on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
    });

    let tablename = $('#statesTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('states.index'),
            data: function (data) {
                data.country_id = $('#filterCountry').
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
                data: 'name',
                name: 'name',
            },
            {
                data: 'country.name',
                name: 'country_id',
            },
            {
                data: function (row) {
                    let url = route('states.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#statesTemplate', data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filterCountry', function () {
                $('#statesTable').DataTable().ajax.reload(null, true);
            });
        },
    });

    $(document).on('submit', '#createStateForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('states.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#stateModal').modal('hide');
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

    $('#stateModal').on('hidden.bs.modal', function () {
        $('#countryFieldID').val([]).trigger('change');
        resetModalForm('#createStateForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('states.edit', id),
            type: 'GET',
            success: function (result) {
                $('#stateFieldId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editCountryFieldID').
                    val(result.data.country_id).
                    trigger('change.select2');
                $('#editModal').modal('show');
            },
        });

    }

    $(document).on('submit', '#editStateForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#editSaveBtn');
        loadingButton.button('loading');
        let id = $('#stateFieldId').val();
        $.ajax({
            url: route('states.update', id),
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
        let stateId = $(event.currentTarget).data('id');
        let deleteStateUrl = route('states.destroy', stateId);
        deleteItem(deleteStateUrl, '#statesTable', 'State');
    });
});
