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
if(substr($institution_charge->getDateStart(),5,2)!= '01' && substr($institution_charge->getDateStart(),8,2) != '01'):
	echo 'dal&nbsp;'.format_date($institution_charge->getDateStart(), 'dd/MM/yyyy');
else:
	echo 'dal&nbsp;'.substr($institution_charge->getDateStart(),0,4);
endif;
?>

<?php 
if ($institution_charge->getDateEnd() != ''): 
	if(substr($institution_charge->getDateEnd(),5,2)!= '01' && substr($institution_charge->getDateEnd(),8,2) != '01'):
			echo 'al&nbsp;'.format_date($institution_charge->getDateEnd(), 'dd/MM/yyyy');
	else:
		echo 'al&nbsp;'.substr($institution_charge->getDateEnd(),0,4);
	endif;
endif; 
?>
&nbsp;-&nbsp;
<?php echo $institution_charge->getOpChargeType()->getName(); ?>
&nbsp;
<?php echo $institution_charge->getOpInstitution()->getName(); ?>
&nbsp;-
<?php if ($institution_charge->getDescription()):
	echo $institution_charge->getDescription()."&nbsp;-&nbsp;";
endif; ?>

<?php if ($institution_charge->getPartyId()):?>
	<?php echo $institution_charge->getOpParty()->getName(); ?>
<?php else: ?>
	<?php echo $institution_charge->getOpGroup()->getName(); ?>
<?php endif; ?>