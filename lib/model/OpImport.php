<?php

require_once 'lib/model/om/BaseOpImport.php';


/**
 * Skeleton subclass for representing a row from the 'op_import' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImport extends BaseOpImport {

  /**
   * torna il numero di warning che sono stati controllati
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function getNCheckedWarnings()
  {
    $c = new Criteria();
    $c->addJoin(OpImportPeer::ID, OpImportLogPeer::IMPORT_ID);
    $c->addJoin(OpImportUserCheckPeer::IMPORT_LOG_COUNTER, OpImportLogPeer::COUNTER);
    $c->addJoin(OpImportUserCheckPeer::IMPORT_FILE, OpImportPeer::IMPORT_FILE);
    $c->add(OpImportLogPeer::STATUS, 'PIS');
    $c->add(OpImportPeer::ID, $this->getId());
    
    return OpImportPeer::doCount($c);
  }
  
} // OpImport
