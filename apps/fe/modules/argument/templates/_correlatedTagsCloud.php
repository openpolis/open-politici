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
<strong>Argomenti correlati</strong><br />
<?php foreach($tags as $tag => $cont): ?>
  <?php $char1 = strpos($tag,'_');  $char2 = strpos($tag,'-'); $char3 = strpos($tag,'*') ?>
  <?php $nome = substr($tag,0,$char1); ?>
  <?php $id = substr($tag,$char1+1,$char2-$char1-1); ?>
  <?php $cont = substr($tag,$char2+1,$char3-$char2-1); ?>
  <?php $updated_at = substr($tag,$char3+1); ?>	
  <span class="size<?php echo $cont ?>">
    <?php echo link_to($nome.'('.$cont.')', 
		                   //'@tag_new?tag='.$id.'&slug='. $nome, 
							'@tag?tag='. $id,
						   array('class'=>'color'.Text::getCodeForTag($updated_at))) ?>
  </span>
<?php endforeach; ?>