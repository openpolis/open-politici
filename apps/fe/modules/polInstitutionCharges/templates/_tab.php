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
<?php echo use_helper('Javascript') ?>
<div class="sottomenu">
  <span class="add">
  <?php if ($sf_user->hasCredential('subscriber')): ?>
    <?php echo link_to('&raquo; Aggiungi incarico istituzionale', '@nuovo_incarico_istituzionale?politician_id='.$politician_id, array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 'class'=>'orange')) ?>
  <?php else : ?>
    <?php echo link_to('&raquo; Aggiungi incarico istituzionale', '@sf_guard_signin', array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it'));?>	
  <?php endif; ?>     
  </span>
  <div>Nelle Istituzioni (<?php echo $ist_count ?>)</div>
  <div>
    <?php echo link_to_remote('Nei Partiti ('.$pol_count.')', array(
      'update' => 'charges_container',
      'url'    => 'polPoliticalCharges/tab?politician_id='.$politician_id.'&ist_count='.$ist_count.'&pol_count='.$pol_count.'&org_count='.$org_count,
	  'script' => true
    )) ?>  
  </div>
  <div>
    <?php echo link_to_remote('Altro (Aziende, Sindacati, ecc.) ('.$org_count.')', array(
      'update' => 'charges_container',
      'url'    => 'polOrgCharges/tab?politician_id='.$politician_id.'&ist_count='.$ist_count.'&pol_count='.$pol_count.'&org_count='.$org_count,
	  'script' => true
    )) ?> 	
  </div>
  </div>
  <div class="table-container">
    <table border="0" cellspacing="0" cellpadding="0" summary="Tabella della carriere">
      <?php $tr_class='dark'; ?>
	  <?php foreach ($institution_charges as $institution_charge): ?>
	    <tr class="<?php echo $tr_class;?>">
	      <?php include_component('polInstitutionCharges', 'show', array('institution_charge' => $institution_charge)) ?>
		</tr>
		<?php $tr_class = ($tr_class=='dark' ? 'light' : 'dark'); ?>	
	  <?php endforeach; ?>
	  
	  <?php foreach ($past_institution_charges as $past_institution_charge): ?>
	    <tr class="<?php echo $tr_class;?>">
	      <?php include_component('polInstitutionCharges', 'show', array('institution_charge' => $past_institution_charge)) ?>
		</tr>
		<?php $tr_class = ($tr_class=='dark' ? 'light' : 'dark'); ?>	
	  <?php endforeach; ?>
	</table>
  </div>
<div class="explain">Stiamo importando tutti gli incarichi nelle Amministrazioni locali del 1985 a oggi.</div>