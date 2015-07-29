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
<?php echo use_helper('Validation') ?>

<div id="title">
<h1><span class="bacchetta">Segnala informazioni inesatte o mancanti</span></h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />

<div class="genericblock">
Inserisci le informazioni relative alle inesattezze o mancanze che hai riscontrato.
	<br />Cerca di essere il pi&ugrave; chiaro possibile. Grazie per il contributo.<br />
<div class="mask">
Voglio segnalare che:
<table border="0" cellspacing="0" cellpadding="0">	
<tr>
<td>

<?php echo form_tag('politician/dontFindNotification') ?>
<?php if (form_has_error('info')): ?>
	<?php echo form_error('info') ?><br />
<?php endif; ?>

<?php echo textarea_tag('info', '', array('rows'=>'10', 'cols'=>'80')) ?>
	<?php echo input_hidden_tag('user_id', $sf_user->getSubscriberId()) ?>
	<?php echo input_hidden_tag('location_id', $location_id) ?>
	</td></tr>
	<tr><td>
	<?php echo submit_tag('Invia', array('class'=>'cerca')) ?>
	</td></tr>
	</form>

</table>
</div>	
</div>
<br />