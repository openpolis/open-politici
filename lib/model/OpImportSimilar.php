<?php

require_once 'lib/model/om/BaseOpImportSimilar.php';


/**
 * Skeleton subclass for representing a row from the 'op_import_similar' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImportSimilar extends BaseOpImportSimilar {

  public function reject($user)
  {
    if (!is_null($this->getDeletedAt())) {
      # contenuto già respinto
      return array('type' => 'warning', 'message' => "L'item è già rifiutato, lo status non è cambiato", 
                   'operation' => '');
    } else {
      # respingi contenuto
      $now = time();
      $this->setDeletedAt($now);
      $this->setDeletingUserId($user->getSubscriberId());
      $this->save();
      return array('type' => 'notice', 'message' => "L'item è stato rifiutato", 
                   'operation' => 'rifiutato');
    }    
  }

  public function restore()
  {
    if (is_null($this->getDeletedAt())) {
      # contenuto valido e non ripristinabile
      return array('type' => 'warning', 'message' => "L'item è già valido, lo status non è cambiato", 
                   'operation' => '');
    } else {
      # ripristina contenuto
      $now = time();
      $this->setDeletedAt(null);
      $this->setDeletingUserId(null);
      $this->save();
      return array('type' => 'notice', 'message' => "L'item è stato ripristinato", 
                   'operation' => 'ripristinato');
    }    
  }

} // OpImportSimilar
