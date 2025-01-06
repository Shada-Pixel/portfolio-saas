'use strict';

$('#countryId,#stateId,#cityId,#work_here').select2({
    width: '100%',
});

let tableName = '#experiencesTable';
$(tableName).DataTable({
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: route('experiences.index'),
        data: function (data) {
            data.work_here = $('#work_here').
                find('option:selected').
                val();
        },
    },
    columnDefs: [
        {
            'targets': [1, 2],
            'width': '8%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center current-work-here-td',
            'width': '6%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center action-table-btn',
            'width': '5%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return '<a href="' + route('experiences.show', row.id) +
                    '" class="text-blue">' +
                    row.job_title + '</a>';

            },
            name: 'job_title',
        },
        {
            data: function data (row) {
                return moment(row.start_date).format('Do MMM, Y');
            },
            name: 'start_date',
        },
        {
            data: function data (row) {
                if (isEmpty(row.end_date)) {
                    return 'N/A';
                }
                return moment(row.end_date).format('Do MMM, Y');
            },
            name: 'end_date',
        },
        {
            data: function (row) {
                let checked = row.currently_work_here == 0 ? '' : 'checked';
                let data = [{ 'id': row.id, 'checked': checked }];
                return prepareTemplateRender('#currentlyWorkHereTemplate',
                    data);
            },
            name: 'currently_work_here',
        },
        {
            data: function (row) {
                let url = route('experiences.edit', row.id);
                let data = [
                    {
                        'id': row.id,
                        'url': url,
                    }];

                return prepareTemplateRender('#expirenceTemplate', data);
            }, name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#work_here', function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('experiences.destroy', recordId), tableName, 'Experience');
});

$(document).on('change', '.isWorkHere', function (event) {
    let recordId = $(event.currentTarget).data('id');
    $.ajax({
        url: route('experience.work.here', recordId),
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
