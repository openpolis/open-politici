<?php
$names_differ = array('' => 'qualsiasi', 1 => 'Sì', 0 => 'No');
?>
<span class="names_differ_filter">
  <div class="names_differ_filter_group">
    <?php echo select_tag('filters[names_differ]', 
                          options_for_select($names_differ, array_key_exists('names_differ', $filters)?$filters['names_differ']:'')) ?>
  </div>
</span>
