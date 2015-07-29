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
<ol>
  <?php foreach ($faqs as $faq ): ?>
    <?php if($display == 'questions'): ?>
      <li><a href="#faq_<?php echo $faq->getId() ?>"><?php echo $faq->getQuestion() ?></a></li>
    <?php else: ?>
	  <li id="faq_<?php echo $faq->getId()?>"><strong><?php echo $faq->getQuestion() ?></strong><br />
	  <?php echo $faq->getAnswer() ?><br />[<a href="#">inizio pagina</a>]</li>
     <?php endif; ?>
  <?php endforeach; ?>	
</ol>