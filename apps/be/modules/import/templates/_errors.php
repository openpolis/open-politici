<?php
  $c = new Criteria; 
  $c->add(OpImportLogPeer::IMPORT_ID, $op_import->getId()); 
  $nrecs = OpImportLogPeer::doCount($c);

  if ($op_import->getErrors() > 0 && $nrecs > 0) 
  {
    echo link_to($op_import->getErrors(), 
                 'import_log/list?filters[import_id]='.$op_import->getId().
                   "&filters[type]=errors&filter=filter", 
                 array('title' => 'Visualizza gli errori', 'style' => 'font-weight: bold; text-decoration: underline') );    
  }
  else echo $op_import->getErrors(); 
?>
 
