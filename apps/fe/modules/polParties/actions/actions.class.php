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
 * polParties actions.
 *
 * @package    openpolis
 * @subpackage polParties
 * @author     Guglielmo Celata
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class polPartiesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('polParties', 'partiesList');
  }

  public function executePartiesList()
  {
    $this->msg = "Elenco dei Partiti";

    // Get locations types
    $c = new Criteria();
    $this->loc_types = OpLocationTypePeer::doSelect($c);

    // Initialize filterParameters variable
    $this->filterParameters = "";

    // Filter handling or initialization
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      // Handle the form submission
      $party_type_ar = $this->getRequestParameter('party_type');
      $this->party_type = $party_type_ar[0];
      $loc_type_ar = $this->getRequestParameter('loc_type');
      $this->loc_type = $loc_type_ar[0];
      if ($this->party_type=='0' && !$this->loc_type) { 
        $this->loc_type = "Tutte";
      }
    } else {
      // Default filter values
      $this->party_type = 0;
      $this->loc_type = 'Tutte';
      $this->region_id = 0;
      $this->prov_id = 0;
 
      // Read get parameters (if coming back from partyPoliticiansList)
      if ($this->hasRequestParameter('party_type')){
        $this->party_type = $this->getRequestParameter('party_type');
      }
      if ($this->hasRequestParameter('loc_type')){
        $this->loc_type = $this->getRequestParameter('loc_type');
      }
      if ($this->hasRequestParameter('regione')){
        $this->region_id = $this->getRequestParameter('regione');
      }
      if ($this->hasRequestParameter('provincia')){
        $this->prov_id = $this->getRequestParameter('provincia');
      }
    }
      
    $c = new Criteria();
    $c->add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
    $c->setDistinct(true);

    if ($this->party_type == '1')
    {
      $c->add(OpPartyPeer::PARTY, 1, Criteria::EQUAL);
      $this->filterParameters = "&party_type=1";
    }

    if ( $this->party_type == '0' && $this->loc_type != 'Tutte')
    {

      // get locations for current location types
      $cl = new Criteria();
      $cl->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
      $cl->add(OpLocationTypePeer::NAME, $this->loc_type, Criteria::EQUAL);
      $locations = OpLocationPeer::doSelect($cl);

      $c->addJoin(OpPartyLocationPeer::PARTY_ID, OpPartyPeer::ID);
      $c->addJoin(OpPartyLocationPeer::LOCATION_ID, OpLocationPeer::ID);
      $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
      if ($this->loc_type) {
        $c->add(OpLocationTypePeer::NAME, $this->loc_type, Criteria::EQUAL);
      }

      switch ($this->loc_type) {
        case "Regione":
          $this->reg_locations = array('0' => 'Tutte le regioni');
          foreach ($locations as $location){
            $this->reg_locations[$location->getId()] = $location->getName(); 
          }
          if ($this->hasRequestParameter('regione')) {
            $this->region_id = $this->getRequestParameter('regione');
            if ($this->region_id != 0) { $c->add(OpLocationPeer::ID, $this->region_id); }
          }
          $this->filterParameters = "&party_type=0&loc_type=" . $this->loc_type . "&regione=" . $this->region_id;
          break;
        case "Provincia":
          $this->prov_locations = array('0' => 'Tutte le provincie');
          foreach ($locations as $location){
            $this->prov_locations[$location->getId()] = $location->getName(); 
          }
          if ($this->hasRequestParameter('provincia')) {
            $this->prov_id = $this->getRequestParameter('provincia');
            if ($this->prov_id != 0) { $c->add(OpLocationPeer::ID, $this->prov_id); }
          }
          $this->filterParameters = "&party_type=0&loc_type=" . $this->loc_type . "&provincia=" . $this->prov_id;
          break;
        default:
          $this->filterParameters = "&party_type=0&loc_type=" . $this->loc_type;
          break;
      }
    }

    #$c->addAscendingOrderByColumn(OpPartyPeer::NAME);
    $this->parties = OpPartyPeer::doSelect($c);

  }



  public function executePartyPoliticiansList()
  {
    $this->msg = "Elenco politici per il partito ";

    if ($this->hasRequestParameter('party_id')){
      $party_id = $this->getRequestParameter('party_id');
      $party = OpPartyPeer::retrieveByPK($party_id);
      $this->msg .= $party->getName() . " ";
    } else {
      $this->forward404();
    }

    $this->filterParameters = "?a=1";
    if ($this->hasRequestParameter('party_type')){
      $party_type = $this->getRequestParameter('party_type');
      $this->filterParameters .= "&party_type=" . $party_type;
    }
    if ($this->hasRequestParameter('loc_type')){
      $loc_type = $this->getRequestParameter('loc_type');
      $this->filterParameters .= "&loc_type=" . $loc_type;
    }
    if ($this->hasRequestParameter('regione')){
      $region_id = $this->getRequestParameter('regione');
      $this->filterParameters .= "&regione=" . $region_id;
    }
    if ($this->hasRequestParameter('provincia')){
      $prov_id = $this->getRequestParameter('provincia');
      $this->filterParameters .= "&provincia=" . $prov_id;
    }

    switch ($loc_type) {
      case "Tutte":
        $loc_id = 0;
        break;
      case "Europa":
        $loc_id = 1;
        break;
      case "Italia":
        $loc_id = 2;
        break;
      case "Regione":
        $loc_id = $region_id;
        break;
      case "Provincia":
        $loc_id = $prov_id;
        break;
    } 

    $c = new Criteria();
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
    $c->addJoin(OpInstitutionPeer::ID, OpInstitutionChargePeer::INSTITUTION_ID);
    $c->addJoin(OpChargeTypePeer::ID, OpInstitutionChargePeer::CHARGE_TYPE_ID);
    $c->add(OpInstitutionChargePeer::PARTY_ID, $party_id, Criteria::EQUAL);
    if ($loc_id > 0) { 
      $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc_id, Criteria::EQUAL);
      $location = OpLocationPeer::retrieveByPK($loc_id);
      $this->msg .= "<br/>Contesto: " . $loc_type;
      if ($loc_id > 2) $this->msg .= "<br/>Localita': " . $location->getName();
    }
    $this->charges = OpInstitutionChargePeer::doSelect($c);

  }

}
