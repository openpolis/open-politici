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

/**
 * community actions.
 *
 * @package    openpolis
 * @subpackage community
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class communityActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {	
  	$this->response->setTitle("Gli iscritti alla Community | openpolis");
$this->response->addMeta('description','Le attività degli iscritti alla community. Le dichiarazioni e gli incarichi inseriti.',true);
  	$c = new Criteria();
  	$c->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_region'), Criteria::EQUAL);
  	$c->addAscendingOrderByColumn(OpLocationPeer::NAME);
  	$this->regions = OpLocationPeer::doSelect($c);
  }
    
}

?>