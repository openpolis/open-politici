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
<div id="title">
  <h1>Faq (domande frequenti)</h1>
</div>
<hr />

<div class="genericblock">
  <div class="header"><h2>Domande</h2></div>
  <br />
  <?php foreach ($faq_groups as $faq_group): ?> 
    <h2><?php echo $faq_group->getName() ?></h2>
    <?php include_partial('faq/faqForGroup', array('display' => 'questions', 'faqs' => $faq_group->getOpFaqs())) ?>
  <?php endforeach; ?>
</div>

<div class="genericblock">
  <div class="header"><h2>Risposte</h2></div>
  <br />
  <?php foreach ($faq_groups as $faq_group): ?> 
    <h2><?php echo $faq_group->getName() ?></h2>
    <?php include_partial('faq/faqForGroup', array('display' => 'answers', 'faqs' => $faq_group->getOpFaqs())) ?>
  <?php endforeach; ?>
</div>