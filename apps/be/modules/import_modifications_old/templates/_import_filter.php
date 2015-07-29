<?php
$imports = OpImportModificationsPeer::getDistinctImportsForRecType('old');
?>
<span class="import_filter">
  <div class="import_filter_group">
    <?php echo select_tag('filters[import]', 
                          options_for_select($imports, array_key_exists('import', $filters)?$filters['import']:'')) ?>
  </div>
</span>
