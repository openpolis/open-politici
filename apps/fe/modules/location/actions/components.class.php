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
 * location components.
 *
 * @package    openpolis
 * @subpackage location
 * @author     Gianluca Canale
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */  
class locationComponents extends sfComponents
{
	public function executeRegions()
	{
		$this->regions = new OpLocation();
		$this->regions = OpLocationPeer::getRegions();	
	}
	
	public function executeProvincials()
	{
		$this->provincials = new OpLocation();
		$c = new Criteria();
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '5');
		$c->Add(OpLocationPeer::NAME, '', Criteria::NOT_EQUAL);
		$c->addAscendingOrderByColumn(OpLocationPeer::NAME); 
		$this->provincials = OpLocationPeer::doSelect($c);	
	}

}
 
?>