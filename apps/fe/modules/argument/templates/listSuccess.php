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
<?php use_helper('Global', 'Javascript'	
	/* canonicals links */
		, 'HeaderLinks');

/*	if ( sfRouting::getInstance()->getCurrentRouteName() == 'tag' )
		add_link(
			'@tag_new?slug=dichiarazioni-su-'. $tag->getNormalizedTag(). '&tag='. $tag->getId(),
			'canonical');

*/	?>

<!-- #################### INIZIO BLOCCO DICHIARAZIONI ####################  -->
<div class="genericblock">
   <div class="header">
     <span class="rights-elements">Esporta  &nbsp;<?php echo link_to_rss('tag declarations', '@feed_tag_declarations?tag_id='.$tag->getId()) ?> <a href="#" title="" hreflang="it" lang="it"><img src="/images/symbols/blog.png" alt="Esporta per Blog" width="76" height="12" /></a></span>
     <h2><?php echo __('Dichiarazioni sull\'argomento <em class="surname">%1%</em>', array('%1%' => $tag->getTag())) ?> (<?php echo $total ?>)</h2>
   </div>
   <div class="nuvolaargomenti">
     <?php include_partial('argument/correlatedTagsCloud', array('tags' => $correlated_tags)) ?>	
     <br />
     <br />
     <strong>Filtra per politico:</strong><br />
     <form id="filtrapolitico" name="filtrapolitico" method="post" action="">
     <label for="filtra">
	   
	   <?php echo select_tag('politicians', options_for_select($politicians, $politician_id ),
                                   array('onchange' => 'politicianFilter(this[this.selectedIndex].value, '.$tag_id.','.$total.')')
            ) ?>
	   
     </label>
     </form>
  </div>
  
  <div id="declaration_container">
    <?php include_component('polDeclarations', 'blockForArgumentPage', 
                            array('tag_id' => $tag_id, 'politician_id' => $politician_id,
                                  'sort'=>'last', 'limit'=> true, 'total'=> $total)) ?>
  </div>
</div>
<?php echo javascript_tag("function politicianFilter(politician_id, tag_id, total)
{
	
	 new Ajax.Updater('declaration_container', '/polDeclarations/blockForArgumentPage?politician_id='+politician_id+'&tag_id='+tag_id+'&sort=last&limit=false&total='+total, {asynchronous:true, evalScripts:false});	
     
}
") ?>