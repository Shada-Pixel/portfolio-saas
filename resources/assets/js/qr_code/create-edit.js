'use strict';

$(document).ready(function () {
    $('#style, #eyeStyle, #type').select2({
        'width': '100%',
    });

    window.createQRCodeColorPicker = function () {
        return Pickr.create({
            el: '.color-wrapper',
            theme: 'nano', // or 'monolith', or 'nano'
            closeWithKey: 'Enter',
            autoReposition: true,
            defaultRepresentation: 'RGBA',
            position: 'bottom-end',
            appClass: 'custom-class',
            swatches: [
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 1)',
                'rgba(156, 39, 176, 1)',
                'rgba(103, 58, 183, 1)',
                'rgba(63, 81, 181, 1)',
                'rgba(33, 150, 243, 1)',
                'rgba(3, 169, 244, 1)',
                'rgba(0, 188, 212, 1)',
                'rgba(0, 150, 136, 1)',
                'rgba(76, 175, 80, 1)',
                'rgba(139, 195, 74, 1)',
                'rgba(205, 220, 57, 1)',
                'rgba(255, 235, 59, 1)',
                'rgba(255, 193, 7, 1)',
            ],

            components: {
                // Main components
                preview: true,
                hue: true,

                // Input / output Options
                interaction: {
                    input: true,
                    clear: false,
                    save: false,
                },
            },
        });
    };

    //create new record
    if (!edit) {
        let pickr = '';
        pickr = createQRCodeColorPicker();
        setTimeout(function () {
            pickr.setColor(qrCodeColor);
        }, 100);
        pickr.on('change', function () {
            const color = pickr.getColor().toRGBA().toString();
            pickr.setColor(color);
            $('#color').val(color);
        });
    }

    if (edit) {
        let pickra = '';
        pickra = createQRCodeColorPicker();
        setTimeout(function () {
            pickra.setColor(editQrCodeColor);
        }, 100);
        pickra.on('change', function () {
            const editColor = pickra.getColor().toRGBA().toString();
            pickra.setColor(editColor);
            $('.editColor').val(editColor);
        });
    }

    $(document).on('change', '#size', function () {
        let size = $(this).val();
        let userUrl = $('#url').val();
        let color = $('#color').val();
        let whiteSpace = $('#whiteSpace').val();
        let style = $('#style').val();
        let eyeStyle = $('#eyeStyle').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: { size, userUrl, color, whiteSpace, style, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.pcr-active', function () {
        let color = $('#color').val();
        let userUrl = $('#url').val();
        let size = $('#size').val();
        let whiteSpace = $('#whiteSpace').val();
        let style = $('#style').val();
        let eyeStyle = $('#eyeStyle').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: { color, userUrl, size, whiteSpace, style, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
        return false
    });

    $(document).on('click', '.custom-class', function () {
        let color = $('#color').val();
        let userUrl = $('#url').val();
        let size = $('#size').val();
        let whiteSpace = $('#whiteSpace').val();
        let style = $('#style').val();
        let eyeStyle = $('#eyeStyle').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: { color, userUrl, size, whiteSpace, style, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('change', '#whiteSpace', function () {
        let color = $('#color').val();
        let userUrl = $('#url').val();
        let size = $('#size').val();
        let whiteSpace = $(this).val();
        let style = $('#style').val();
        let eyeStyle = $('#eyeStyle').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: { color, userUrl, size, whiteSpace, style, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('change', '#style', function () {
        let style = $(this).val();
        let color = $('#color').val();
        let userUrl = $('#url').val();
        let size = $('#size').val();
        let whiteSpace = $('#whiteSpace').val();
        let eyeStyle = $('#eyeStyle').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: { style, color, userUrl, size, whiteSpace, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('change', '#eyeStyle', function () {
        let color = $('#color').val();
        let userUrl = $('#url').val();
        let size = $('#size').val();
        let whiteSpace = $('#whiteSpace').val();
        let style = $('#style').val();
        let eyeStyle = $(this).val();
        $.ajax({
            url: url,
            type: 'GET',
            data: { style, color, userUrl, size, whiteSpace, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.clear-image', function () {
        let color = 'rgba(0, 0, 0, 1)';
        let userUrl = $('#url').val();
        let size = 250;
        let whiteSpace = 1;
        let style = 'square';
        let eyeStyle = 'square';
        $.ajax({
            url: url,
            type: 'GET',
            data: { style, color, userUrl, size, whiteSpace, eyeStyle },
            success: function (result) {
                if (result.success) {
                    $('#userQrCode').
                        html(decodeURIComponent(escape(result.data)));
                    $('#size').val(size);
                    $('#whiteSpace').val(whiteSpace);
                    $('#style').val(style).trigger('change.select2');
                    $('#eyeStyle').val(style).trigger('change.select2');
                    $('.pcr-button').attr('style', color);
                    $('#color').val(color);
                    $('.download-image').
                        attr('href', 'data:image/svg+xml;base64,' +
                            btoa(decodeURIComponent(escape(result.data))));
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('submit', '#createQRCode', function (e) {
        e.preventDefault();

        processingBtn('#createQRCode', '#btnSave', 'loading');
        $('#createQRCode')[0].submit();
        return true;
    });

    $(document).on('submit', '#editQRCodeForm', function (e) {
        e.preventDefault();

        processingBtn('#editQRCodeForm', '#btnSave', 'loading');
        $('#editQRCodeForm')[0].submit();
        return true;
    });

});
    
