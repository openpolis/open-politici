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
<?php use_helper('User', 'Text', 'Global', 'OpinableContent', 'Declaration', 'Date', 'Javascript', 'Lightbox' ) ?>

<div class="genericblock">

	<div class="header">
  		<span class="rights-elements">&nbsp;</span><h2><?php echo $declaration->getTitle() ?></h2>
	</div>

  <!-- blocco dichiarazione  -->
	<div class="dichiarazione">
		<ul><li>
		<span class="first"> <span class="date">(<?php echo format_date($declaration->getDate(), 'dd MMMM yyyy') ?>)</span> - fonte: <span class="fonte"><?php echo $declaration->getSourceName() ?></span> - inserita il <span class="date"><?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getCreatedAt(), 'dd MMMM yyyy') ?></span> da <?php echo link_to($declaration->getOpOpenContent()->getOpUser()->__toString(), '@user_profile?hash='.$declaration->getOpOpenContent()->getOpUser()->getHash()); ?></span>
		<?php if (($updater = $declaration->getOpOpenContent()->getOpUpdater()) && $sf_user->hasCredential('administrator')): ?>
      <span style="color: gray; font-weight: normal; font-size: 11px">ultima modifica di
      <?php if ($updater->getId() != 1): ?>  
        <?php echo link_to($updater, '@user_profile?hash='.$updater->getHash()) ?>
      <?php else: ?>
        admin
      <?php endif ?>
      il
      <?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getUpdatedAt(), "dd/MM/yyyy");?></span>
    <?php endif ?>
		<br />
			<cite><?php echo $declaration->getText() ?></cite><br />
			<span class="fontelink">Fonte: 
        <strong>
          <span class="fonte"><?php echo $declaration->getSourceName() ?></span> | 
            <?php echo include_partial('polDeclarations/sourceUrlManaging', array('declaration'=>$declaration)); ?>
            <?php if($declaration->getSourceMime() && !strstr($declaration->getSourceMime(),'program')): ?>
              <?php  echo " | ". link_to('scarica l\'allegato','polDeclarations/attachment?declaration_id='.$declaration->getContentId()); ?>
            <?php endif; ?>
        </strong>
      </span>
            
      <!-- argomenti -->
      <div id="tags_container_<?php echo $declaration->getContentId() ?>">
        <?php echo include_partial('opinableContent/tags_managing', 
                                   array('content' => $declaration, 'mode' => 'edit')) ?>
      </div>
            
      <!-- segnala/oscura  -->
      <span class="interaction"> 
        <span class="abuse">
          <?php echo include_partial('polDeclarations/report_edit_obscure', 
                                     array('user' => $sf_user, 'content' => $declaration)); ?>
        </span> 
      
        <!-- voti e commenti -->
        <div class="question" id="declaration_<?php echo $declaration->getContentId() ?>">
          <div id="block_<?php echo $declaration->getContentId() ?>">
            <?php echo include_partial('opinableContent/interested_user', 
                                       array('content' => $declaration,
                                             'label' => format_number_choice('[0] nessun voto|[1] voto |(1,+Inf] voti', '', $declaration->getRelevancyScore()))) ?>
          </div>
        </div>
      </span>
      <div style="margin-top:5px;">
        <!-- bottone facebook -->
        <span style="vertical-align:middle;"><i>Pubblica su:</i> <a name="fb_share" type="icon" href="http://www.facebook.com/sharer.php"></a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></span>
        <!-- bottone twitter -->
        <a href="http://twitter.com/home?status=<?php echo $twitter ?>"><img src="/images/twitter-op.png" alt="share on twitter" style="float:none; vertical-align:middle;"></a>
      </div>
        
      </li>
    </ul>

 </div>
</div>

<hr />
<div class="orisep">&nbsp;</div>

<script type="text/javascript">
//<![CDATA[
function toggleDelTagDiv(content_id)
{
  div = 'del_tags_for_'+content_id;	
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