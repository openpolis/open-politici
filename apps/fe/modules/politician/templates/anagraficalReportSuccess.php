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
<h1>
<span class="bacchetta">Segnala errori / mancanze</span>
</h1>
</div>
<hr/>
<div class="genericblock">
Stai segnalando degli errori o mancanze relative alle <strong>informazioni anagrafiche</strong>.<br />
Cerca di essere il pi&ugrave; chiaro possibile. Grazie per il contributo.<br />

  <div class="mask">
    <?php echo form_tag('politician/report') ?>
	  <table cellspacing="0" cellpadding="0" border="0">
        
          <tr>
          <td>Segnalo i seguenti errori o mancanze:<br />
            <?php echo textarea_tag('notes', '', array('rows'=>'10', 'cols'=>'80')) ?>
          </td>  	
          </tr>
	<tr>
	<td>
			<?php echo input_hidden_tag('user_id', $user_id) ?>
	          <?php echo input_hidden_tag('content_id', $content_id) ?>
	          <?php echo input_hidden_tag('politician_id', $politician_id) ?>
			<?php echo submit_tag('Invia', array('class'=>'cerca')); ?>
	</td>
	</tr>
      </table>
	</form>
 
</div>
</div>
<br />