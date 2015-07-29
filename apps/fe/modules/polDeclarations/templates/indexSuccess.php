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
<?php echo use_helper('Javascript', 'Content', 'User', 'Date', 'Text'	
	/* canonicals links */
	, 'HeaderLinks');

	if ( sfRouting::getInstance()->getCurrentRouteName() == 'dichiarazione' )
		add_link(
			'@dichiarazione_new?'. $declaration->getSlugUrl(),
			'canonical');
?>			
<!-- #################### INIZIO TITOLO ####################  -->
<div id="title">
  <h1>
    Dichiarazione di <?php echo link_to(
        ucwords(strtolower($declaration->getOpPolitician()->getFirstName())) . 
        " <span class=\"surname\">" . $declaration->getOpPolitician()->getLastName() . "</span>",
        '@politico_new?content_id=' . $declaration->getPoliticianId() .'&slug='. $declaration->getOpPolitician()->getSlug()
		)?>
    </h1>
    <?php $count=count(OpInstitutionChargePeer::getPoliticianChargeAtDate($declaration->getOpPolitician()->getContentId(),$declaration->getDate())) ?>
    <?php if( $count>0) : ?>
      <?php echo "<div>Alla data della dichiarazione: "?>
      <?php foreach (OpInstitutionChargePeer::getPoliticianChargeAtDate($declaration->getOpPolitician()->getContentId(),$declaration->getDate()) as $num => $institution_charge): ?>
        <?php echo Text::chargeDefinition($institution_charge, false) ?>
        <?php echo ($num<$count-1 ? '- ':'')?>
      <?php endforeach; ?>
      <?php echo "</div>"?>
      <?php echo "<br/>"?>
    <?php endif ?>  
      
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />

<?php echo include_partial('polDeclarations/declaration_block', 
                           array('declaration'=>$declaration, 'tag_id'=>0, 'all_information'=>true, 'twitter' => $twitter)) ?>


<!-- #################### INIZIO COMMENTI ####################  -->
<div class="genericblock">
  <div id="for_ajax">
    <?php include_component('opinableContent', 'blockForComments', array('content_id' => $declaration->getContentId(),
                                                                         'sort' => 'date')) ?>
  </div>
</div>
<hr />

