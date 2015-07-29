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
<?php foreach ($actual_political_charges as $actual_political_charge): ?>
	<li>
		<?php echo $actual_political_charge->getOpChargeType()->getName() ?>
		<?php echo $actual_political_charge->getOpParty()->getName() ?>
		<?php if ($actual_political_charge->getLocationId() > 2): ?>
			<?php echo $actual_political_charge->getOpLocation()->getName() ?>
				<?php if ($actual_political_charge->getInstitutionId() == $id_giunta_comunale || $actual_political_charge->getInstitutionId() == $id_consiglio_comunale): ?>
					(<?php echo $actual_political_charge->getOpLocation()->getProv() ?>)
				<?php endif; ?>	
		<?php endif; ?>
	</li>	
<?php endforeach; ?>

<?php foreach ($actual_organization_charges as $actual_organization_charge): ?>
	<li>
		<?php echo $actual_organization_charge->getChargeName() ?>
		<?php echo $actual_organization_charge->getOpOrganization()->getName() ?>
	</li>
<?php endforeach; ?>