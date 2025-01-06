<script id="socialSettingTemplate" type="text/x-jsrender">
<tr>
  <td class="text-center item-number">1</td>
  <td>
    <button class="btn btn-primary iconpicker dropdown-toggle socialSettingIcon" data-iconset="fontawesome5"
            data-icon="fas fa-ad" role="iconpicker" data-original-title="" title="" data-id="{{:uniqueId}}"
            aria-describedby="popover984402" id="iconPicker{{:uniqueId}}">
    </button>
    <input class="form-control plan-icon social-icon{{:uniqueId}}" value="fas fa-ad" name="key[]" type="text" data-id="{{:uniqueId}}" hidden>
  </td>
  <td>
    <input class="form-control plan-name" name="value[]" type="text" required>
  </td>
  <td class="text-center">
    <i class="fa fa-trash text-danger delete-social-icon pointer"></i>
  </td>
</tr>

</script>
