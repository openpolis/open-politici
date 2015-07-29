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
<?php echo use_helper('Text') ?>

<div class="wikiblock">
  <div class="header">
    <?php echo image_tag('symbols/wiki.png', array('class'=>'left', 'width'=>'19', 'height'=>'18', 'alt'=>'Wikipedia')) ?>
    <span class="rights-elements">
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'politician_wiki_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'politician_wiki_container\')')) ?>
    </span>
    <h3>Wikipedia</h3>
  </div>
  <div id="politician_wiki_container" class="textblock">
    <?php if ($text1): ?>
	  <?php echo Text::shorten($text1, 255, false); ?>
	  <br />
      <?php echo link_to('&raquo; Leggi tutto su Wikipedia','http://it.wikipedia.org/wiki/'.$name, array('lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'', 'target'=>'_blank')) ?>
    <?php else: ?>
    <?php echo __('In Wikipedia non esistono pagine per la voce <i>'.$name.'.</i>') ?>&nbsp;
       <?php echo link_to('Leggi le linee guida di pubblicazione ','http://it.wikipedia.org/wiki/Wikipedia:BIOGRAFIE#Criteri_per_la_presenza_su_Wikipedia') ?>per stabilire se puoi creare su Wikipedia la pagina dedicata al politico.
    <?php endif; ?>
  </div>
</div>
<hr />
<br />