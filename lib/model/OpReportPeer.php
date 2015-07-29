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
  require_once 'lib/model/om/BaseOpReportPeer.php';
  
  // include object class
  include_once 'lib/model/OpReport.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_report' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpReportPeer extends BaseOpReportPeer {
  
  public static function doCountWithFilterForAdopter($adopter_id)
  {
    $reports = self::doSelectWithFilterForAdopter($adopter_id);
    return count($reports);
  }


  public static function doSelectWithFilterForAdopter($adopter_id)
  {
    
    $filtered_reports = array();
    $adoptees_ids = array();

    $reports = self::doSelect( new Criteria());

    $adoptees = OpAdoptionPeer::getAdoptees($adopter_id);
    foreach ($adoptees as $adoptee)
    {
      if ($adoptee instanceof OpPolAdoption)
        $adoptees_ids []= $adoptee->getPoliticianId();
      else
        $adoptees_ids []= $adoptee->getLocationId();
    }

    foreach ($reports as $report) 
  	{

  		$c = new Criteria();
      $pol_id = 0;
      
  		switch($report->getOpContent()->getOpClass())
  		{
  			case 'OpResources':
  				$c->add(OpResourcesPeer::CONTENT_ID, $report->getContentId());
  				$pol_id = OpResourcesPeer::doSelectOne($c)->getPoliticianId();
  				break;

  			case 'OpInstitutionCharge':
  				$c->add(OpInstitutionChargePeer::CONTENT_ID, $report->getContentId());
  				$pol_id = OpInstitutionChargePeer::doSelectOne($c)->getPoliticianId();
  				break;

  			case 'OpPoliticalCharge':
  				$c->add(OpPoliticalChargePeer::CONTENT_ID, $report->getContentId());
  				$pol_id = OpPoliticalChargePeer::doSelectOne($c)->getPoliticianId();
  				break;

  			case 'OpOrganizationCharge':
  				$c->add(OpOrganizationChargePeer::CONTENT_ID, $report->getContentId());
  				$pol_id = OpOrganizationChargePeer::doSelectOne($c)->getPoliticianId();
  				break;

  			case 'OpPolitician':
  				$c->add(OpPoliticianPeer::CONTENT_ID, $report->getContentId());
  				$pol_id = OpPoliticianPeer::doSelectOne($c)->getContentId();
  				break;			
  		}
  		
  		// aggiunge il report a quelli filtrati se l'id del politico è tra gli adottati
  		if (in_array($pol_id, $adoptees_ids)) $filtered_reports []= $report;
  	}
    
    return $filtered_reports;
      
  }
  
} // OpReportPeer
