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
<?php echo use_helper('Javascript', 'Date'	
/* canonicals links */
	, 'HeaderLinks');

if ( sfRouting::getInstance()->getCurrentRouteName() == 'argomenti' )
	add_link(
		'@argomenti_new',
		'canonical');
?>
<div id="title">
  <em>Ultimo aggiornamento: <?php echo format_date(OpTagPeer::getLastUpdated(), 'dd/MM/yyyy') ?></em>
  <h1>Dichiarazioni dei politici</h1>
</div>

<hr />

<div class="genericblock">
<h2>In questa pagina trovi le dichiarazioni dei politici suddivise per argomenti.</h2> <br />
Pi&ugrave; la scritta &egrave; grande maggiore &egrave; il numero  delle dichiarazioni associate all'argomento. <br />
Cliccando su un singolo termine verranno visualizzate le dichiarazioni dei politici riferite all'argomento. <br /><br />
  <div style="margin-top: 8px;" id="indicator-container">
    <div id="users_indicator" class="indicator" style="display: none;"></div>
  </div>


  <div id ="tags_container">

    <div class="header">
      <h2>Tutti gli argomenti delle dichiarazioni (<?php echo count($tags) ?>)</h2>
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

    <div class="textblock">
      <div class="nuvolaargomenti">
        <?php foreach($tags as $tag => $cont_norm): ?>
	      <?php $char0 = strpos($tag,'%'); $char1 = strpos($tag,'_');  $char2 = strpos($tag,'-'); $char3 = strpos($tag,'*') ?>
	      <?php $nome = substr($tag,$char0+1,$char1-$char0-1); ?>
	      <?php $id = substr($tag,$char1+1,$char2-$char1-1); ?>
	      <?php $cont = substr($tag,$char2+1,$char3-$char2-1); ?>
	      <?php $updated_at = substr($tag,$char3+1); ?>	
          <span class="size<?php echo $cont_norm ?>">
    	    <?php echo link_to($nome.'('.$cont.')', 
		                   '@tag?tag='.$id, 
						   array('class'=>'color'.Text::getCodeForTag($updated_at))) ?>
	      </span>
        <?php endforeach; ?>
      </div>
    </div>

  </div>

</div>

<hr />
<br />