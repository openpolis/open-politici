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
  require_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
  
  // include object class
  include_once 'lib/model/OpConstituencyLocation.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_constituency_location' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpConstituencyLocationPeer extends BaseOpConstituencyLocationPeer {

  /**
   * torna un array di constituencies, a partire da una location
   *
   * @param opLocation - la location per la quale vanno estratte le constituencies
   *
   * @return array - oggetti di tipo opConstituency (o null)
   * @author Guglielmo Celata
   **/
  public function getConstituenciesByLocation($loc)
  {
    $c = new Criteria();
    $c->add(self::LOCATION_ID, $loc->getId());
    return self::doSelect($c);
  }
  
  public function getProvincialIdsByConstituency($const_id)
  {
    $c = new Criteria();
    $c->add(self::CONSTITUENCY_ID, $const_id);
    $c->addJoin(self::LOCATION_ID, OpLocationPeer::ID);
    $c->clearSelectColumns();
    $c->addSelectColumn(OpLocationPeer::PROVINCIAL_ID);
    
    $ids = array();
    $rs = self::doSelectRS($c);
    while ($rs->next()) {
      $ids []= $rs->getInt(1);
    }
    
    return $ids;
  }
  
} // OpConstituencyLocationPeer
