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
 * statistics actions.
 *
 * @package    openpolis
 * @subpackage statistics
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class statisticsActions extends sfActions
{
  
  public function executeDonazioni()
  {
    $this->donazioni = OpRequiredFundsPeer::doSelect(new Criteria());
    $this->getResponse()->addJavaScript('http://static.simile.mit.edu/timeplot/api/1.0/timeplot-api.js');
  }
  
  /**
   * Executes index action
   *
   */
  public function executeDefault()
  { 
    $c= new Criteria();
    $c->add(OpProfessionPeer::OID,NULL,Criteria::ISNULL);
    $this->profs=OpProfessionPeer::doSelect($c);
  }
}

?>
