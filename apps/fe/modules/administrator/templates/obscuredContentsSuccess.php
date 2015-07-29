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

<div id="content-group">
  <div id="sx" style="background:none; margin:0px; width:100%">
    <div id="title">
      <h1>
        <span class="bacchetta">Contenuti oscurati</span>
      </h1>
    </div>
    <hr />

    <div id="indicator-container" style="position:fixed; top: 0px; right: 0px;">
      <div style="display: none;" class="indicator" id="indicator"></div>
    </div>

    <div class="genericblock">
      <div class="mask obscured">
        <div id="obscured_contents">
	        <?php echo include_partial('administrator/chargesObscured', 
	                                    array('obscured_contents' => $obscured_charges)) ?>
        </div>
        <br /><br />
        <div id="obscured_declarations" class="themes">
	        <?php echo include_partial('administrator/declarationsObscured', 
	                                   array('obscured_contents' => $obscured_declarations)) ?>
        </div>
        <br /><br />
        <div id="obscured_themes" class="declarations">
	        <?php echo include_partial('administrator/themesObscured', 
	                                   array('obscured_contents' => $obscured_themes)) ?>
        </div>
      </div>
    </div>  
    
  </div>
</div>  