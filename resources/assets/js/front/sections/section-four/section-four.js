'use strict';

let tableName = '#sectionFourTable';
$(tableName).DataTable({
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[1, 'asc']],
    ajax: {
        url: route('section-four.index'),
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
            'targets': [3],
            'orderable': false,
            'width': '2%',
            'className': 'text-center',
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
                return '<a href="' + route('section-four.show', row.id) +
                    '" class="text-blue">' + row.image_text + '</a>';
            },
            name: 'image_text',
        },
        {
            data: 'image_text_description',
            name: 'image_text_description',
        },
        {
            data: function (row) {
                let inStyle = 'style';
                if (row.color == '#FFFFFF'){
                    return `<span class="badge data-table-common-color d-block" ${inStyle}="background:#f5365c"></span>`;
                }else {
                    return `<span class="badge data-table-common-color d-block" ${inStyle}="background: ${row.color}"></span>`;
                }
            },
            name: 'id',  
        },
        {
            data: function (row) {
                let url = route('section-four.edit', row.id);
                let data = [
                    {
                        'id': row.id,
                        'url': url,
                    }];

                return prepareTemplateRender('#sectionFourTemplate', data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('section-four.destroy', recordId), tableName,
        'Section Four');
});
