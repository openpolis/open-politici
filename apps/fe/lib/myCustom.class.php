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

class myCustom
{
	public static function custom1($my_str, $autocmpl_flag)
	{
		$c = new Criteria();
		$criterion = $c->getNewCriterion(OpPoliticianPeer::LAST_NAME, $my_str."%", Criteria::LIKE);
		$c->Add($criterion);
		$c->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
		$c->addAscendingOrderByColumn(OpPoliticianPeer::FIRST_NAME);
		if($autocmpl_flag)
		{
			$c->setLimit(sfConfig::get('app_autocomplete_limit'));
		}
		$politicians=OpPoliticianPeer::doSelect($c);
				
		//query nel caso di numero di record minore di quello minimo
		if (count($politicians) < sfConfig::get('app_autocomplete_limit')) {
			$politicians = NULL;
			$c1 = new Criteria();
			$criterion1 = $c1->getNewCriterion(OpPoliticianPeer::LAST_NAME, $my_str."%", Criteria::LIKE);
			
			$c1->Add($criterion1);
			$c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
			$c1->addAscendingOrderByColumn(OpPoliticianPeer::FIRST_NAME);
			if($autocmpl_flag)
			{
				$c1->setLimit(sfConfig::get('app_autocomplete_limit'));
			}
			$politicians=OpPoliticianPeer::doSelect($c1);
		}
		
		return $politicians;		
	}
	
	public static function custom2($my_str, $autocmpl_flag)
	{
		$c = new Criteria();
		$c->Add(OpLocationPeer::CITY_ID,'',Criteria::NOT_EQUAL);
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID,'6');
		$c->Add(OpLocationPeer::NAME, $my_str."%", Criteria::LIKE);
		$c->addAscendingOrderByColumn(OpLocationPeer::NAME);
		if($autocmpl_flag)
		{
			$c->setLimit(sfConfig::get('app_autocomplete_limit'));
		}
		$locations=OpLocationPeer::doSelect($c);
				
		//query nel caso di numero di record minore di quello minimo previsto
		if (count($locations)<sfConfig::get('app_autocomplete_limit')) {
			$locations = null;
			$c1 = new Criteria();
			$c1->Add(OpLocationPeer::CITY_ID,'',Criteria::NOT_EQUAL);
			$c1->Add(OpLocationPeer::LOCATION_TYPE_ID,'6');
			$c1->Add(OpLocationPeer::NAME, $my_str."%", Criteria::LIKE);
			$c1->addAscendingOrderByColumn(OpLocationPeer::NAME);
			if($autocmpl_flag)
			{
				$c1->setLimit(sfConfig::get('app_autocomplete_limit'));
			}
			$locations=OpLocationPeer::doSelect($c1);
		}
		
		return $locations;
	}
	
	

}
?>