'use strict';

$('#type, #planType').select2({
    width: '250px',
});

let tableName = '#pricingPlansTable';
$(tableName).DataTable({
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[1, 'asc']],
    ajax: {
        url: route('pricing-plans.index'),
        data: function (data) {
            data.type = $('#type').find('option:selected').val();
            data.planType = $('#planType').find('option:selected').val();
        },
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '5%',
            'orderable': false,
            'className': 'text-center',
        },
        {
          'targets': [1],
          'className': 'text-wrap',  
        },
        {
            'targets': [2],
            'width': '7%',
        },
        {
            'targets': [3, 4],
            'width': '7%',
            'orderable': false,
        },
        {
            'targets': [5],
            'width': '3%',
            'className': 'text-center',
            'orderable': false,
        },
        {
            'targets': [6],
            'orderable': false,
            'className': 'text-center action-table-btn',
            'width': '5%',
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
                return '<a href="' + route('pricing-plans.show', row.id) +
                    '" class="text-blue">' +
                    row.name + '</a>';

            },
            name: 'name',
        },
        {
            data: 'price',
            name: 'price',
        },
        {
            data: 'plan_price_type',
            name: 'price',
        },
        {
            data: 'pricing_plan_type',
            name: 'id',
        },
        {
            data:function (row) {
                let inStyle = 'style';
                if (row.color == '#FFFFFF'){
                    return `<span class="badge data-table-common-color d-block" ${inStyle}="background:#f5365c"></span>`;
                }
                else{
                    return `<span class="badge data-table-common-color d-block" ${inStyle}="background:${row.color}"></span>`;
                }
            },
            name:'id',
        },
        {
            data: function (row) {
                let url = route('pricing-plans.edit', row.id);
                let data = [
                    {
                        'id': row.id,
                        'url': url,
                    }];

                return prepareTemplateRender('#pricingPlanTemplate', data);
            }, name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#type', function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
        $(document).on('change', '#planType', function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('pricing-plans.destroy', recordId), tableName,
        'Pricing Plan');
});
