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

require_once 'lib/model/om/BaseOpLocation.php';


/**
 * Skeleton subclass for representing a row from the 'op_location' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpLocation extends BaseOpLocation {

	public function __toString()
	{
  	return $this->getName();
  }

  /**
   * return the election object having the latest date
   *
   * @return OpElection
   * @author Guglielmo Celata
   */
  public function getLastElection()
  {
    return OpElectionPeer::retrieveLastElectionForLocation($this);
  }

  public function getMinintName()
  {
    if ($this->getAlternativeName())
      return strtoupper($this->getAlternativeName());
    else
      return strtoupper($this->getName());
  }

  /**
   * torna la stringa import_location (Reg/Prov) a partire da un OpLocation
   *
   * @return string - stringa per usata nella fase di import dati, formato (Reg/Prov)
   * @author Guglielmo Celata
   **/
  public function getImportLocationString()
  {
    /* da trasferire in OpLocation::getImportName() */
    $c = new Criteria();
    $c->add(OpLocationPeer::REGIONAL_ID, $this->getRegionalId());
    $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
    $c->add(OpLocationTypePeer::NAME, 'Regione');
    $reg_obj = OpLocationPeer::doSelectOne($c);
    
    $c = new Criteria();
    $c->add(OpLocationPeer::PROVINCIAL_ID, $this->getProvincialId());
    $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
    $c->add(OpLocationTypePeer::NAME, 'Provincia');
    $prov_obj = OpLocationPeer::doSelectOne($c);
    return $reg_obj->getName() . "/" . $prov_obj->getName();    
  }
  
  /**
	 * return istat code, based on the location type
	 *
	 * @return void
	 * @author Guglielmo Celata
	 */
	public function getIstatCode()
	{
    $location_type = $this->getOpLocationType()->getName();
    switch ($location_type) {
      case 'Regione':
        $istat_code = $this->getRegionalId();
        break;
      case 'Provincia':
        $istat_code = $this->getProvincialId();
        break;
      case 'Comune':
        $istat_code = $this->getCityId();
        break;
      default:
        throw new Exception("Il tipo di location non è previsto");
        break;
    }
    return $istat_code;
	}
	
	/**
	 * returns province the city belongs to
	 *
	 * @return OpLocation object
	 * @author Guglielmo Celata
	 */
	public function getProvincia()
	{
	  if ($this->getLocationTypeId() != sfConfig::get('app_location_type_id_municipal'))
	    throw new Exception("method has meaning only for location type municipal");
	    
		$c = new Criteria();
		$c->add(OpLocationPeer::PROVINCIAL_ID, $this->getProvincialId());
		$c->add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_provincial'));
		return OpLocationPeer::doSelectOne($c);
	}
	
	public function getRegione()
	{
	  if ($this->getLocationTypeId() != sfConfig::get('app_location_type_id_municipal'))
	    throw new Exception("method has meaning only for location type municipal");

	 	$c = new Criteria();
		$c->add(OpLocationPeer::REGIONAL_ID, $this->getRegionalId());
		$c->add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_region'));
		return OpLocationPeer::doSelectOne($c);
	}
	
	
	/**
	 * return representation information for local institution
	 * all OpInstitution charges are joined with: 
	 *  OpPoliticianAndOpLocationAndOpChargeTypeAndOpParty
	 *
	 * @param int $location_id
	 * @param hash $organs_codes
	 *              name => name of the organ (giunta or consiglio)
	 *              code => id, as specified in the app_institution_id section of the app.yml file
	 * @return hash
	 *    presidente_giunta => array of OpInstitutionChargesJoined*
	 *    giunta => array of OpInstitutionChargesJoined*
	 *    presidente_consiglio => array of OpInstitutionChargesJoined*
	 *    consiglio => array of OpInstitutionChargesJoined*
	 *    commissario => array of OpInstitutionChargesJoined*
	 *    n_rappresentanti => total number of representatives
 	 * @author Guglielmo Celata
	 */
	public function getRappresentanzaLocale($location_id, $organs_codes)
	{
	  $n_rep = 0;
    foreach ($organs_codes as $name => $code) {
      $rappresentanza['presidente_'.$name] = OpInstitutionChargePeer::fetchOrganMembers($code, $location_id, true);
      $n_rep += count($rappresentanza['presidente_'.$name])>0?1:0;
      
      $rappresentanza[$name] = OpInstitutionChargePeer::fetchOrganMembers($code, $location_id, false);
      $n_rep += count($rappresentanza[$name]);      
    }
    $rappresentanza['commissario'] = OpInstitutionChargePeer::fetchOrganMembers(
      sfConfig::get('app_institution_id_CO'), $location_id);
    $n_rep += count($rappresentanza['commissario'])>0?1:0;
    
    $rappresentanza['n_rappresentanti'] = $n_rep;
    
    return $rappresentanza;
	}

  /**
   * return representation info for regione
   *
   * @param int $reg_id - passed if already known, if null, it's retrieved
   * @see OpLocation::getRappresentanzaLocale
   * @return hash
   * @author Guglielmo Celata
   */
	public function getRappresentanzaRegione($reg_id = null)
	{
	  if (is_null($reg_id))
      $reg_id = $this->getRegione()->getId();      
    
    $organs_codes = array('giunta' => sfConfig::get('app_institution_id_GR'), 
                          'consiglio' => sfConfig::get('app_institution_id_CR'));

	  return $this->getRappresentanzaLocale($reg_id, $organs_codes);
	}

  /**
   * return representation info for provincia
   *
   * @param int $prov_id - passed if already known, if null, it's retrieved
   * @see OpLocation::getRappresentanzaLocale
   * @return hash
   * @author Guglielmo Celata
   */
	public function getRappresentanzaProvincia($prov_id = null)
	{
	  if (is_null($prov_id))
      $prov_id = $this->getProvincia()->getId();      
    
    $organs_codes = array('giunta' => sfConfig::get('app_institution_id_GP'), 
                          'consiglio' => sfConfig::get('app_institution_id_CP'));

	  return $this->getRappresentanzaLocale($prov_id, $organs_codes);
	}

  /**
   * return representation info for comune
   *
   * @see OpLocation::getRappresentanzaLocale
   * @return hash
   * @author Guglielmo Celata
   */
	public function getRappresentanzaComune()
	{
    
    $organs_codes = array('giunta' => sfConfig::get('app_institution_id_GC'), 
                          'consiglio' => sfConfig::get('app_institution_id_CC'));

	  return $this->getRappresentanzaLocale($this->getId(), $organs_codes);
	}

	/**
	 * returns representation information for europarlamento
	 *
	 * @see OpLocation::getNationalCharges
	 * @author Guglielmo Celata
	 */
  public function getRappresentanzaEuroparlamento($prov_id = null)
  {
    return $this->getRappresentanzaNazionale(sfConfig::get('app_election_type_europa'), $prov_id);
  }

	/**
	 * returns representation information for camera
	 *
	 * @see OpLocation::getNationalCharges
	 * @author Guglielmo Celata
	 */
  public function getRappresentanzaCamera($prov_id = null)
  {
    return $this->getRappresentanzaNazionale(sfConfig::get('app_election_type_camera'), $prov_id);
  }

	/**
	 * returns representation information for senato
	 *
	 * @see OpLocation::getNationalCharges
	 * @author Guglielmo Celata
	 */
  public function getRappresentanzaSenato($prov_id = null)
  {
    return $this->getRappresentanzaNazionale(sfConfig::get('app_election_type_senato'), $prov_id);
  }
  
	/**
	 * returns representation information for national charges
	 *
	 * @param int $election_type_id - app_election_type_XXX (europa, camera, senato)
	 * @param int $prov_id - optional, the id of the province (in order not to get it again)
	 * @return hash
	 *  circoscrizione => OpConstituencyLocation (joined with OpConstituency)
	 *  rappresentanti => array of OpIntitutionCharge
	 *                     joined with: OpPolitician, OpGroup, OpChargeType
	 *  n_rappresentanti => number of representatives
	 * @author Guglielmo Celata
	 */
  public function getRappresentanzaNazionale($election_type_id, $prov_id = null)
  {
    $circoscrizione = $this->getConstituency($election_type_id, $prov_id);

		$c = new Criteria();
		$c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
		$c->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $circoscrizione->getConstituencyId());
		
		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    
		$charges = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpPoliticianAndOpGroupAndOpChargeType($c);

		return array('circoscrizione' => $circoscrizione, 'rappresentanti' => $charges, 'n_rappresentanti' => count($charges));
  }
	
  
  /**
   * returns the constituency of the given type for the location
   *
   * @param string $type_id 
	 * @param int $prov_id - optional, the id of the province (in order not to get it again)
   * @return OpConstituencyLocation (joined with OpConstituency)
   * @author Guglielmo Celata
   */
  public function getConstituency($type_id, $prov_id = null)
  {
    if (is_null($prov_id))
      $prov_id = $this->getProvincia()->getId();      
    
    $c = new Criteria(); 
		$c->add(OpConstituencyPeer::ELECTION_TYPE_ID, $type_id);
		$c->add(OpConstituencyLocationPeer::LOCATION_ID, $prov_id);
		$c->setLimit(1);
		$constituency = OpConstituencyLocationPeer::doSelectJoinOpConstituency($c); 
		return $constituency[0];
  }
  
    /**
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 */
	public function save($con = null)
	{        
                
        if ( $this->isNew() OR ( $this->isModified() AND $this->isColumnModified(OpLocationPeer::NAME ) ) ) {
            $this->setSlug( Utils::slugify( $this->getName() ) );
        }

        return parent::save($con);
    }
} // OpLocation

?>
