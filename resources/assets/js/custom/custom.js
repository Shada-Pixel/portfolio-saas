'use strict';

let jsrender = require('jsrender');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});

if (typeof landing == 'undefined')
    $('input:text:not([readonly="readonly"])').first().focus();

$('input[type="email"]').on('keyup', function (){
    if ($(this).val() != null) {
        $(this).val($(this).val().toLowerCase());
    }
});

$(function () {
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('input:text').first().focus();
    });
});

setTimeout(function () { $('.alert').fadeOut('slow'); }, 3000);

window.resetModalForm = function (formId, validationBox) {
    $(formId)[0].reset();
    $('select.select2Selector').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id');
        $(drpSelector).val('');
        $(drpSelector).trigger('change');
    });
    $(validationBox).hide();
};

window.displaySuccessMessage = function (message) {
    iziToast.success({
        title: 'Success',
        message: message,
        position: 'topRight',
    });
};

window.manageAjaxErrors = function (data) {
    let errorDivId = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'editValidationErrorsBox';
    if (data.status == 404) {
        iziToast.error({
            title: 'Error!',
            message: data.responseJSON.message,
            position: 'topRight',
        });
    } else {
        printErrorMessage('#' + errorDivId, data);
    }
};

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};

window.displayErrorMessage = function (message) {
    iziToast.error({
        title: 'Error',
        message: message,
        position: 'topRight',
    });
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId);
    if (state === 'loading') {
        loadingButton.button('loading');
    } else {
        loadingButton.button('reset');
    }
};

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

window.deleteItem = function (url, tableId, header, callFunction = null) {
    swal.fire({
        title: 'Delete !',
        text: 'Are you sure want to delete this "' + header + '" ?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#f5365c',
        cancelButtonColor: '#888888',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItemAjax(url, tableId, header, callFunction);
        }
    });
};

function deleteItemAjax (url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                if ($(tableId).DataTable().data().count() == 1) {
                    $(tableId).DataTable().page('previous').draw('page');
                } else {
                    $(tableId).DataTable().ajax.reload(null, false);
                }
            }
            swal.fire({
                title: 'Deleted!',
                text: header + ' has been deleted.',
                icon: 'success',
                confirmButtonColor: '#f5365c',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal.fire({
                title: '',
                text: data.responseJSON.message,
                icon: 'error',
                confirmButtonColor: '#f5365c',
                timer: 5000,
            });
        },
    });
}

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['svg']) == -1) {
        $(inputSelector).val('');
        let filename = null;
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: svg.').
            show();
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

window.isValidImage = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: gif, png ,jpg ,jpeg.').
            show();
        setTimeout(function () {
            $('#validationErrorsBox').delay(5000).slideUp(300);
        });
        return false;
    }
    return true;
};

window.isValidImg = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'svg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: png ,jpg ,jpeg ,svg.').
            show();
        setTimeout(function () {
            $('#validationErrorsBox').delay(5000).slideUp(300);
        });
        return false;
    }
    return true;
};


window.displayImage = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

window.removeCommas = function (str) {
    return str.replace(/,/g, '');
};

window.checkSummerNoteEmpty = function (
    selectorElement, errorMessage, isRequired = 0) {
    if ($(selectorElement).summernote('isEmpty') && isRequired === 1) {
        displayErrorMessage(errorMessage);
        $(document).find('.note-editable').html('<p><br></p>');
        return false;
    } else if (!$(selectorElement).summernote('isEmpty')) {
        $(document).find('.note-editable').contents().each(function () {
            if (this.nodeType === 3) { // text node
                this.textContent = this.textContent.replace(/\u00A0/g, '');
            }
        });
        if ($(document).find('.note-editable').text().trim().length == 0) {
            $(document).find('.note-editable').html('<p><br></p>');
            $(selectorElement).val(null);
            if (isRequired === 1) {
                displayErrorMessage(errorMessage);

                return false;
            }
        }
    }

    return true;
};

$(document).ready(function () {
    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document).
        find('.nav-item .collapse ul li').
        hasClass('active');
    if (hasActiveMenu) {
        $(document).
            find('.nav-item .collapse ul li.active').
            parent('ul').
            parent('ul').
            addClass('show');
        $(document).find('.nav-item a').attr('aria-expanded', 'true');
    }
});

window.addCommas = function (nStr) {
    nStr += '';
    let x = nStr.split('.');
    let x1 = x[0];
    let x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
};

// select2 focus
$(document).on('select2:open', ()=> {
    document.querySelector('.select2-search__field').focus();
});

//character count function
 window.charactorsCount = function (selector, maxLength, characterCount) {
     $(selector).keyup(function() {
         let textlen = maxLength - $(selector).val().length;
         $(characterCount).text(textlen);
     });
 }
