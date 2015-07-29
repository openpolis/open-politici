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
<?php use_helper('Date') ?>

<p>L'utente <?php echo (string)$user ?> ha oscurato un contenuto.</p>

<p>
Relativamente al politico
<?php echo $politician->getFirstName() . " " . $politician->getLastName() . " - " . format_date($politician->getBirthDate()); ?>, 
è stata oscurata questa informazione:
<br/>
<?php
switch($opContent->getOpClass())
	{
		case 'OpResources':
			include_component('polResources', 'resourceTitle', array('resource_id' => $content_id));
			break;

		case 'OpInstitutionCharge':
			include_component('polInstitutionCharges', 'institutionChargeTitle', array('institution_charge_id' => $content_id));
			include_component('polInstitutionCharges', 'institutionChargeInfo', array('institution_charge_id' => $content_id));
			break;

		case 'OpPoliticalCharge':
			include_component('polPoliticalCharges', 'politicalChargeTitle', array('political_charge_id' => $content_id));
			include_component('polPoliticalCharges', 'politicalChargeInfo', array('political_charge_id' => $content_id));
			break;

		case 'OpOrganizationCharge':
			include_component('polOrgCharges', 'organizationChargeTitle', array('organization_charge_id' => $content_id));
			include_component('polOrgCharges', 'organizationChargeInfo', array('organization_charge_id' => $content_id));
			break;
			
		case 'OpDeclaration':
		  $content = OpDeclarationPeer::retrieveByPK($content_id);
			echo $content->getTitle();
			break;				
	}	
?>

<p>
  La motivazione segnalata dall'utente:<br/>
	<?php echo $reason; ?> 
</p>

<p>
  Se sei un amministratore, puoi andare alla sezione <a href="<?php echo $sf_request->getHost() . url_for('@obscured_contents') ?>">gestione contenuti oscurati</a>, altrimenti puoi inviare una segnalazione agli amministratori, all'indirizzo <a href="mailto:info@openpolis.it">info@openpolis.it</a>
</p> 
