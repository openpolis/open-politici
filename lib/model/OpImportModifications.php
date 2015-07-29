<?php

require_once 'lib/model/om/BaseOpImportModifications.php';


/**
 * Skeleton subclass for representing a row from the 'this' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImportModifications extends BaseOpImportModifications {

  /**
   * store or remove the object in the csv record
   * in the op_politician/op_institution_charge tables
   *
   * @param string $op_import_minint_date YYYYMMDD format
   * @return hash to notify the user the outcome of the operation
   * @author Guglielmo Celata
   */
  public function concretise()
  {
    if (!is_null($this->getBlockedAt())) {
      # impossibile concretizzare contenuto bloccato
      return array('type' => 'warning', 'message' => "L'item è bloccato e non può essere concretizzato", 
                   'operation' => '');
    }
    if (substr($this->getActionType(), 0, 1) == 'S') {
      # impossibile concretizzare contenuto da verificare
      return array('type' => 'warning', 'message' => "L'item contiene similarità e non può essere concretizzato", 
                   'operation' => '');
    }
    if (!is_null($this->getConcretisedAt())) {
      # contenuto già concretizzato
      return array('type' => 'warning', 'message' => "L'item è già concretizzato, lo status non è cambiato", 
                   'operation' => '');
    } 
    
    # set concretised_at and import_id
    $con = Propel::getConnection(OpImportModificationsPeer::DATABASE_NAME);
    try
    {
      $con->begin();

      $op_import_minint = $this->getOpImportMinint();
      if (!$op_import_minint) {
        throw new Exception("op_import_minint could not be found");
      }
      
      # set concretised_at
      $now = time();
      $this->setConcretisedAt($now);
      $this->save($con);
      
      if ($this->getRecType() == 'new') {
        OpImportModificationsPeer::addFromCSV($op_import_minint->getAggDate(), $this->getContext(), $this->getCsvRec(), $con, $this->getActionType());
      } else {
        OpImportModificationsPeer::closeFromCSV($op_import_minint->getAggDate(), $this->getContext(), $this->getCsvRec(), $con);          
      }
      $con->commit();

      return array('type' => 'notice', 'message' => "L'operazione &egrave; terminata con successo", 
                   'operation' => 'concretizzato');
      
    }
    catch (Exception $e)
    {
      $con->rollback();
      return array('type' => 'error', 'message' => "Si &egrave; verificato un errore durante l'operazione: " . $e, 
                   'operation' => '');
    }

  }

  public function reject($user)
  {
    if (substr($this->getActionType(), 0, 1) == 'S') {
      # impossibile concretizzare contenuto bloccato
      return array('type' => 'warning', 'message' => "L'item contiene similarità e non può essere concretizzato", 
                   'operation' => '');
    }
    if (!is_null($this->getBlockedAt())) {
      # contenuto già respinto
      return array('type' => 'warning', 'message' => "L'item è già rifiutato, lo status non è cambiato", 
                   'operation' => '');
    } 

    # set blocked_at to visualize the item as blocked
    $now = time();
    $this->setBlockedAt($now);
    $this->save();
    
    # store blocked record into op_import_block table, to memorize for future imports
    $c = new Criteria();
    $c->add(OpImportBlockPeer::REC_TYPE, $this->getRecType());
    $c->add(OpImportBlockPeer::CSV_REC, $this->getCsvRec());
    $block_record = OpImportBlockPeer::doSelectOne($c);
    if (!$block_record) {
      $block_record = new OpImportBlock();
      $block_record->setCreatingUserId($user->getSubscriberId());
      $block_record->setRecType($this->getRecType());
      $block_record->setCsvRec($this->getCsvRec());
      $block_record->save();
    }
      
    return array('type' => 'notice', 'message' => "L'item è stato rifiutato", 
                 'operation' => 'rifiutato');
  }

  public function restore()
  {
    if (is_null($this->getBlockedAt())) {
      # contenuto valido e non ripristinabile
      return array('type' => 'warning', 'message' => "L'item è già valido, lo status non è cambiato", 
                   'operation' => '');
    }

    # remove deleted_at field value, to visualize the record properly
    $now = time();
    $this->setBlockedAt(null);
    $this->save();

    # remove blocked record into op_import_block table
    $c = new Criteria();
    $c->add(OpImportBlockPeer::REC_TYPE, $this->getRecType());
    $c->add(OpImportBlockPeer::CSV_REC, $this->getCsvRec());
    $block_record = OpImportBlockPeer::doSelectOne($c);
    if ($block_record) {
      $block_record->delete();
    }

    return array('type' => 'notice', 'message' => "L'item è stato ripristinato", 
                 'operation' => 'ripristinato');
  }

} // OpImportModifications
