'use strict';

$(document).ready(function () {
    
    $('#type, #editPlanType, #createPlanType, #planCurrency').select2({
       'width':'100%', 
    });
    
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

    //edit record
    if (edit) {
        const editPickr = editColorPicker();
        setTimeout(function () {
            editPickr.setColor(pricingColor);
        }, 100);
        editPickr.on('change', function () {
            const color = editPickr.getColor().toHEXA().toString();
            editPickr.setColor(color);
            $('#edit_color').val(color);
        });
    }
     
    let pricingPlanAttributeData = $('.createPlanAttribute').length;
    let editPricingPlanAttributeData = $('.editPlanAttributeIcon').length;
    $(document).on('click', '#addItem', function () {
        let data = {
            'uniqueId': uniqueId,
        };
        $('.delete-plan-attribute').removeAttr('style');
        let pricingPlanAttributeHtml = prepareTemplateRender(
            '#pricingPlanAttributeTemplate', data);
        let message = 'You can not allow to add more than 6 pricing plans.';
        if (pricingPlanAttributeData <=5 && editPricingPlanAttributeData<=5)
        {
            $('.plan-attribute-container').append(pricingPlanAttributeHtml);
            pricingPlanAttributeData++;
            editPricingPlanAttributeData++;
        } else {
            displayErrorMessage(message)
        }
        //initial iconpicker
        $('#iconPicker' + uniqueId).iconpicker();

        //when change icon, get icon value and set value. 
        $('.planAttribute').on('change', function (event) {
            let recordId = $(event.currentTarget).data('id');
            $('.plan-attribute' + recordId).val(event.icon);
        });

        uniqueId++;
        resetPlanAttributeIndex();
    });
    
    if($('.plan-attribute-container tr').length < 2){
        $('.delete-plan-attribute').css('pointer-events','none');
    }
    
    $(document).on('click', '.delete-plan-attribute', function () {
        if($('.plan-attribute-container tr').length < 2){
            $('.delete-plan-attribute').css('pointer-events','none');
        }else {
            pricingPlanAttributeData --;
            editPricingPlanAttributeData--;
            $(this).parents('tr').remove();
            resetPlanAttributeIndex();            
        }
    });

    function resetPlanAttributeIndex () {
        let index = 1;
        $('.plan-attribute-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
    }

    //default icon picker
    $('#defaultIconPicker').on('change', function (event) {
        $('.plan-attribute-icon').val(event.icon);
    });

    //edit record when change edit iconpicker
    $('.editPlanAttributeIcon').on('change', function (event) {
        let recordId = $(event.currentTarget).data('id');
        $('.edit-plan-attribute-icon' + recordId).val('').val(event.icon);
    });

    var filename;
    $(document).on('change', '#icon', function () {
        filename = $(this).val();
        if (isValidImg($(this), '#validationErrorsBox')) {
            pricingPlanDisplayPhoto(this, '#iconPreview');
        }
        $('#validationErrorsBox').delay(3000).slideUp(300);
    });

    window.pricingPlanDisplayPhoto = function (input, selector, validationMessageSelector) {
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
    
    $(document).on('keyup','#price',function () {
        if (/\D/g.test($(this).val())) {
            $(this).val($(this).val().replace(/\D/g, ''));
        }
    });
    
    new AutoNumeric('.currency', {decimalPlaces:'0',   vMax: '999999',});
    
    //submit form check file select or not.
    $(document).on('submit', '#createPricingPlanForm', function (e) {
        e.preventDefault();
        if (filename == null || filename == '') {
            displayErrorMessage('Please select image');
            return false;
        }
        
        pickr.on('change', function () {
            const color = pickr.getColor().toHEXA().toString();
            pickr.setColor(color);
            $('#color').val(color);
            picked = true;
        });
        
        processingBtn('#createPricingPlanForm', '#btnSave', 'loading');
        $('#createPricingPlanForm')[0].submit();
        return true;
    });

    $(document).on('submit','#editPricingPlanForm',function (e) {
        e.preventDefault();
        processingBtn('#editPricingPlanForm', '#btnSave', 'loading');
        $('#editPricingPlanForm')[0].submit();
    });

});
