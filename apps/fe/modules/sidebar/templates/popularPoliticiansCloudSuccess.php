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

<div class="header">
  <span class="rights-elements">
    <?php echo link_to(image_tag('buttons/close.png', array('id' => 'popular_politician_cloud_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'popular_politician_cloud_container\')')) ?> 
  </span>
  <h3>Politici con pi&uacute; dichiarazioni</h3>
</div>
<div id="popular_politician_cloud_container">
<div class="sottomenu">
  <?php echo($period=='week' ? 'settimana' : link_to_remote('settimana', array('update' => 'politician_cloud_container', 'url' => 'sidebar/popularPoliticiansCloud?period=week')) ) ?>
  &nbsp;&nbsp;|&nbsp;&nbsp;
  <?php echo($period=='mounth' ? 'mese' : link_to_remote('mese', array('update' => 'politician_cloud_container', 'url' => 'sidebar/popularPoliticiansCloud?period=mounth')) ) ?>
  &nbsp;&nbsp;|&nbsp;&nbsp;
  <?php echo($period=='all' ? 'sempre' : link_to_remote('sempre', array('update' => 'politician_cloud_container', 'url' => 'sidebar/popularPoliticiansCloud?period=all')) ) ?>
</div>
<div class="textblock">
  <div class="nuvolaargomenti">
    <?php foreach($politicians as $politician => $cont_norm): ?>
	    <?php $char1 = strpos($politician,'_');  $char2 = strpos($politician,'-'); $char3 = strpos($politician,'*');$char4= strpos($politician,'|'); ?>
	    <?php $nome = substr($politician,0,$char1); ?>
	    <?php $id = substr($politician,$char1+1,$char2-$char1-1); ?>
	    <?php $cont = substr($politician,$char2+1,$char3-$char2-1); ?>
	    <?php $updated_at = substr($politician,$char3+1,$char4-$char3-1); ?>	
		  <?php $slug = substr($politician,$char4+1); ?>	
	    <span class="size<?php echo $cont_norm ?>">
	      <?php echo link_to('<span class=\"surname\">'.$nome.'</span>('.$cont.')', 
		                   '@politico_new?slug='. $slug .'&content_id='.$id, 
						   array('class'=>'color'.Text::getCodeForTag($updated_at))) ?>
        </span>
	  <?php endforeach; ?>
  </div>
</div>  
</div> 