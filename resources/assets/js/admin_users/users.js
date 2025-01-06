'use strict';

$(document).ready(function () {
    $('#status, #available_as_freelancer').select2({
        width: '100%',
    });

    let tableName = $('#usersTable');
    tableName.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[8, 'desc']],
        ajax: {
            url: route('users.index'),
            data: function (data) {
                data.status = $('#status').find('option:selected').val();
                data.available_as_freelancer = $('#available_as_freelancer').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'className': 'text-center',
                'orderable': false,
                'searchable': false,
                'width': '5%',
            },
            {
                'targets': [3],
                'className': 'text-center',
                'width': '4%',
            },
            {
                'targets': [4],
                'orderable': false,
                'searchable': false,
                'className': 'text-center',
                'width': '4%',
            },
            {
                'targets': [4, 5],
                'orderable': false,
                'searchable': false,
                'className': 'text-center',
                'width': '4%',
            },
            {
                'targets': [6, 7],
                'orderable': false,
                'className': 'text-center action-table-btn',
                'width': '5%',
            },
            {
                'targets': [8],
                'visible': false,
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<img src="' + row.profile_image +
                        '" class="rounded-circle thumbnail-rounded"' +
                        '</img>';
                },
                name: 'profile',
            },
            {
                data: function (row) {
                    return '<a href="' + route('users.show', row.id) +
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
                    if (row.status == 1 && row.roles[0].name !==
                        'super_admin') {
                        return `<a href="${route('portfolio.front',
                            row.user_name)}" class="show-btn text-blue" target="_blank">${row.user_name}</a>`;
                    } else {
                        return row.user_name;
                    }
                },
                name: 'user_name',
            },
            {
                data: function (row) {
                    if (row.roles[0].name === 'super_admin') {
                        return `<span class="badge badge-primary">Active</span>`;
                    }
                    return `<label class="custom-toggle pl-0 mx-auto">
            <input type="checkbox" name="status"  id="status" value="${row.status}" data-id="${row.id}" ${row.status ==
                    1 ? 'checked' : ''}>
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>`;
                },
                name: 'status',
            },
            {
                data: function (row) {
                    if (row.roles[0].name === 'super_admin') {
                        return `<span class="badge badge-primary">Active</span>`;
                    }
                    return `<label class="custom-toggle pl-0 mx-auto">
            <input type="checkbox" name="email_verified_at" id="emailVerified" data-id="${row.id}" ${row.email_verified_at !=
                    null ? 'checked' : ''} >
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>`;
                },
                name: 'email_verified_at',
            },
            {
                data: function (row) {
                    if (row.status == 1) {
                        let role = row.roles[0].name === 'super_admin';
                        let url = route('impersonate', row.id);
                        let data = [
                            {
                                'url': url,
                                'role': role,
                                'username': row.full_name,
                            }];

                        return prepareTemplateRender('#impersonateUserTemplate',
                            data);
                    } else {
                        return 'N/A';
                    }
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let role = row.roles[0].name === 'super_admin';
                    let url = route('admin.users.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                            'role': role,
                        }];

                    return prepareTemplateRender('#userTemplate', data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#status, #available_as_freelancer', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });

    $(document).on('click', '.delete-btn', function (event) {
        let recordId = $(event.currentTarget).data('id');
        deleteItem(route('users.destroy', recordId), tableName, 'User');
    });

    $(document).on('click', '#status', function () {
        let id = $(this).attr('data-id');
        let status = $(this).is(':checked') ? $(this).val(1) : $(this).val(0);
        $.ajax({
            url: route('change.status', id),
            data: status,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $(tableName).DataTable().ajax.reload(null, true);
                }
            },
        });
    });

    $(document).on('click', '#emailVerified', function () {
        let id = $(this).attr('data-id');
        if ($(this).is(':checked')) {
            $.ajax({
                url: route('change.email', id),
                success: function (result) {
                    if (result.success) {
                        displaySuccessMessage(result.message);
                        $(tableName).DataTable().ajax.reload(null, true);
                    }
                },
            });
        } else {
            return false;
        }
    });
});
