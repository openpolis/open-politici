<?php
$contexts = OpImportModificationsPeer::getDistinctContextsForRecType('old');
?>
<span class="context_filter">
  <div class="context_filter_group">
    <?php echo select_tag('filters[context]', 
                          options_for_select($contexts, array_key_exists('context', $filters)?$filters['context']:'')) ?>
  </div>
</span>
