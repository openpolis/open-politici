<?php
$birth_dates_differ = array('' => 'qualsiasi', 1 => 'Sì', 0 => 'No');
?>
<span class="birth_dates_differ_filter">
  <div class="birth_dates_differ_filter_group">
    <?php echo select_tag('filters[birth_dates_differ]', 
                          options_for_select($birth_dates_differ, array_key_exists('birth_dates_differ', $filters)?$filters['birth_dates_differ']:'')) ?>
  </div>
</span>
