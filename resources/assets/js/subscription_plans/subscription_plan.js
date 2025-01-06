'use strict';

$(document).ready(function () {
    $('#currency,#editCurrency').select2();
    $('#planType,#editPlanType,#planTypeFilter').select2();
    $('#planType').val(1).trigger('change');
    let options = [];
    let currenciesNames = currencies;
    let currencyNamesSymbols = currencySymbols;
    $.each(currenciesNames, function (index, currency) {
        options.push({
            id: index,
            text: currencyNamesSymbols['' + index + ''] + ' - ' + currency,
        });
    });
    $('#currency, #editCurrency').select2({
        width: '100%',
        data: options,
        escapeMarkup: function (markup) {
            return markup;
        },
    });

    let tableName = $('#subscriptionPlanTable');
    tableName.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[3, 'desc']],
        ajax: {
            url: subscriptionPlanUrl,
            data: function(data){
                data.plan_type = $('#planTypeFilter').find('option:selected').val();
            }
        },
        columnDefs: [
            {
                'targets': [2],
                'className': 'text-center',
            },
            {
                'targets': [5],
                'width': '6%',
                'orderable': false,
                'className': 'text-center',
            },
            {
                'targets': [6],
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
                    return row.currency.currency_icon + ' - ' +
                        row.currency.currency_name;
                },
                name: 'currency_id',
            },
            {
                data: function(row) {
                    return !isEmpty(row.price) ? '<p class="mb-0">' +
                        addCommas(row.price) + '</p>' : 'N/A';
                },
                name: 'price',
            },
            {
                data: function (row) {
                    if (row.plan_type == 1)
                        return 'Month';
                    else
                        return 'Year';
                },
                name: 'plan_type',
            },
            {
                data: function (row) {
                    if (row.plan_type == 1)
                        return row.valid_until + ' ' + 'Month';
                    else
                        return row.valid_until + ' ' + 'Year';
                },
                name: 'plan_type',
            },
            {
                data: function (row) {
                    return row.subscription.length;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let url = subscriptionPlanUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                            'is_trail_plan': row.is_trail_plan,
                        }];
                    return prepareTemplateRender('#subscriptionPlanTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#planTypeFilter', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });

    $(document).on('submit', '#createSubscriptionForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let formData = $(this).serializeArray();
        let currencyData = removeCommas($('.price').val());
        formData.find(item => item.name === 'price').value = currencyData   ;
        $.ajax({
            url: subscriptionPlanUrl,
            type: 'POST',
            data: formData,
            success: function (result) {
                if (result.success) {
                    $('#currency').select2().val(null).trigger('change');
                    $('#planType').select2().val(1).trigger('change');
                    displaySuccessMessage(result.message);
                    $('#subscriptionPlanModal').modal('hide');
                    tableName.
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

    $('#subscriptionPlanModal').on('hidden.bs.modal', function () {
        $('#planType').val(1).trigger('change');
        resetModalForm('#createSubscriptionForm', '#validationErrorsBox');
    });

    $(document).on('click', '.delete-btn', function (event) {
        let subscriptionId = $(event.currentTarget).data('id');
        let deleteSubscriptionUrl = subscriptionPlanUrl + '/' +
            subscriptionId;
        deleteItem(deleteSubscriptionUrl, '#subscriptionPlanTable',
            'Subscription Plan');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('subscription.plans.edit', id),
            type: 'GET',
            success: function (result) {
                $('#subscriptionId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editCurrency').
                    select2().
                    val(result.data.currency_id).
                    trigger('change');
                let priceValue = addCommas(result.data.price);
                $('.edit-price').val(priceValue);
                $('#editPlanType').
                    select2().
                    val(result.data.plan_type).
                    trigger('change');
                $('#editValidUntil').val(result.data.valid_until);
                $('#editSubscriptionPlanModal').modal('show');
                $('.price-input').trigger('input');
            },
        });
    }

    $(document).on('submit', '#editSubscriptionForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#editSaveBtn');
        loadingButton.button('loading');
        let id = $('#subscriptionId').val();
        let formData = $(this).serializeArray();
        let currencyData = removeCommas($('.edit-price').val())
        formData.find(item => item.name === 'price').value = currencyData;
        $.ajax({
            url: route('subscription.plans.update', id),
            type: 'PUT',
            data: formData,
            success: function (result) {
                $('#editSubscriptionPlanModal').modal('hide');
                displaySuccessMessage(result.message);
                tableName.DataTable().ajax.reload(null, false);
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#editSubscriptionPlanModal').on('hidden.bs.modal', function () {
        resetModalForm('#editSubscriptionForm', '#validationErrorsBox');
    });

});
