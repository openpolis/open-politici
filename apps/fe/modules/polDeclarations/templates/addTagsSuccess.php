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
<?php echo use_helper('Javascript', 'Date') ?>

<h1><?php echo __('IL POLITICO') ?></h1>

<?php echo "<h2>".$politician->getLastName()."&nbsp;".$politician->getFirstName()."</h2><br />" ?>

<img src="/<?php echo sfConfig::get('sf_environment')=='dev'?'fe_dev.php/':''; ?>politician/picture?content_id=<?php echo $politician->getContentId() ?>" alt="<?php echo $politician->toString(); ?>" border="0" width="60" height="80" /><h2>
<br />
<?php echo __('Dichiarazione') ?></h2>
<table>
<tr>
	<td><b><?php echo __('titolo') ?>:&nbsp;</b></td><td><?php echo $declaration->getTitle(); ?></td>
</tr>
<tr>
	<td><b><?php echo __('autore') ?>:&nbsp;</b></td><td><?php echo $declaration->getOpOpinableContent()->getOpOpenContent()->getOpUser()->getNickname(); ?></td>
</tr>
<tr>
	<td><b><?php echo __('data') ?>:&nbsp;</b></td><td><?php echo format_date($declaration->getDate(), 'dd/MM/yyyy') ?></td>
</tr>
<tr>
	<td><b><?php echo __('tags') ?>:&nbsp;</b></td>
	<td><?php foreach($declaration->getOpOpinableContent()->getOpTagHasOpOpinableContents() as $tag_for_opinable_content)
				{	
						echo $tag_for_opinable_content->getOpTag()->getTag()."&nbsp;&nbsp;&nbsp;" ;
				} ?>
	</td>
</tr>
</table>
<br />
<?php echo form_tag('polDeclarations/add') ?>
<label><b><?php echo __('inserisci tag') ?></b></label>
<?php echo include_partial('autocompleter/tagsAutocompleter', array('script' => 'true', 'declaration_id'=>$declaration->getContentId())); ?> 
<?php echo"(usa la virgola come separatore)"; ?>
<br />
<?php echo input_hidden_tag('declaration_id', $content_id); ?>
<?php echo submit_tag('ok'); ?>
<?php echo link_to('back', '@politico_new?content_id='.$politician->getContentId().'&slug='. $politician->getSlug()); ?>
</form>
