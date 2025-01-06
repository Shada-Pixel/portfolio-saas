<script id="userTemplate" type="text/x-jsrender">
   <a title="Edit" class="btn btn-default btn-icon-only-action rounded-circle edit-btn" href="{{:url}}">
     <span class="btn-inner--icon"><i class="fa fa-edit"></i></span>
   </a>

{{if !role}}
<a title="Delete" class="btn btn-danger btn-icon-only-action rounded-circle delete-btn" data-id="{{:id}}" href="#">
  <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
</a>
{{/if}}



</script>

<script id="impersonateUserTemplate" type="text/x-jsrender">
{{if !role}}
<a title="Impersonate {{:username}}" class="btn btn-sm btn-primary" href="{{:url}}">
  Impersonate
</a>
{{else}}
  N/A
{{/if}}

</script>
