'use strict';

let tableName = '#followingTable';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    scroller: true,
    ajax: {
        url: route('following.index'),
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
            'targets': [2],
            'className': 'text-center',
        },
        {
            'targets': [3],
            'orderable': false,
            'searchable': false,
            'className': 'text-center action-table-btn',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return '<img src="' + row.user.profile_image +
                    '" class="rounded-circle thumbnail-rounded"' +
                    '</img>';
            },
            name: 'id',
        },
        {
            data: function (row) {
                return row.user.full_name;
            },
            name: 'user.first_name',
        },
        {
            data: function (row) {
                return row.user.email;
            },
            name: 'user.email',
        },
        {
            data: function (row) {
                let url = route('portfolio.front',
                    row.user.user_name);
                let id = row.user.id;
                let data = [
                    {
                        'url': url,
                        'id': id,
                    }];
                return prepareTemplateRender('#followingTemplate', data);
            },
            name: 'id',
        },
    ],
});

$(document).ready(function () {

    $(document).on('click', '.unfollow-user', function (e) {
        e.preventDefault();
        let userId = $(this).data('id');
        $.ajax({
            url: unfollowUser,
            type: 'GET',
            data: { 'id': userId },
            success: function (result) {
                if (result.success) {
                    if ($(tableName).DataTable().data().count() == 1) {
                        $(tableName).DataTable().page('previous').draw('page');
                    } else {
                        $(tableName).DataTable().ajax.reload(null, false);
                    }
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });
});
