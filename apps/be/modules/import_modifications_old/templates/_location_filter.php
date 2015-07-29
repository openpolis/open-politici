<?php
  $locations = OpImportModificationsPeer::getDistinctLocationsIdsWithNamesForRecType(
    array_key_exists('context', $filters)?$filters['context']:'',
    'old'
  );
?>
<div class="locations_filter">
  <?php echo select_tag('filters[location_id]', 
                        options_for_select($locations, array_key_exists('location_id', $filters)?$filters['location_id']:'')) ?>
</div>
