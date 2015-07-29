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
  require_once 'lib/model/om/BaseOpLocationTypePeer.php';
  
  // include object class
  include_once 'lib/model/OpLocationType.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_location_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpLocationTypePeer extends BaseOpLocationTypePeer {
  
  public static function retrieveByName($name)
  {
    $c = new Criteria();
    $c->add(self::NAME, $name);
    $res = self::doSelect($c);
    if (count($res) == 0) throw new sfDatabaseException('No results');
    if (count($res) >1 ) throw new sfDatabaseException('More than one result');
    return $res[0];
  }

} // OpLocationTypePeer
