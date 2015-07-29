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
<?php

function tags_for_declaration($declaration, $tag_id = 0, $max = 10, $politician_id=0)
{
  $tags = array();

  foreach ($declaration->getTags() as $tag)
  {
    if($tag_id != $tag->getOpTag()->getId())
    {
      if ($politician_id==0)
	    $tags[] = link_to($tag->getOpTag()->getTag(), '@tag?tag='.$tag->getOpTag()->getId());
      else
        $tags[] = link_to($tag->getOpTag()->getTag(), '@tag_for_politician?tag='.$tag->getOpTag()->getId().'&politician_id='.$politician_id);	  
	}
    else
      $tags[] = $tag->getOpTag()->getTag();
  }
  return implode(', ', $tags);
}

function delete_tags_for_declaration($declaration, $tag_id, $max = 10)
{
  	$tags = array();
 	$cont=0;
	
	foreach ($declaration->getTags() as $tag)
	{
		if($tag_id != $tag->getOpTag()->getId())
		{
	   		$tags[] = $tag->getOpTag()->getTag().'&nbsp;'.checkbox_tag('tag_'.$cont, $tag->getOpTag()->getId(), false);
		}
		else
		{
			$tags[] = $tag->getOpTag()->getTag();
		}
		
		$cont++;
	}
	
	$tags[] = input_hidden_tag('cont', $cont);
  		
	return implode(' + ', $tags);
}


function link_to_declaration($declaration)
{
  	return link_to($declaration->getTitle(), 
			'@dichiarazione_new?'. $declaration->getSlugUrl()
			//'@declaration?stripped_title='.$declaration->getTitle()
			);
}

function link_to_report_declaration($declaration, $user)
{
  	use_helper('Javascript');

  	$text = '&raquo; Segnala errori / abusi';
  	if ($user->isAuthenticated())
  	{
    	$has_already_reported_declaration = OpReportPeer::retrieveByPk($declaration->getContentId(), $user->getSubscriberId());
    	if ($has_already_reported_declaration)
    	{
      		// already spam for this user
      		return '['.__('reported as spam').']';
    	}
    	else
    	{
      		echo link_to('&raquo; Segnala errori / abusi', 'politician/reportForm?content_id='.$declaration->getContentId().'&user_id='.$user->getAttribute('subscriber_id', '', 'subscriber').'&politician_id='.$declaration->getPoliticianId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it'));
		 	//include_partial('moderator/content_options', array('content' => $declaration->getOpOpinableContent()->getOpOpenContent()->getOpContent())); 
    	}
  	}
  	else
  	{
    	return link_to_login($text);
  	}
}

function link_to_declaration_comment($declaration, $user)
{
	//$c=new Criteria();
	//$c->Add(OpCommentPeer::USER_ID,$user->getSubscriberId());
	//if($declaration->getOpOpinableContent()->getOpComments($c)):
  	//	return "<i>hai gia commentato!</i>";
	//else:
		return link_to ('Commenta',
			//'polDeclarations/index?declaration_id='.$declaration->getContentId(), 
			'@dichiarazione_new?'. $declaration->getSlugUrl(),
			array('title'=>'', 'class'=>'orange', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it'));
	//endif;		 
}

?>