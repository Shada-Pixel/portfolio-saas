'use strict';

$(document).ready(function () {
    //create new record
    let picked = false;
    let pickr = '';
    if (!edit) {
        pickr = createColorPicker();
        setTimeout(function () {
            pickr.setColor(pricingDefaultColor);
        }, 100);
        pickr.on('change', function () {
            const color = pickr.getColor().toHEXA().toString();
            pickr.setColor(color);
            $('#color').val(color);
        });
    }

    //edit new color
    if (edit) {
        let Ele = null;
        $(document).on('click', '.pickr', function () {
            Ele = $(this);
        });
        $(vcardsColor).each(function (index, value) {
            const editPickr = editColorPicker();
            setTimeout(function () {
                editPickr.setColor(value);
            }, 100);
            editPickr.on('change', function () {
                const editIconColor = editPickr.getColor().toHEXA().toString();
                editPickr.setColor(editIconColor);
                if (Ele != null) {
                    Ele[0].nextSibling.nextSibling.attributes[5].value = editIconColor;
                }
            });
        });
    }

    let vCardAttributeData = $('.createVCardAttribute').length;
    let editVCardAttributeData = $('.editVCardAttribute').length;
    $(document).on('click', '#addItem', function () {
        let data = {
            'uniqueId': uniqueId,
        };
        $('.delete-vCards-attribute').removeAttr('style');
        let vCardsAttributeHtml = prepareTemplateRender(
            '#vCardsAttributeTemplate', data);
        let message = 'You can not allow to add more than 6 Information.';
        if (vCardAttributeData <= 5 && editVCardAttributeData <= 5) {
            $('.vCards-attribute-container').append(vCardsAttributeHtml);
            vCardAttributeData++;
            editVCardAttributeData++;
        } else {
            displayErrorMessage(message);
            return false;
        }
        let picked = false;
        let pickr = '';

        //initial iconpicker
        $('#iconPicker' + uniqueId).iconpicker();

        //when change icon, get icon value and set value. 
        $('.vCardIconAttribute').on('change', function (event) {
            let recordId = $(event.currentTarget).data('id');
            $('.vcard-attribute' + recordId).val(event.icon);
        });

        let pickra = '';
        pickra = createColorPicker();
        setTimeout(function () {
            pickra.setColor(pricingDefaultColor);
        }, 100);
        let Ele = null;
        $(document).on('click', '.pickr', function () {
            Ele = $(this);
        });
        pickra.on('change', function () {
            const iconColor = pickra.getColor().toHEXA().toString();
            pickra.setColor(iconColor);
            if (Ele != null) {
                Ele[0].nextSibling.nextSibling.attributes[4].value = iconColor;
            }
        });
        uniqueId++;
        resetPlanAttributeIndex();

    });

    if ($('.vCards-attribute-container tr').length < 1) {
        $('.delete-vCards-attribute').css('pointer-events', 'none');
    }

    if (edit) {
        if ($('.vCards-attribute-container tr').length == 0) {
            $('#addItem').trigger('click');
        }
    }

    $(document).on('click', '.delete-vCards-attribute', function () {
        if ($('.vCards-attribute-container tr').length < 2) {
            $('.delete-vCards-attribute').css('pointer-events', 'none');
        } else {
            vCardAttributeData--;
            editVCardAttributeData--;
            $(this).parents('tr').remove();
            resetPlanAttributeIndex();
        }
    });

    function resetPlanAttributeIndex () {
        let index = 1;
        $('.vCards-attribute-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
    }

    //default icon picker
    $('#iconPicker').on('change', function (event) {
        $('.vcard-attribute-icon').val(event.icon);
    });

    //edit record when change edit iconpicker
    $('.editVCardAttribute').on('change', function (event) {
        let recordId = $(event.currentTarget).data('id');
        $('.edit-vcard-attribute-icon' + recordId).val('').val(event.icon);
    });

    var filename;
    $(document).on('change', '#profileCardImage', function () {
        filename = $(this).val();
        if (isValidImg($(this), '#validationErrorsBox')) {
            vCardDisplayPhoto(this, '#profileImagePreview');
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    var coverFileImage;
    $(document).on('change', '#coverImage', function () {
        coverFileImage = $(this).val();
        if (isValidImg($(this), '#validationErrorsBox')) {
            vCardDisplayPhoto(this, '#coverImagePreview');
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    window.vCardDisplayPhoto = function (
        input, selector, validationMessageSelector) {
        let displayPreview = true;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    // if ((image.height < 300 || image.width < 300)) {
                    //     $('#icon').val('');
                    //     $(validationMessageSelector).removeClass('d-none');
                    //     displayErrorMessage('The image must be grater than of pixel 300x300.')
                    //     return false;
                    // }
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

    //submit form check file select or not.
    $(document).on('submit', '#createVCardsForm', function (e) {
        e.preventDefault();

        processingBtn('#createVCardsForm', '#btnSave', 'loading');
        $('#createVCardsForm')[0].submit();
        return true;
    });

    $(document).on('submit', '#editVCardForm', function (e) {
        e.preventDefault();

        processingBtn('#editVCardForm', '#btnSave', 'loading');
        $('#editVCardForm')[0].submit();
    });

});
