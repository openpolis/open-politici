<?php
$n_diffs = array(0 => 'qualsiasi', 1 => 1, 2 => 2);
?>
<span class="n_diffs_filter">
  <div class="n_diffs_filter_group">
    <?php echo select_tag('filters[n_diffs]', 
                          options_for_select($n_diffs, array_key_exists('n_diffs', $filters)?$filters['n_diffs']:'')) ?>
  </div>
</span>
