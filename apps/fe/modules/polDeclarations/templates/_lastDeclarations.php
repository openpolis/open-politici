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
<?php use_helper('Date', 'Javascript') ?>

<div class="genericblock">
    <!-- blocco elenco dichiarazioni -->
    <div style="clear:both; height: 20px"></div>

    <div class="dichiarazione">
      <ul>
        <?php foreach ($declarations as $declaration): ?>
          <?php 	echo include_partial('polDeclarations/declarationBlock', 
                                       array('declaration' => $declaration, 
                                             'tag_id' => 0)); ?>
          <br class="clearleft" />
        <?php endforeach; ?>
      </ul>
    </div>

</div>