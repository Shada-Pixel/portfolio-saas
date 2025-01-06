'use strict';

$(document).ready(function () {
    let tableName = $('#QRCodeTable');
    tableName.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: route('qrcodes.index'),
        },
        'order': [[0, 'asc']],
        columnDefs: [
            {
                'targets': [0],
                'orderable': true,
            },
            {
                'targets': [1],
                'orderable': false,
            },
            {
                'targets': [2],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
            {
                'targets': [3],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a  href="#" class="show-btn text-blue"  data-id="' +
                        row.id + '">' + row.name + ' </a>';
                },
                name: 'name',
            },
            {
                data: 'url',
                name: 'url',
            },
            {
                data: function (row) {
                    return `<a class="btn btn-sm btn-primary text-white qr-code-button-download" data-id="${row.id}"  data-placement="bottom" title="Download QR Code" href="javascript:void(0)">Download </a>`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let url = route('qrcodes.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#qrcodeTemplate',
                        data);
                }, name: 'id',
            },
        ],
    });

    $(document).on('click', '.delete-btn', function (event) {
        let qrCodeId = $(event.currentTarget).data('id');
        let deleteQrCode = route('qrcodes.destroy', qrCodeId);
        deleteItem(deleteQrCode, '#QRCodeTable', 'QR Code');
    });

    $(document).on('click', '.show-btn', function (event) {
        let qrCodeId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('qrcodes.show', qrCodeId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('.showQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    $('#showModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.qr-code-button-download', function (event) {
        let qrCodeId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('qrcodes.download', qrCodeId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let element = document.createElement('a');
                    element.setAttribute('href', 'data:image/svg+xml;base64,' +
                        btoa(decodeURIComponent(escape(result.data))));
                    element.setAttribute('download', 'qr-code.svg');
                    element.style.display = 'none';
                    document.body.appendChild(element);
                    element.click();
                    document.body.removeChild(element);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

});
