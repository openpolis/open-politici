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

function tags_for_theme($theme, $tag_id = 0, $max = 10)
{
  $tags = array();

  foreach ($theme->getTags() as $tag)
  {
    if($tag_id != $tag->getOpTag()->getId())
    {
        $tags[] = link_to($tag->getOpTag()->getTag(), 
                          '@tag?tag='.$tag->getOpTag()->getId());	  
	  }
    else
      $tags[] = $tag->getOpTag()->getTag();
  }
  return implode(', ', $tags);
}

function delete_tags_for_theme($theme, $tag_id, $max = 10)
{
  $tags = array();
 	$cont=0;
	
	foreach ($theme->getTags() as $tag)
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


function link_to_theme($theme)
{
  	return link_to($theme->getTitle(), '@theme?stripped_title='.$theme->getTitle());
}

function link_to_report_theme($theme, $user)
{
  	use_helper('Javascript');

  	$text = '&raquo; Segnala errori / abusi';
  	if ($user->isAuthenticated())
  	{
    	$has_already_reported_theme = OpReportPeer::retrieveByPk($theme->getContentId(), $user->getSubscriberId());
    	if ($has_already_reported_theme)
    	{
      		// already spam for this user
      		return '['.__('reported as spam').']';
    	}
    	else
    	{
      		echo link_to('&raquo; Segnala errori / abusi', 'politician/reportForm?content_id='.$theme->getContentId().'&user_id='.$user->getAttribute('subscriber_id', '', 'subscriber'), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it'));
    	}
  	}
  	else
  	{
    	return link_to_login($text);
  	}
}

function link_to_theme_comment($theme, $user)
{
	//$c=new Criteria();
	//$c->Add(OpCommentPeer::USER_ID,$user->getSubscriberId());
	//if($declaration->getOpOpinableContent()->getOpComments($c)):
  	//	return "<i>hai gia commentato!</i>";
	//else:
		return link_to ('Commenta','themes/index?declaration_id='.$theme->getContentId(), array('title'=>'', 'class'=>'orange', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it'));
	//endif;		 
}

?>