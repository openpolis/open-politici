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
use_helper('Global', 'User');
/*
function comment_pager_link($name, $comment, $page)
{
  return link_to($name, '@question?stripped_title='.$question->getStrippedTitle().'&page='.$page);
}
*/

function link_to_user_relevancy_up($user, $comment)
{
  return link_to_user_relevancy('up', $user, $comment);
}

function link_to_user_relevancy_down($user, $comment)
{
  return link_to_user_relevancy('down', $user, $comment);
}

function link_to_user_relevancy($name, $user, $comment)
{
  use_helper('Javascript');

  if ($user->hasCredential('subscriber'))
  {
	  $has_already_voted = OpRelevancyCommentPeer::retrieveByPk($user->getAttribute('subscriber_id', '', 'subscriber'), $comment->getId());
	
  	if ($has_already_voted || $comment->getUserId() == $user->getAttribute('subscriber_id', '', 'subscriber'))
  	{
  	  // already interested
  	  return  image_tag('/images/buttons/'.$name.'_voted.gif', array('alt'=>'Vota', 'width'=>'15', 'height'=>'14', 'border'=>'0'));
  	} else {
  	  // didn't declare interest yet
	  
  	  return link_to_remote(image_tag('/images/buttons/'.$name.'.gif', 
  	                        array('alt'=>'Vota', 'width'=>'15', 'height'=>'14', 'border'=>'0')), 
  	                        array('url'      => 'user/vote?id='.$comment->getId().'&score='.($name == 'up' ? 1 : -1),
                              		'update'   => array('success' => 'vote_'.$comment->getId()),
                              		'loading'  => "Element.show('indicator')",
                              		'complete' => "Element.hide('indicator');" . 
                              		               visual_effect('highlight', 'vote_'.$name.'_'.$comment->getId()) ));
  	}
  } else {
	  return link_to(image_tag('/images/buttons/'.$name.'.gif', 
	                           array('alt'=>'Vota', 'width'=>'15', 'height'=>'14', 'border'=>'0')), '@sf_guard_signin');
  }
}

/*
function link_to_report_answer($answer, $user)
{
  use_helper('Javascript');

  $text = '['.__('report to moderator').']';
  if ($user->isAuthenticated())
  {
	$has_already_reported_answer = ReportAnswerPeer::retrieveByPk($answer->getId(), $user->getSubscriberId());
	if ($has_already_reported_answer)
	{
	  // already spam for this user
	  return '['.__('reported as spam').']';
	}
	else
	{
	  return link_to_remote($text, array(
		'url'      => '@user_report_answer?id='.$answer->getId(),
		'update'   => array('success' => 'report_answer_'.$answer->getId()),
		'loading'  => "Element.show('indicator')",
		'complete' => "Element.hide('indicator');".visual_effect('highlight', 'report_answer_'.$answer->getId()),
	  ));
	}
  }
  else
  {
	return link_to_login($text);
  }
}
*/
?>