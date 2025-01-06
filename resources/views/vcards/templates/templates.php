<script id="vCardsTemplate" type="text/x-jsrender">
   <a title="Edit" class="btn btn-default btn-icon-only-action rounded-circle edit-btn" href="{{:url}}">
            <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
   </a>
   <a title="Delete" class="btn btn-danger btn-icon-only-action rounded-circle delete-btn" data-id="{{:id}}" href="#">
            <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
   </a>


</script>

<script id="vCardsAttributeTemplate" type="text/x-jsrender">
            <tr>
                <td class="text-center item-number">1</td>
                <td class="text-center">
                    <button class="btn btn-primary button-icon-size mt-1 iconpicker dropdown-toggle vCardIconAttribute createPlanAttribute" data-iconset="fontawesome5" data-id="{{:uniqueId}}"
                            data-icon="fas fa-ad" role="iconpicker" data-original-title="" title=""
                            aria-describedby="popover984402" id="iconPicker{{:uniqueId}}" >
                    </button>
                    <input class="form-control plan-icon vcard-attribute{{:uniqueId}}" name="icon[]" type="text" hidden
                           value="fas fa-ad" data-id="{{:uniqueId}}">
                </td>
                <td class="text-center">
                    <div class="color-wrapper"></div>
                    <input class="form-control color icon_color" id="iconColor{{:uniqueId}}" data-id="{{:uniqueId}}"  name="icon_color[]" value="#f5365c" type="hidden" >
                </td>
                <td>
                    <input class="form-control"  maxlength="25" name="label_text[]" type="text" pattern="^\S[a-zA-Z ]+$" title="Attribute Label Not Allowed White Space" placeholder="<?php echo __('messages.vCards.vCards_placeholder.enter_label_name'); ?>">
                </td>
                <td>
                    <input class="form-control"  maxlength="100" name="value_text[]" type="text" placeholder="<?php echo __('messages.vCards.vCards_placeholder.enter_value'); ?>">
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)"
                       class="btn btn-danger btn-icon-only-action rounded-circle delete-vCards-attribute">
                        <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                    </a>
                </td>
            </tr>



</script>

<script id="vCardsTemplateImage" type="text/x-jsrender">
       {{if template_id == 1 }}
            <img src="<?php echo asset('assets/web/css/images/vCard-template-one.png'); ?>" width="65" class="img-thumbnail" ></img>
       {{/if}}   
       {{if template_id == 2 }}
            <img src="<?php echo asset('assets/web/css/images/vCard-template-Two.png'); ?>" width="65" class="img-thumbnail" ></img>
       {{/if}}   
       {{if template_id == 3 }}
            <img src="<?php echo asset('assets/web/css/images/vCard-template-Three.png'); ?>" width="65" class="img-thumbnail" ></img>
       {{/if}}   
       {{if template_id == 4 }}
            <img src="<?php echo asset('assets/web/css/images/vCard-template-Four.png'); ?>" width="65" class="img-thumbnail" ></img>
       {{/if}}     
       {{if template_id == 5 }}
            <img src="<?php echo asset('assets/web/css/images/vCard-template-Five.png'); ?>" width="65" class="img-thumbnail" ></img>
       {{/if}}     



</script>

<script id="vCardsTemplatePreview" type="text/x-jsrender">
    <button class="btn btn-sm btn-primary text-white copy-button" value="{{:url}}" alt="Copy URL" data-toggle="tooltip" data-placement="bottom" title="Copy URL">
       <?php echo __('messages.vCards.copy_url'); ?>
    </button>
</script>
