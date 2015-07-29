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


<?php if ($period == 'week'): ?>
  <div class="header">
    <h2>Gli argomenti delle dichiarazioni di questa settimana (<?php echo count($tags) ?>)</h2>
  </div>
  <div class="sottomenu">
    <div>settimana</div>
    <div>
      <?php echo link_to_remote('mese', 
                                array('update' => 'tags_container', 
                                      'url' => 'argument/tagsVisualization?period=month',
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
    </div>
    <div>
      <?php echo link_to_remote('sempre', 
                                array('update' => 'tags_container', 
                                      'url' => 'argument/tagsVisualization?period=all',
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
    </div>
  </div>
<?php elseif ($period == 'month'): ?>
  <div class="header">
    <h2>Gli argomenti delle dichiarazioni di questo mese (<?php echo count($tags) ?>)</h2>
  </div>
  <div class="sottomenu">
    <div>
      <?php echo link_to_remote('settimana', 
                                array('update' => 'tags_container', 
                                      'url' => 'argument/tagsVisualization?period=week',
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
    </div>
    <div>mese</div>
    <div>
      <?php echo link_to_remote('sempre', 
                                array('update' => 'tags_container', 
                                      'url' => 'argument/tagsVisualization?period=all',
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
    </div>
  </div>  
<?php else: ?>
  <div class="header">
    <h2>Tutti gli argomenti delle dichiarazioni (<?php echo count($tags) ?>)</h2>
  </div>
  <div class="sottomenu">
    <div>
      <?php echo link_to_remote('settimana', 
                                array('update' => 'tags_container', 
                                      'url' => 'argument/tagsVisualization?period=week',
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
    </div>
    <div>
      <?php echo link_to_remote('mese', 
                                array('update' => 'tags_container', 
                                      'url' => 'argument/tagsVisualization?period=month',
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
    </div>
    <div>sempre</div>
  </div>  
<?php endif; ?>


<div class="textblock">
  <div class="nuvolaargomenti">
    <?php foreach($tags as $tag => $cont_norm): ?>
      <?php $char0 = strpos($tag, '%'); $char1 = strpos($tag,'_');  $char2 = strpos($tag,'-'); $char3 = strpos($tag,'*') ?>
      <?php $nome = substr($tag, $char0+1, $char1-$char0-1); ?>
      <?php $id = substr($tag, $char1+1, $char2-$char1-1); ?>
      <?php $cont = substr($tag, $char2+1, $char3-$char2-1); ?>
      <?php $updated_at = substr($tag, $char3+1); ?>	
      <span class="size<?php echo $cont_norm ?>">
  	    <?php echo link_to($nome.'('.$cont.')', 
                     '@tag?tag='.$id, 
  				   array('class'=>'color'.Text::getCodeForTag($updated_at))) ?>
      </span>
    <?php endforeach; ?>
  </div>
</div>
