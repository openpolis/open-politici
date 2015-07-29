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
<h1><?php echo __('Elenco comment report') ?></h1>
<?php 
if ($comment_reports)
{
?>
	<table style="width:90%">
		<tr>
			<th><?php echo __('utente'); ?></th>
			<th><?php echo __('politico'); ?></th>
			<th><?php echo __('dichiarazione'); ?></th>
			<th><?php echo __('segnalato'); ?></th>
			<th><?php echo __('nota'); ?></th>
			<th>&nbsp;</th>
		</tr>
			
	<?php 
	foreach ($comment_reports as $comment_report) 
	{
	
		$c=new Criteria();
		$c->Add(OpCommentPeer::ID, $comment_report->getCommentId());
		$comment=OpCommentPeer::DoSelectOne($c);
		
		$c1=new Criteria();
		$c1->Add(OpDeclarationPeer::CONTENT_ID, $comment->getContentId());
		$declaration=OpDeclarationPeer::DoSelectOne($c1);
		
	?>
		<tr>
			<td><?php echo link_to($comment_report->getOpUser()->__toString()); ?></td>
			<td><?php echo link_to($declaration->getOpPolitician()->getLastName(), '@politico_new?content_id='.$declaration->getPoliticianId() .'&slug='.$declaration->getOpPolitician()->getSlug() ); ?></td>
			<td><?php echo $declaration->getTitle() ?></td>
			<td><?php 
				switch($comment_report->getReportType())
				{
					case 'e':
						echo 'errore';
						break;
					
					case 'o':
						echo 'offensivo';
						break;	
				
					case 's':
						echo 'spam';
						break;
				}
				?>
			</td>
			<td><?php echo $comment_report->getNotes(); ?></td>
			<td><?php echo link_to(__('rimuovi report'), 'moderator/deleteCommentReport?user_id='.$comment_report->getUserId()."&comment_id=".$comment->getId(), array('confirm'=>'Confermi l\'eliminazione?')) ?></td>
		</tr>
		<tr>
			<td><?php echo __('commento'); ?></td>
			<td colspan="4"><?php echo $comment->getBody() ?>
			</td>
		</tr>
	<?php
	}
	?>
	</table>
<?php
}
else
{
echo __('Non ci sono comment report');
}
?>	