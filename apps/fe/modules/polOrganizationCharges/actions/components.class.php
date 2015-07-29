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
 * polOrganizationCharges components.
 *
 * @package    openpolis
 * @subpackage polOrganizationCharges
 * @author     Gianluca Canale
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class polOrganizationChargesComponents extends sfComponents
{
	public function executeShow()
	{
	}
	
	public function executeOrganizationChargeTitle()
	{
		$this->organization_charge = OpOrganizationChargePeer::RetrieveByPk($this->organization_charge_id);
	}
	
	public function executeOrganizationChargeInfo()
	{
		$this->organization_charge = OpOrganizationChargePeer::RetrieveByPk($this->organization_charge_id);
	}
	
	public function executeTab()
  {
    
  }	  
	
}

?>
