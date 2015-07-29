<?php
  $locations = OpImportSimilarPeer::getDistinctLocationsIdsWithNames(
    array_key_exists('context', $filters)?$filters['context']:''
  );
?>
<div class="locations_filter">
  <?php echo select_tag('filters[location_id]', options_for_select($locations, array_key_exists('location_id', $filters)?$filters['location_id']:'')) ?>
</div>
