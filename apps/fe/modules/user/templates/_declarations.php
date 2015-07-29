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
<?php use_helper('Date', 'Javascript') ?>

<?php include_partial('user/header', array('current' => 'dichiarazioni', 'hash' => $hash, 'subscriber' => $subscriber)) ?>
<?php include_partial('user/filtro_attivita', array('current_filter' => $upsert, 'url' => '/user/declarations', 'hash' => $hash, 'genre' => 'f')) ?>

<?php if ($declarations):?>
  <table class="utente" style="font-size: 12px">
  <?php foreach($declarations as $declaration): ?>
    <tr>
      <td class="label" style="text-align: center; width:20px">
        <?php if ($declaration->getOpOpenContent()->getUpdaterId() == $subscriber->getId()): ?>
          [M]
        <?php else: ?>
          [I]
        <?php endif ?>
      </td>
      <td class="last">
        <?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getCreatedAt(), "dd/MM/yyyy (HH:mm)");?> -  
        <?php echo link_to($declaration->getOpPolitician()->toString().':&nbsp;'.$declaration->getTitle(),
                          //'polDeclarations/index?declaration_id='.$declaration->getContentId()
						  '@dichiarazione_new?'.$declaration->getSlugUrl()
								); ?>
    	  <?php echo format_number_choice('[0]|[1] 1 voto|(1,+Inf] %1% voti', 
    	                                  array('%1%' => $declaration->getRelevancyScore()), 
    	                                        $declaration->getRelevancyScore()) ?>
    	  <?php echo format_number_choice('[0]|[1] 1 commento|(1,+Inf] %1% commenti', 
    	                                  array('%1%' => $declaration->getOpOpinableContent()->getCommentsNumber()),
    	                                        $declaration->getOpOpinableContent()->getCommentsNumber()) ?>

      </td>
    </tr>
  <?php endforeach; ?>
	</table>
<?php else: ?>
  <div>Nessuna dichiarazione fino a questo punto</div>
<?php endif; ?>
