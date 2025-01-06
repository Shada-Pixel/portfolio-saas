'use strict';
$(document).ready(function () {
    $(document).on('change', '.currentStudyHere', function () {
        if ($(this).is(':checked')) {
            $('.endDateDiv').addClass('d-none');
        } else {
            $('.endDateDiv').removeClass('d-none');
        }
    });
    
    $(document).on('submit','#createEducationForm',function (e) {
        e.preventDefault();
        processingBtn('#createEducationForm', '#btnSave', 'loading');
        $('#createEducationForm')[0].submit();
    });

    $(document).on('submit','#editEducationForm',function (e) {
        e.preventDefault();
        processingBtn('#editEducationForm', '#btnSave', 'loading');
        $('#editEducationForm')[0].submit();
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
