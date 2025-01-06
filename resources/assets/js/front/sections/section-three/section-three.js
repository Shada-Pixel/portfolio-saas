'use strict';

let tableName = '#sectionThreeTable';
$(tableName).DataTable({
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[1, 'asc']],
    ajax: {
        url: route('section-three.index'),
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '7%',
            'orderable': false,
            'className': 'text-center',
        },
        {
            'targets': [2],
            'className': 'text-wrap',
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
                return '<img src="' + row.image_url +
                    '" class="rounded-circle thumbnail-rounded"/>' +
                    '</img>';
            },
        },
        {
            data: function (row) {
                return '<a href="' + route('section-three.show', row.id) +
                    '" class="text-blue">' + row.image_text + '</a>';
            },
            name: 'image_text',
        },
        {
            data: 'slider_text',
            name: 'slider_text',
        },
        {
            data: 'image_text_secondary',
            name: 'image_text_secondary',
        },
        {
            data: function (row) {
                let url = route('section-three.edit', row.id);
                let data = [
                    {
                        'id': row.id,
                        'url': url,
                    }];

                return prepareTemplateRender('#sectionThreeTemplate', data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('section-three.destroy', recordId), tableName,
        'Section Three');
});
