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
<?php
$act = $this->getContext()->getActionName(); 
$mod = $this->getContext()->getModuleName();
?>

<ul>
  <li>
    <?php if ($mod == 'default' && $act == 'index'): ?>
      home
    <?php else: ?>
      <?php echo link_to('home', '@homepage'); ?>
    <?php endif; ?>
  </li>
  <li>
    <?php if (($mod == 'default' && $act == 'politiciansHome') || ($mod == 'politician') || ($mod == 'polDeclarations')  ): ?>
	  <?php echo link_to('politici', '@politici_new', array('style'=>'color:#000' ) ); ?>
	<?php else: ?>
	  <?php echo link_to('politici', '@politici_new'); ?>
    <?php endif; ?>
  </li>

  <li>
    <?php if ($mod == 'argument'): ?>
     <?php echo link_to('dichiarazioni', '@argomenti_new', array('style'=>'color:#000' ) ); ?>
	<?php else: ?>      	
      <?php echo link_to('dichiarazioni', '@argomenti_new'); ?>
    <?php endif; ?>
  </li>

  <li>  	
    <?php if (($mod == 'community') || ($mod == 'user')) : ?>
	  <?php echo link_to('comunit&agrave;', '@comunita_new', array('style'=>'color:#000' ) ); ?>
	<?php else: ?>      	
      <?php echo link_to('comunit&agrave;', '@comunita_new'); ?>
    <?php endif; ?>
  </li>
  
</ul>