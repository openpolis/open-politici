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
<br />

<p style="padding-top:20px; text-align:center"><?php echo __('la nuvola del politico') ?></p>
<div id="tag_cloud_container">  
  <p style="text-align:center">
    settimana&nbsp;|&nbsp;
    <?php echo link_to_remote('mese', array('update' => 'tag_cloud_container', 'url' => 'sidebar/cloudForPolitician?period=mounth&content_id='.$content_id)) ?>
    &nbsp;|&nbsp;
	<?php echo link_to_remote('tutti', array('update' => 'tag_cloud_container', 'url' => 'sidebar/cloudForPolitician?period=all&content_id='.$content_id)) ?>
  </p>
  <br />
  <ul id="tag_cloud">
    <?php foreach($tags as $tag => $cont): ?>
    <?php $char0 = strpos($tag,'%'); $char=strpos($tag,'_');
    $char2=strpos($tag,'-');
    $char3=strpos($tag,'?') ?>
    <li class="tag_popularity_<?php echo $cont ?>"><?php echo link_to(substr($tag,0,$char).'('.substr($tag,$char3+1,strlen($tag)).')', '@tag?tag='.substr($tag,$char+1,$char2-$char-1), array('rel'=>'tag')) ?></li>
  <?php endforeach; ?>
  </ul>
</div>  