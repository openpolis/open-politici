<?php
$birth_places_differ = array('' => 'qualsiasi', 1 => 'Sì', 0 => 'No');
?>
<span class="birth_places_differ_filter">
  <div class="birth_places_differ_filter_group">
    <?php echo select_tag('filters[birth_places_differ]', 
                          options_for_select($birth_places_differ, array_key_exists('birth_places_differ', $filters)?$filters['birth_places_differ']:'')) ?>
  </div>
</span>
