'use strict';

$(document).ready(function () {
    let tablename = $('#hireMeTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[6, 'asc']],
        ajax: {
            url: route('hire-me.index'),
        },
        columnDefs: [
            {
                targets: '_all',
                defaultContent: 'N/A',
            },
            {
                'targets': [0],
                'width': '30%',
            },
            {
                'targets': [1],
                'width': '20%',
            },
            {
                'targets': [2],
                'width': '20%',
            },
            {
                'targets': [3],
                'width': '20%',
            },
            {
                'targets': [4],
                'width': '10%',
            },
            {
                'targets': [5],
                'width': '5%',
                'orderable':false,
                'className': 'text-center',
            },
            {
                'targets': [6],
                'visible': false,
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a href="' + route('hire-me.show', row.id) +
                        '" class="text-blue">' +
                        row.name + '</a>';
                },
                name: 'name',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: function (row) {
                    if (!isEmpty(row.mobile)) {
                        return row.mobile;
                    }

                    return 'N/A';
                },
                name: 'mobile',
            },
            {
                data: 'interested_in',
                name: 'interested_in',
            },
            {
                data: function (row) {
                    return !isEmpty(row.budget) ? '<p class="cur-margin">' +
                        addCommas(row.budget) + '</p>' : 'N/A';
                },
                name: 'budget',
            },
            {
                data: function (row) {
                    return '  <a title="Delete" class="btn btn-danger btn-icon-only-action rounded-circle delete-btn" data-id=" ' +
                        row.id + ' " href="#">\n' +
                        '  <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>\n' +
                        '  </a>';
                },
                name: 'id',
            },
            {
                data: function (row) {
                    return row.created_at;
                },
                name: 'created_at',
            },
        ],
    });

    $(document).on('click', '.delete-btn', function (event) {
        let hireMeId = $(event.currentTarget).data('id');
        let deleteHireRequestUrl = route('hire-me.destroy', hireMeId);
        deleteItem(deleteHireRequestUrl, '#hireMeTable', 'Hire Request');
    });

});
