<?php
  $statuses = array('-' => 'Qualsiasi',
                    'A' => 'Accettato', 
                    'R' => 'Rifiutato', 
                    ''  => 'Non Verificato');
  $fstatuses = isset($filters['statuses']) ? $filters['statuses'] : array();
  
?>
<span class="statuses_filter">
<?php foreach ($statuses as $key => $status): ?>
  <div class="statuseses_filter_group">
  <?php
    echo radiobutton_tag('filters[statuses][]',
      $key, in_array($key, $fstatuses));
  ?>
    <span class="statuseses_filter_group_label">
    <?php if ($key !== ''): ?>
      <label style="display:inline" 
             for="filters_statuses_<?php echo $key?>_<?php echo $key?>"><?php echo $status; ?></label>
    <?php else: ?>
      <label style="display:inline" 
             for="filters_statuses"><?php echo $status; ?></label>      
    <?php endif ?>
    </span>
  </div>
<?php endforeach ?>
</span>
