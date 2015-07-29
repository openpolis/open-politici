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
<?php echo use_helper('Javascript', 'Content', 'User', 'Date', 'Lightbox') ?>

<td>
  <?php Text::politicalChargeDefinition($political_charge, true) ?>
</td>

<?php if ($sf_user->hasCredential('moderator') || 
          $sf_user->hasCredential('administrator') || 
          $sf_user->isAdopter($political_charge->getPoliticianId()) || 
         ($sf_user->getAttribute('subscriber_id', '', 'subscriber')==$political_charge->getOpOpenContent()->getUserId())): ?>
   <td class="lastright">
    <?php echo link_to('&raquo; edit', '@modifica_incarico_politico?content_id='.$political_charge->getContentId(), array('class'=>'orange', 'lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')); ?>
      <?php if ($sf_user->hasCredential('moderator') || $sf_user->hasCredential('administrator') ): ?>
        &nbsp;|&nbsp;
        <?php $edit_link_options = array(
						'title' => 'oscura carica politica',
						'class' => 'new blocksize_600x500 orange',
						'script' => true,
						'onclick' => false
					);    
				echo light_modallink('&raquo; oscura', 
				     'polPoliticalCharges/obscuration?political_charge_id='.$political_charge->getContentId(), $edit_link_options); ?>
       <?php endif; ?>
     </td>  
<?php else : ?>
    <?php if ($sf_user->hasCredential('subscriber')): ?>
        <td class="lastright">
    <?php echo link_to('&raquo; Segnala errori / abusi', 
	                  'politician/reportForm?content_id='.$political_charge->getContentId().'&user_id='.$sf_user->getAttribute('subscriber_id', '', 'subscriber').'&politician_id='.$political_charge->getPoliticianId(),
	                   array('class'=>'orange', 'lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?>
    </td>
    <?php else: ?>
        <td class="lastright">
	<?php echo link_to('&raquo; Segnala errori / abusi', '@sf_guard_signin', array('class'=>'orange', 'lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?>
        </td> 
    <?php endif; ?>
   
<?php endif; ?>	