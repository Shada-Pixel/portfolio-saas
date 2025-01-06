'use strict';

$(document).ready(function () {
    let tablename = $('#PlanCurrencyTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('plan-currencies.index'),
        },
        columnDefs: [
            {
                'targets': [3],
                'width': '5%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: 'currency_name',
                name: 'currency_name',
            },
            {
                data: 'currency_code',
                name: 'currency_code',
            },
            {
                data: 'currency_icon',
                name: 'currency_icon',
            },
            {
                data: function (row) {
                    let url = route('plan-currencies.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#PlanCurrencyTemplate', data);
                }, name: 'id',
            },
        ],
    });

    $(document).on('submit', '#planCurrencyForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#planCurrencySaveBtn');
        loadingButton.button('loading');

        let formData = $(this).serialize();
        $.ajax({
            url: route('plan-currencies.store'),
            type: 'POST',
            data: formData,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#planCurrenciesModal').modal('hide');
                    $('#PlanCurrencyTable').DataTable().ajax.reload(null, false);
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

    $('#planCurrenciesModal').on('hidden.bs.modal', function () {
        resetModalForm('#planCurrencyForm', '#validationErrorsBox');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('plan-currencies.edit', id),
            type: 'GET',
            success: function (result) {
                $('#planCurrencyId').val(result.data.id);
                $('#editName').val(result.data.currency_name);
                $('#editCode').val(result.data.currency_code);
                $('#editIcon').val(result.data.currency_icon);
                $('#editModal').modal('show');
            },
        });
    }

    $(document).on('submit', '#planCurrencyUpdateForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#planCurrencySaveBtn');
        loadingButton.button('loading');
        let formData = $(this).serialize();
        let id = $('#planCurrencyId').val();
        $.ajax({
            url: route('plan-currencies.update', id),
            type: 'PUT',
            data: formData,
            success: function (result) {
                $('#editModal').modal('hide');
                displaySuccessMessage(result.message);
                $('#PlanCurrencyTable').DataTable().ajax.reload(null, false);
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
        let planCurrencyId = $(event.currentTarget).data('id');
        let deletePlanCurrencyUrl = route('plan-currencies.destroy', planCurrencyId);
        deleteItem(deletePlanCurrencyUrl, '#PlanCurrencyTable', 'Plan Currency');
    });

});
