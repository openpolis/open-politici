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
<?php echo use_helper('Javascript', 'Date') ?>

<div class="genericblock">
  <div class="header">
    <span class="rights-elements">
      <?php echo link_to(image_tag('symbols/rss.png', array('alt'=>'Esporta RSS', 'width'=>'23', 'height'=>'12', 'border'=>'0')), '@feed_location_declarations?location_id='.$sf_params->get('location_id'), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
      <?php echo link_to(image_tag('symbols/blog.png', array('alt'=>'Esporta per Blog', 'width'=>'76', 'height'=>'12', 'border'=>'0')), '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
      <?php echo link_to(image_tag('buttons/close.png', array('alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14'))) ?>
    </span>
    <h3>Ultime dichiarazioni</h3>
  </div>
  <div id="declaration_list" class="textblock">
    <ul class="dx-dichiara">
      <?php foreach($declarations as $declaration): ?>
	    <li>
          <?php echo link_to('&raquo;&nbsp;'.$declaration->getTitle(), '@dichiarazione_new?'.$declaration->getSlugUrl()) ?><br />
          <?php echo ucwords(strtolower($declaration->getOpPolitician()->getFirstName())).'&nbsp;<span class=\"surname\">'.$declaration->getOpPolitician()->getLastName().'</span>' ?>
          in data <?php echo format_date($declaration->getDate(), 'dd MMMM yyyy') ?><br />
		</li>
      <?php endforeach; ?>
	</ul>
	<?php if ($total_declarations>10): ?>
	  <?php echo link_to_remote('&raquo; Leggi le ultime 50 dichiarazioni', array('update' => 'declaration_list', 'url' => 'sidebar/locationFeed?location_id='.$sf_params->get('location_id'))) ?>
    <?php endif; ?>
  </div>
</div>
<hr />
<br />	
