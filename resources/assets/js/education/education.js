'use strict';

$(document).ready(function () {
    $('#study_here').select2({
        width: '100%',
    });
});

let tableName = '#educationsTable';
$(tableName).DataTable({
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,

    'order': [[0, 'asc']],
    ajax: {
        url: route('educations.index'),
        data: function (data) {
            data.study_here = $('#study_here').
                find('option:selected').
                val();
        },
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '30%',
        },
        {
            'targets': [1],
            'width': '15%',
            'className': 'text-center',
            render: function (data) {
                if (isEmpty(data)) {
                    return 'N/A';
                }
                return data.length > 25 ?
                    data.substr(0, 25) + '...' :
                    data;
            },
        },
        {
            'targets': [2, 3],
            'width': '5%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center current-work-here-td',
            'width': '2%',
        },
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center action-table-btn',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return '<a href="' + route('educations.show', row.id) +
                    '" class="text-blue">' +
                    row.school_name + '</a>';

            },
            name: 'school_name',
        },
        {
            data: 'qualification',
            name: 'qualification',
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
                let checked = row.currently_studying_here == 0 ? '' : 'checked';
                let data = [{ 'id': row.id, 'checked': checked }];
                return prepareTemplateRender('#currentlyStudyHereTemplate',
                    data);
            },
            name: 'currently_studying_here',
        },
        {
            data: function (row) {
                let url = route('educations.edit', row.id);
                let data = [
                    {
                        'id': row.id,
                        'url': url,
                    }];

                return prepareTemplateRender('#educationTemplate', data);
            }, name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#study_here', function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('educations.destroy', recordId), tableName, 'Education');
});

$(document).on('change', '.isStudyHere', function (event) {
    let recordId = $(event.currentTarget).data('id');
    $.ajax({
        url: route('educations.study.here', recordId),
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
