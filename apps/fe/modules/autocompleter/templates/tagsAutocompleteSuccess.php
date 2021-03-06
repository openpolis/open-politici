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
<ul>
	<?php foreach ($tags as $tag) {?>
		
			<?php
				$c=new Criteria();
				$c->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $content_id);
				$c->Add(OpTagHasOpOpinableContentPeer::TAG_ID, $tag->GetId());
				$real_tag=OpTagHasOpOpinableContentPeer::doSelect($c);
				
				if (!$real_tag)
				{
				?>
				<li id="<?=$tag->GetId()?>"><?php echo $tag->GetTag() ?></li>
				<?php
				}
				?>
   	<?php } ?>
</ul>