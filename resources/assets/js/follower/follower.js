'use strict';

$(document).ready(function () {
    $('#followerTable').DataTable({
        scroller: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: route('followers.index'),
        },

        'order': [[1, 'asc']],
        columnDefs: [
            {
                'targets': [0],
                'className': 'text-center',
                'orderable': false,
                'searchable': false,
                'width': '5%',
            },
            {
                'targets': [1],
                'className': 'text-center',
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center action-table-btn',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<img src="' + row.users.profile_image +
                        '" class="rounded-circle thumbnail-rounded"' +
                        '</img>';
                },
                name: 'id',
            },
            {
                data: function (row) {
                    return row.users.full_name;
                },
                name: 'users.first_name',
            },
            {
                data: function (row) {
                    return row.users.email;
                },
                name: 'users.email',
            },
            {
                data: function (row) {
                    let url = route('portfolio.front',
                        row.users.user_name);
                    let data = [
                        {
                            'url': url,
                        }];

                    return prepareTemplateRender('#followerTemplate', data);
                },
                name: 'id',
            },
        ],
    });

});
