<div class="header" style="height: 1.2em; padding: 3px">
  <ul style="font-size: 12px; padding: 0; padding-left: 0.4em; font-weight: normal ">
    <?php foreach (OpUserPeer::$activities_filters as $filter => $labels): ?>
      <?php if ($current_filter == $filter): ?>
        <li><?php echo $labels[$genre] ?></li>
      <?php else: ?>
        <li><?php echo link_to_remote($labels[$genre], 
                                      array( 'update' => 'decl_comm', 
                                             'url' => sprintf("%s?hash=%s&upsert=%s", $url, $hash, $filter),
                                             'loading'  => "Element.show('decl_comm_indicator')",
                                             'complete' => "Element.hide('decl_comm_indicator')"
                                             )); ?></li>
      <?php endif ?>
      <?php if ($filter != 'update'): ?>      
        |
      <?php endif ?>  
    <?php endforeach ?>
  </ul>
</div>
