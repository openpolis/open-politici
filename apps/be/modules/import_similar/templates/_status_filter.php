<?php
  $statuses = array('' => 'Qualsiasi',
                    'R' => 'Respinto', 
                    'A'  => 'Accettato');
  
?>
<span class="statuses_filter">
<?php foreach ($statuses as $key => $status): ?>
  <div class="statuseses_filter_group">
  <?php
echo radiobutton_tag('filters[statuses][]', $key, 
                     $key == (array_key_exists('statuses', $filters)?$filters['statuses'][0]:''));
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
