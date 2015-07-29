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
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'regional_wiki_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'regional_wiki_container\')')) ?> 
    </span>
    <h3>Wikipedia </h3>   	
  </div>  		
  <div id="regional_wiki_container" class="textblock">
    <?php echo Text::shorten($text1, 255, false); ?>
	<br />
    <a lang="it" xml:lang="it" hreflang="it" title="" target="_blank" href="http://it.wikipedia.org/wiki/Giunta_regionale">&raquo; Leggi tutto su Wikipedia </a>
  </div>  	
</div>
<br />
<div class="wikiblock">
  <div class="header">
    <?php echo image_tag('symbols/wiki.png', array('class'=>'left', 'width'=>'19', 'height'=>'18', 'alt'=>'Wikipedia')) ?>  	
    <span class="rights-elements">
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'regional_wiki_container2_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'regional_wiki_container2\')')) ?> 
    </span>
    <h3>Wikipedia </h3>   	
  </div>  		
  <div id="provincial_wiki_container2" class="textblock">
    <?php echo Text::shorten($text2, 255, false); ?>
	<br />
    <a lang="it" xml:lang="it" hreflang="it" title="" target="_blank" href="http://it.wikipedia.org/wiki/Consiglio_regionale">&raquo; Leggi tutto su Wikipedia </a>
  </div>  	
</div>
<hr />
<br />	