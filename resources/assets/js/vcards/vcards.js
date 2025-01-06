'use strict';

$(document).ready(function () {
    let tableName = '#vCardsTable';
    $(tableName).DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[1, 'asc']],
        ajax: {
            url: route('vcards.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '5%',
                'className': 'text-center',
            },
            {
                'targets': [1],
                'className': 'text-wrap',
            },
            {
                'targets': [2],
                'width': '7%',
                'orderable': false,
                'className': 'text-center',
            },
            {
                'targets': [3, 4],
                'width': '7%',
                'orderable': false,
                'className': 'text-center',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a href="' + route('vcards.show', row.id) +
                        '" class="text-blue">' +
                        row.v_card_name + '</a>';

                },
                name: 'v_card_name',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'template_id': row.template_id,
                            'id': row.id,
                        }];
                    return prepareTemplateRender('#vCardsTemplateImage', data);
                },
                name: 'template_id',
            },
            {
                data: function (row) {
                    let url = route('vcard', row.v_card_unique_id);
                    let data = [
                        {
                            'url': url,
                        }];
                    return prepareTemplateRender('#vCardsTemplatePreview',
                        data);
                },
                name: 'v_card_unique_id',
            },
            {
                data: function (row) {
                    let url = route('vcards.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#vCardsTemplate', data);
                }, name: 'id',
            },
        ],
    });

    $(document).on('click', '.delete-btn', function (event) {
        let recordId = $(event.currentTarget).data('id');
        deleteItem(route('vcards.destroy', recordId), tableName,
            'vCard');
    });

    $(document).on('click', '.copy-button', function (e) {
        let copy = $(this).val();
        let temp = $('<input>');
        $('body').append(temp);
        temp.val(copy).select();
        document.execCommand('copy');
        temp.remove();
        displaySuccessMessage('URL Copied');
    });

});

