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
<?php echo use_helper('Javascript', 'Date', 'Lightbox') ?>

<div id="title">
<!--  <em>
    <?php if($last): ?>
      ultimo aggiornamento:&nbsp;<?php echo format_date($last, 'dd/MM/yyyy') ?>
    <?php else: ?>
      ultimo aggiornamento: 30/10/2007
    <?php endif; ?>
  </em>-->
  <h1>Indice attivit&agrave; Senato XV Legislatura (2006-2008)</h1>
</div>
<hr />


<!-- #################### INIZIO PRESENZE ####################  -->
<?php echo $xmlout; ?>
<!-- #################### FINE PRESENZE ####################  -->


<?php echo javascript_tag("function toggleFormReport()
{
  if (Element.visible('anagrafical_report'))
  {
    ".visual_effect('BlindUp', 'anagrafical_report', array('duration' => 0.4 ))."
  }
  else
  {
    ".visual_effect('BlindDown', 'anagrafical_report', array('duration' => 0.4 ))."
  }

  return false;
}") ?>

<script type="text/javascript">
//<![CDATA[
function toggleObscuredReport(content_id)
{
  div = 'obscured_'+content_id;
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

<script type="text/javascript">
//<![CDATA[
function toggleTagDiv(content_id)
{
  div = 'tags_for_'+content_id;
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

<script type="text/javascript">
//<![CDATA[
function toggleContainer(item_type)
{
  div = item_type+'_container';
  toggler=item_type+'_toggler';

  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.4});
	$(toggler).innerHTML='espandi';
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.4});
	$(toggler).innerHTML='contrai';
  }

  return false;
}
//]]>
</script>