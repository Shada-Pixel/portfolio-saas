<script id="pricingPlanTemplate" type="text/x-jsrender">
   <a title="Edit" class="btn btn-default btn-icon-only-action rounded-circle edit-btn" href="{{:url}}">
            <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
   </a>
   <a title="Delete" class="btn btn-danger btn-icon-only-action rounded-circle delete-btn" data-id="{{:id}}" href="#">
            <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
   </a>




</script>


<script id="pricingPlanAttributeTemplate" type="text/x-jsrender">
<tr>
  <td class="text-center item-number">1</td>
  <td>
    <button class="btn btn-primary iconpicker button-icon-size dropdown-toggle planAttribute createPlanAttribute" data-iconset="fontawesome5"
            data-icon="fas fa-ad" role="iconpicker" data-original-title="" title="" data-id="{{:uniqueId}}"
            aria-describedby="popover984402" id="iconPicker{{:uniqueId}}">
    </button>
    <input class="form-control plan-icon plan-attribute{{:uniqueId}}" value="fas fa-ad" name="attribute_icon[]"
           type="text" data-id="{{:uniqueId}}" hidden>
  </td>
  <td>
    <input class="form-control plan-name" name="attribute_name[]" type="text" pattern="^\S[a-zA-Z ]+$" title="Attribute Name Not Allowed White Space" required placeholder="<?php echo  __('messages.pricing_plan_placeholder.enter_attribute_name') ?>">
  </td>
  <td class="text-center">
    <a href="javascript:void(0)" class="btn btn-danger btn-icon-only-action rounded-circle delete-plan-attribute">
      <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
    </a>
  </td>
</tr>





</script>
