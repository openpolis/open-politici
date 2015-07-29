<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpInstitutionPeer.php';
  
  // include object class
  include_once 'lib/model/OpInstitution.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_institution' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpInstitutionPeer extends BaseOpInstitutionPeer {

  /**
   * torna il primo tra i record che verificano il name
   * il campo non è unique, ma per i nostri fini, praticamente, lo è
   *
   * @return OpInstitution
   * @author Guglielmo Celata
   **/
  public function retrieveByName($name)
  {
    $c = new Criteria();
    $c->add(self::NAME, $name);
    return self::doSelectOne($c);
  }

} // OpInstitutionPeer
