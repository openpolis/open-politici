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

use_helper('Javascript', 'Global');

function link_to_user_interested($user, $opin_content)
{
  $content_type = $opin_content->getOpOpenContent()->getOpContent()->getOpTable();
  switch ($content_type)
  {
    case 'op_declaration':
      $votato = "Hai votato questa dichiarazione";
      $interessante = "&Egrave; rilevante questa dichiarazione? ";
      $vota = "Votala!";
      break;
    case 'op_theme':
      $votato = "Hai votato questo tema";
      $interessante = "&Egrave; prioritario questo tema? ";
      $vota = "Votalo!";
      break;
  }
  if ($user->isAuthenticated())
  {
    $relevancy = OpRelevancyPeer::retrieveByPk($opin_content->getContentId(), $user->getSubscriberId());
    
	  if ($relevancy)
    {
      // already interested
      return $votato;
    }
    else
    {
      // didn't declare interest yet
      echo $interessante;
      return link_to_remote($vota, 
                            array('url'      => 'user/interested?id='.$opin_content->getContentId(),
                                  'update'   => 'block_'.$opin_content->getContentId(),
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator');" . 
                                  "visual_effect('pulsate', 'interested_content')"), 
                            array('class'    => 'orange',
                                  'title'    =>'',
                                  'hreflang' =>'it',
                                  'lang'     =>'it',
                                  'xml:lang' =>'it'));
    }
    
  } else {
    echo $interessante;
    return link_to($vota, '@sf_guard_signin', 
                   array('class' => 'orange', 'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang' =>'it'));
  }
}


function link_to_user_vote($user, $opin_content, $label)
{
  $content_type = $opin_content->getOpOpenContent()->getOpContent()->getOpTable();
  if ($user->isAuthenticated())
  {
    $relevancy = OpRelevancyPeer::retrieveByPk($opin_content->getContentId(), $user->getSubscriberId());
    
	  if ($relevancy)
    {
      // already interested
      $voti = format_number_choice('[0] nessun voto|[1] voto |(1,+Inf] voti', '', $opin_content->getRelevancyScore());
      return $content_type=='op_declaration'?$voti:'priorit&agrave;';
    }
    else
    {
      // didn't declare interest yet
      return link_to_remote($label, 
                            array('url'      => 'user/voteContent?id='.$opin_content->getContentId(),
                                  'update'   => 'vote_'.$opin_content->getContentId(),
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator');Effect.Pulsate('vote_" . $opin_content->getContentId() . "')"), 
                            array ('class'    => 'orange',
                                   'title'    =>'',
                                   'hreflang' =>'it',
                                   'lang'     =>'it',
                                   'xml:lang' =>'it'));
    }
    
  } else {
    return link_to($label, '@sf_guard_signin', 
                   array('class' => 'orange', 'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang' =>'it'));
  }
}
?>
