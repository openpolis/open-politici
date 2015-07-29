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
<?php use_helper('User', 'Text', 'Global', 'Themes', 'OpinableContent', 'Date', 'Javascript', 'Lightbox' ) ?>

<div id="title">

<h1>Posizioni sul tema: <i>"<?php echo $theme->getTitle() ?>"</i></h1></div>
<hr/>
<div class="genericblock">
	<div class="dichiarazione">
		<ul>
		  <li class="clearfix">
		    <span class="first">inserito il 
  		    <span class="date">
  		      <?php echo format_date($theme->getOpOpenContent()->getOpContent()->getCreatedAt(), 'dd MMMM yyyy') ?>
  		    </span> da 
		      <?php echo link_to($theme->getOpOpenContent()->getOpUser()->__toString(),
		                        '@user_profile?hash='.$theme->getOpOpenContent()->getOpUser()->getHash()); ?>
		    </span>
		     <!-- area tematica -->
        <?php if ($theme->getTags()): ?>
          <div id="tags_container_<?php echo $theme->getContentId() ?>">
            Area: <strong><?php echo $theme->getAreaTematica() ?></strong>
          </div>
        <?php endif; ?>
		<cite><?php echo $theme->getDescription() ?></cite><br />

        <!-- edit/oscura  -->
        <span class="interaction"> 
          <span class="abuse">
            <?php echo include_partial('themes/report_edit_obscure', 
                                       array('user' => $sf_user, 'theme' => $theme)); ?>
        </span> 

        <!-- voti e commenti -->
        <div class="question" id="declaration_<?php echo $theme->getContentId() ?>">
          <div id="block_<?php echo $theme->getContentId() ?>">
            <?php echo include_partial('opinableContent/interested_user', 
                                       array('content' => $theme,
                                             'mode' => 'show_votes',
                                             'label' => 'priorit&agrave;')) ?>
          </div>
        </div>

      </li>
    </ul>

    </div>
  </div>

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