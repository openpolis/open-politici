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
 * polInstitutionCharges components.
 *
 * @package    openpolis
 * @subpackage polInstitutionCharges
 * @author     Gianluca Canale
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class polInstitutionChargesComponents extends sfComponents
{
	public function executeShow()
	{
	
	}
	
	public function executeInstitutionChargeTitle()
	{
		$this->institution_charge = OpInstitutionChargePeer::RetrieveByPk($this->institution_charge_id);
	}
	
	public function executeInstitutionChargeInfo()
	{
		$this->institution_charge = OpInstitutionChargePeer::RetrieveByPk($this->institution_charge_id);
	}
	
	public function executeChargeTitle()
	{
		$c = new Criteria();
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addAscendingOrderByColumn(OpInstitutionPeer::PRIORITY);
		$this->institution_charges=$this->politician->getOpInstitutionCharges($c);
	}
	
	public function executeGroups()
	{
	  $institution_charge = OpInstitutionChargePeer::RetrieveByPk($this->institution_charge_id);
      	  	  
	  if($institution_charge)
	  {
		$this->group_id=$institution_charge->getGroupId();
	  }
	  else
	  {
		$this->group_id=1;
	  }	
	  
	  if ($this->location_id=='1' || $this->location_id=='2')
      {
        $c = new Criteria();
        $c->addJoin(OpGroupPeer::ID, OpGroupLocationPeer::GROUP_ID, Criteria::LEFT_JOIN);
        $c->Add(OpGroupLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
	    $c->add(OpGroupPeer::ID, '42', Criteria::NOT_EQUAL);
		$c->addAscendingOrderByColumn(OpGroupPeer::NAME);
		$this->primary_group_list = OpGroupPeer::doSelect($c);
	  }
	  else
	  {	
	    $c = new Criteria();
        $c->addJoin(OpGroupPeer::ID, OpGroupLocationPeer::GROUP_ID, Criteria::LEFT_JOIN);
        $c->Add(OpGroupLocationPeer::LOCATION_ID, '2', Criteria::EQUAL);
	    $c->add(OpGroupPeer::ID, '42', Criteria::NOT_EQUAL);
		$c->addAscendingOrderByColumn(OpGroupPeer::NAME);
		$this->primary_group_list = OpGroupPeer::doSelect($c);
	  
	    $primary_group_array[]="";
        $primary_group_array[]="1";
        foreach ($this->primary_group_list as $primary_group)
        {
	      $primary_group_array[]=$primary_group->getId();
	    }
        $primary_group_array[]="42";
        $c = new Criteria();
        $c->addJoin(OpGroupPeer::ID, OpGroupLocationPeer::GROUP_ID, Criteria::LEFT_JOIN);
        $c->Add(OpGroupLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
        $c->Add(OpGroupPeer::ID, $primary_group_array, Criteria::NOT_IN);
        $c->addAscendingOrderByColumn(OpGroupPeer::NAME);
        $this->local_group_list = OpGroupPeer::doSelect($c);
	  }	
      
	}
	
	public function executeParties()
	{
	  $institution_charge = OpInstitutionChargePeer::RetrieveByPk($this->institution_charge_id);
    if($institution_charge)
		  $this->party_id=$institution_charge->getPartyId();
	  else
		  $this->party_id=1;

    $c = new Criteria();
	  $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_main'), Criteria::EQUAL);
    $cor = $c->getNewCriterion(OpPartyPeer::OID, NULL, Criteria::ISNULL);
    $cor->addOr($c->getNewCriterion(OpPartyPeer::OID, 0));
    $c->add($cor);	
	  $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
	  $this->primary_party_list = OpPartyPeer::doSelect($c);
	
	  $primary_party_array[]="";
	  $primary_party_array[]="1";
	  foreach ($this->primary_party_list as $primary_party)
		  $primary_party_array[]=$primary_party->getId();
	
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

      if($this->location_id!=sfConfig::get('app_location_id_europe') && $this->location_id!=sfConfig::get('app_location_id_italy'))
	  {	
	    $c = new Criteria();
	    $c->addJoin(OpPartyPeer::ID, OpPartyLocationPeer::PARTY_ID, Criteria::LEFT_JOIN);
	    $c->Add(OpPartyLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
	    $c->Add(OpPartyPeer::ID, $primary_party_array, Criteria::NOT_IN);
	    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
	    $this->local_party_list = OpPartyPeer::doSelect($c);
      } 		
	
	}
	
	public function executeTab()
	{
	  
	}	
	
	public function executeMultipleChargeTitle()
	{
	  $this->politician=array();
		$c = new Criteria();
		$c->clearSelectColumns();
		$c->addJoin(OpPoliticianPeer::CONTENT_ID,OpInstitutionChargePeer::POLITICIAN_ID);
		$c->addJoin(OpInstitutionPeer::ID,OpInstitutionChargePeer::INSTITUTION_ID);
		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpLocationPeer::ID,OpInstitutionChargePeer::LOCATION_ID);
		$c->addJoin(OpChargeTypePeer::ID,OpInstitutionChargePeer::CHARGE_TYPE_ID);
		//$c->add(OpLocationPeer::INHABITANTS,10000, Criteria::GREATER_EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		// escludi ministri e sottosegretari
		//$c->add(OpInstitutionPeer::NAME, 'Governo Nazionale', Criteria::NOT_EQUAL);
		
		$c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c->addSelectColumn(OpPoliticianPeer::LAST_NAME);
		$c->addSelectColumn(OpPoliticianPeer::FIRST_NAME);
		$c->addSelectColumn(OpPoliticianPeer::CONTENT_ID);
		$c->addSelectColumn("MAX(".OpLocationPeer::INHABITANTS.")");
		$c->addSelectColumn("MIN(".OpInstitutionPeer::PRIORITY.")");
		$c->addAsColumn("NumIncarichi", "COUNT(DISTINCT ".OpInstitutionChargePeer::LOCATION_ID.",".OpInstitutionChargePeer::INSTITUTION_ID.")");
		$c->addAsColumn("NumIncarichiTotali", "COUNT(*)");
		$c->addAsColumn("NumLocalitaTotali", "COUNT(DISTINCT ".OpInstitutionChargePeer::LOCATION_ID.")");
                

		if ($this->ordina==1)
		  $c->addDescendingOrderByColumn('NumIncarichi');
		  $c->addAscendingOrderByColumn("MIN(".OpInstitutionPeer::PRIORITY.")");
		  $c->addAscendingOrderByColumn("MIN(".OpChargeTypePeer::PRIORITY.")");
		if ($this->ordina==2)
		  $c->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
		  $c->addAscendingOrderByColumn("MIN(".OpInstitutionPeer::PRIORITY.")");
		  $c->addAscendingOrderByColumn("MIN(".OpChargeTypePeer::PRIORITY.")");
		if ($this->ordina==3) 
		{
		  $c->addAscendingOrderByColumn("MIN(".OpInstitutionPeer::PRIORITY.")");
		  $c->addAscendingOrderByColumn("MIN(".OpChargeTypePeer::PRIORITY.")");
		  //$c->addDescendingOrderByColumn(OpLocationPeer::INHABITANTS);
		}
  	$c->addGroupByColumn("POLITICIAN_ID");
		$rs=OpPoliticianPeer::doSelectRS($c);
		while ($rs->next())
		{
		  if (($rs->getInt(6)>1 && ($rs->getInt(4)>15000) || $rs->getInt(8)>1))
		  //if ($rs->getInt(6)>1)
		  {
		    $this->politician[]=link_to(strtoupper($rs->getString(1))." ".ucwords(strtolower($rs->getString(2))),'/politico/'.$rs->getInt(3))." (".$rs->getInt(6)." incarichi".($rs->getInt(6)!=$rs->getInt(7) ? " in diverse istituzioni, ".$rs->getInt(7)." in totale)" : ")");  
		  }
		   
		}    
	}
	
	
	public function executeEntiCommissariati()
	{
	  $enti_commissariati=array();
		$c = new Criteria();
		$c->add(OpChargeTypePeer::NAME,'Commissario straordinario');
		$comm=OpChargeTypePeer::doSelectOne($c);
		
		$c=new Criteria();
		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);
		$c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID,$comm->getId());
	  $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
	  $c->add(OpInstitutionChargePeer::DESCRIPTION, NULL, Criteria::ISNOTNULL);
	  $c->addGroupByColumn(OpInstitutionChargePeer::LOCATION_ID);
	  $c->addAscendingOrderByColumn(OpLocationPeer::REGIONAL_ID);
	  $c->addAscendingOrderByColumn(OpLocationPeer::NAME);
		$politician=OpInstitutionChargePeer::doSelect($c);
		foreach ($politician as $p)
		{
		  $c=new Criteria();
  		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
  		$c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  		$c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID,array(7,14),Criteria::IN);
  		$c->add(OpInstitutionChargePeer::INSTITUTION_ID,array(6,8,10),Criteria::IN);
  	  $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::ISNOTNULL);
  	  $c->add(OpInstitutionChargePeer::LOCATION_ID, $p->getLocationId());
  	  $c->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_END);
  	  $past=OpInstitutionChargePeer::doSelectOne($c);
  	  if ($past)
  	  {
  	    $reg_name=OpLocationPeer::retrieveRegionByRegionId($p->getOpLocation()->getRegionalId())->getName();
  	    if ($p->getOpLocation()->getCityId()!=NULL )
  	    {
  	     $loc_name=$p->getOpLocation()->getName();
  	     $loc_id=$p->getOpLocation()->getId();
  	     $prov=$p->getOpLocation()->getProv();  
  	    }
  	    else
  	    {
  	      $loc_name=$p->getOpLocation()->getName();
    	    $loc_id=$p->getOpLocation()->getId();
    	    $prov="";
  	    }
  	    $enti_commissariati[]=array($reg_name,$loc_name,$loc_id,$prov,$p->getDescription(),$past->getDateEnd(), $past->getDateEnd('d/m/Y'));
  	  } 
		}	
		$this->enti_commissariati=$enti_commissariati;
	}  	

	
}

?>
