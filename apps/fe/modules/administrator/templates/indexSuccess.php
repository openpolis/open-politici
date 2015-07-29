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
<?php echo use_helper('Javascript', 'Lightbox') ?>

<div class="adminblock">
  <ul>
    <?php echo include_partial('sidebar/administration_links') ?>
  </ul>
</div>
	
<script type="text/javascript">
//<![CDATA[
function toggleDeathDiv()
{
  div = 'death_div';	
  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.4});
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.4});
  }

  return false;
}
//]]>
</script>