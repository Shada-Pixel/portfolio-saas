'use strict';

$(document).ready(function () {

    $(document).on('change', '.currentWorkHere', function () {
        if ($(this).is(':checked')) {
            $('.endDateDiv').addClass('d-none');
            $('.end-date').val('').removeAttr('required', false);
        } else {
            $('.endDateDiv').removeClass('d-none');
            $('.end-date').val('').attr('required', true);
        }
    });

    $(document).on('submit','#createExperienceForm',function (e) {
        e.preventDefault();
        processingBtn('#createExperienceForm', '#btnSave', 'loading');
        $('#createExperienceForm')[0].submit();
    });

    if (isEmpty($('.end-date').val()) && !$('.currentWorkHere').is(':checked')) {
        $('.endDateDiv').removeClass('d-none');
        $('.end-date').val('').attr('required', true);
    }
    
    $(document).on('submit','#editExperienceForm',function (e) {
        e.preventDefault();
        processingBtn('#editExperienceForm', '#btnSave', 'loading');
        $('#editExperienceForm')[0].submit();
    });

    $("#startDate").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#endDate').datepicker('setStartDate', minDate);
    });

    if (edit == true) {
        var minDate = $("#startDate").val();
        $('#endDate').datepicker('setStartDate', minDate);
    }
});
