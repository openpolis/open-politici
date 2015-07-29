<?php echo select_tag('filters[type]', options_for_select(array(
  '' => '',
  'warnings' => 'Warning',
  'errors' => 'Errori',
), isset($filters['type']) ? $filters['type'] : '')) ?>
 
