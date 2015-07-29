<form method="post" class="button_to" style="float:right"
     action="<?php echo url_for('@politician_delete?content_id='.$content_id)?>">
  <div style="display:inline">
    <input style="padding: 1px 3px 2px 20px; background: url(/sf/sf_admin/images/delete.png) no-repeat 1px 0px #FFC; border-right: 4px solid #E75C58 !important;" value="delete" type="submit" onclick="return confirm('Are you sure?');" />
  </div>
</form>
<div stle="clear:both">&nbsp;</div>
