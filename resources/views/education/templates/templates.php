<script id="educationTemplate" type="text/x-jsrender">
    <a title="Edit" class="btn btn-default btn-icon-only-action rounded-circle edit-btn" href="{{:url}}">
     <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
   </a>
   
   <a title="Delete" class="btn btn-danger btn-icon-only-action rounded-circle delete-btn" data-id="{{:id}}" href="#">
  <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
  </a>



</script>

<script id="currentlyStudyHereTemplate" type="text/x-jsrender">
      <label class="custom-toggle pl-0">
            <input type="checkbox" name="currently_work_here" class="isStudyHere" data-id="{{:id}}" {{:checked}}>
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>



</script>
