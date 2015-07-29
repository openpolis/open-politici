<?php
  $c = new Criteria; 
  $c->add(OpImportLogPeer::IMPORT_ID, $op_import->getId()); 
  $nrecs = OpImportLogPeer::doCount($c);

  $n_warnings = $op_import->getWarnings();
  if ( $n_warnings > 0 && $nrecs > 0) 
  {
    echo link_to($n_warnings, 
                 'import_log/list?filters[import_id]='.$op_import->getId().
                   "&filters[type]=warnings&filter=filter", 
                 array('title' => 'Visualizza gli avvisi', 'style' => 'font-weight: bold; text-decoration: underline'));
    $n_checked_warnings = $op_import->getNCheckedWarnings();
    if ($n_checked_warnings > 0)
      echo " (". ($n_warnings - $n_checked_warnings) .") ";
  }
  else 
    echo $op_import->getWarnings(); 
?>
 
