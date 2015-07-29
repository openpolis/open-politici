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
<?php use_helper('User') ?>

<?php
  $class = 'few_interests';
  if ($content->getRelevancyScore() > 1000)
  {
    	$class = 'many_interests';
  }
  else if ($content->getRelevancyScore() > 100)
  {
    	$class = 'some_interests';
  }
?>


<div class="vote <?php echo $class;?>">
  <?php echo $content->getRelevancyScore() ?>
</div>

<?php if (!isset($mode) || $mode != 'show'): ?>
  <strong><?php echo link_to_user_vote($sf_user, $content, $label) ?></strong>  
<?php else: ?>
  <strong><?php echo $label ?></strong>  
<?php endif; ?>
  

