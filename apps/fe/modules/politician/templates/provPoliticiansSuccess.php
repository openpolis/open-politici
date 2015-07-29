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
<?php use_helper('Date', 'Javascript'
	/* canonicals links */
	, 'HeaderLinks');
	
		if ( sfRouting::getInstance()->getCurrentRouteName() == 'provincia' )
			add_link(
				'@provincia_new?slug='. $location->getSlug() .'&location_id='. $location->getId(),
				'canonical');
	?>


<div id="title">
  <em class="rights-elements">    
    <?php if ($sf_user->hasCredential('subscriber')): ?>
         <?php echo link_to('&raquo; Segnala inesattezze', 'politician/dontFind?location_id='.$location->GetId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    <?php else: ?>
       <?php echo link_to('&raquo; Segnala inesattezze', '@sf_guard_signin', array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    <?php endif; ?>
  </em>
  
  <?php if($sf_user->hasCredential('subscriber') && !$sf_user->isLocationAdopter($location->getId())): ?>
    <?php echo link_to('adotta questa localit&agrave;', 
                       '@adozione?type=loc&adoptee_id=' . $location->getId(), 
                       array('style' => 'float:right; margin-right: 60px')) ?>
    <?php else: ?> 
        <?php if(!$sf_user->hasCredential('subscriber')): ?> 
           <?php echo link_to('adotta questa localit&agrave;', 
                       '@sf_guard_signin', 
                       array('style' => 'float:right; margin-right: 60px')) ?>
         <?php endif; ?>                     
     <?php endif; ?>
  
  
  <h1><?php echo 'Provincia di'."&nbsp;".$location->GetName(); ?></h1>
</div>
<hr/>

<?php include_component('politician', 'provincialPoliticians', array('location_id'=> $location->getId())) ?>
<br />
<div id="title">
  <em class="rights-elements">
    fonte: <?php echo link_to('Ministero degli Interni', 'http://amministratori.interno.it/')?>
    <?php if($location->getLastChargeUpdate()): ?>
      | revisione degli utenti:&nbsp;<?php echo format_date($location->getLastChargeUpdate(), 'dd/MM/yyyy') ?>
    <?php endif; ?> 
    
    <?php if ($sf_user->hasCredential('subscriber')): ?>
        | <?php echo link_to('&raquo; Segnala inesattezze', 'politician/dontFind?location_id='.$location->GetId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    <?php else: ?>
      | <?php echo link_to('&raquo; Segnala inesattezze', '@sf_guard_signin', array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    <?php endif; ?>
  </em>
 </div>
 <br />
 <br /> 