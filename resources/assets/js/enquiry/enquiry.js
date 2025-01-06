'use strict';

$(document).ready(function () {

    $('#filter_status').select2({
        width: '100%',
    });
    let url = !isEmpty(userRole) ? route('admin.enquiries.index') : route(
        'enquiries.index');
    let tableName = '#enquiriesTable';
    let tbl = $('#enquiriesTable').DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[2, 'desc']],
        ajax: {
            url: url,
            data: function (data) {
                data.status = $('#filter_status').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '4%',
            },
            {
                'targets': [4],
                'orderable': false,
                    'className': 'text-center action-table-btn',
                    'width': '4%',
                },
                {
                    'targets': [1],
                    'width': '13%',
                },
                {
                    'targets': [2],
                    'width': '13%',
                },
            ],
            columns: [
                {
                    data: function (row) {
                        let url = !isEmpty(userRole) ? route(
                            'admin.enquiries.show', row.id) : route(
                            'enquiries.show', row.id);

                        return '<a href="' + url +
                            '" class="text-blue">' +
                            row.full_name + '</a>';
                    },
                    name: 'first_name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: function (row) {
                        return row;
                    },
                    render: function (row) {
                        if (row.created_at === null) {
                            return 'N/A';
                        }

                        return moment(row.created_at).format('Do MMM, Y h:mm A');
                    },
                    name: 'created_at',
                },
                {
                    data: function (row) {
                        if (!row.status)
                            return '<h3 class="mb-0"><span class="badge badge-danger badge-lg">Unread</span></h3>';
                        else
                            return '<h3 class="mb-0"><span class="badge badge-primary badge-lg">Read</span></h3>';
                    },
                    name: 'last_name',
                },
                {
                    data: function (row) {
                        let showLink = route('enquiries.show', row.id);
                        let data = [
                            {
                                'id': row.id,
                                'url': showLink,
                            }];
                        return prepareTemplateRender('#enquiryActionTemplate',
                            data);
                    }, name: 'id',
                },
            ],
            'fnInitComplete': function () {
                $(document).on('change', '#filter_status', function () {
                    $(tableName).DataTable().ajax.reload(null, true);
                });
            },
        });

    $(document).on('click', '.delete-btn', function (event) {
        let enquiryId = $(event.currentTarget).data('id');
        let url = !isEmpty(userRole) ? route('admin.enquiries.destroy',
            enquiryId) : route('enquiries.destroy', enquiryId);
        deleteItem(url, '#enquiriesTable', 'Enquiry');
    });
});
