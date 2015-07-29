<?php
$charges_differ = array('' => 'qualsiasi', 1 => 'Sì', 0 => 'No');
?>
<span class="charges_differ_filter">
  <div class="charges_differ_filter_group">
    <?php echo select_tag('filters[charges_differ]', 
                          options_for_select($charges_differ, array_key_exists('charges_differ', $filters)?$filters['charges_differ']:'')) ?>
  </div>
</span>
