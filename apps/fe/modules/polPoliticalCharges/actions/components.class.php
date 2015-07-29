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
 * polPoliticalCharges components.
 *
 * @package    openpolis
 * @subpackage polPoliticalCharges
 * @author     Gianluca Canale
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class polPoliticalChargesComponents extends sfComponents
{
  public function executeShow()
  {
  }

  public function executePoliticalChargeTitle()
  {
    $this->political_charge = OpPoliticalChargePeer::RetrieveByPk($this->political_charge_id);
  }

  public function executePoliticalChargeInfo()
  {
    $this->political_charge = OpPoliticalChargePeer::RetrieveByPk($this->political_charge_id);
  }

  public function executeParties()
  {
    $political_charge = OpPoliticalChargePeer::RetrieveByPk($this->political_charge_id);
    if($political_charge)
  	{
  	  $this->party_id=$political_charge->getPartyId();
  	}
  	else
  	{
  	  $this->party_id=1;
  	}
	   	
    $c = new Criteria();
  	$c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_main'), Criteria::EQUAL);
    $cor = $c->getNewCriterion(OpPartyPeer::OID, NULL, Criteria::ISNULL);
    $cor->addOr($c->getNewCriterion(OpPartyPeer::OID, 0));
    $c->add($cor);	
  	$c->addAscendingOrderByColumn(OpPartyPeer::NAME);
  	$this->primary_party_list = OpPartyPeer::doSelect($c);
	
  	$c = new Criteria();
  	$c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_secondary'), Criteria::EQUAL);
    $cor = $c->getNewCriterion(OpPartyPeer::OID, NULL, Criteria::ISNULL);
    $cor->addOr($c->getNewCriterion(OpPartyPeer::OID, 0));
    $c->add($cor);	
  	$c->addAscendingOrderByColumn(OpPartyPeer::NAME);
  	$this->secondary_party_list = OpPartyPeer::doSelect($c);
	
  	$c = new Criteria();
  	$c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_death'), Criteria::EQUAL);
    $cor = $c->getNewCriterion(OpPartyPeer::OID, NULL, Criteria::ISNULL);
    $cor->addOr($c->getNewCriterion(OpPartyPeer::OID, 0));
    $c->add($cor);	
  	$c->addAscendingOrderByColumn(OpPartyPeer::NAME);
  	$this->death_party_list = OpPartyPeer::doSelect($c);
  }
  
  public function executeTab()
  {
    
  }	  	  
	
}

?>
