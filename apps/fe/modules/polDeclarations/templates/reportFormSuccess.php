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
<b><?php echo ('segnala il commento') ?>:</b><br /><br />

<div><?php echo $comment->getHtmlBody() ?></div>
<br />
<div>
	<?php echo form_tag('polDeclarations/report') ?>
		<label for="content_type"><b><?php echo __('marca il contenuto come:') ?></b></label>
		<br /><br />
		<p style="width:300px">
			<label style="width:20%; float:left"><?php echo __('errato') ?>:&nbsp;</label><?php echo radiobutton_tag('report_type', '1', ($report_type=='e' ? true : false)) ?>
		</p>
		<p style="width:300px">
			<label style="width:20%; float:left"><?php echo __('offensivo') ?>:&nbsp;</label><?php echo radiobutton_tag('report_type', '2', ($report_type=='o' ? true : false)) ?>
		</p>
		<p style="width:300px">
			<label style="width:20%; float:left"><?php echo __('spam') ?>:&nbsp;</label><?php echo radiobutton_tag('report_type', '3', ($report_type=='s' ? true : false)) ?>
		</p>
		<br />
		<label for="notes"><b><?php echo ('nota descrittiva (opzionale)') ?>:</b></label><br />
		<?php echo textarea_tag('notes',$notes , 'size=50x5') ?>
		<?php echo input_hidden_tag('comment_id', $comment_id); ?>
		<?php echo input_hidden_tag('user_id', $user_id) ?>
		<?php echo submit_tag(__('inserisci')); ?>
		<?php echo link_to('back', 'polDeclarations/index?declaration_id='.$comment->getContentId()); ?>
	</form>	
</div>

