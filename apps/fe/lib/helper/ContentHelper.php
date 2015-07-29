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
/*
 * Created on 22-Aug-06
 * 
 * Library functions to report, tag, comment or declare interest
 * for content.
 *
 */
 
function link_to_report_content($content, $user)
{
  use_helper('Javascript');

  $text = '['.__('report to moderator').']';
  if ($user->isAuthenticated())
  {
    $has_already_reported_content = OpReportPeer::retrieveByPk($user->getSubscriberId(), $content->getContentId());
    if ($has_already_reported_content)
    {
      // already spam for this user
      return '['.__('reported as spam').']';
    }
    else
    {
      return link_to_remote($text, array(
        'url'      => '@user_report_content?id='.$content->getContentId(),
        'update'   => array('success' => 'report_content_'.$content->getContentId()),
        'loading'  => "Element.show('indicator')",
        'complete' => "Element.hide('indicator');".visual_effect('highlight', 'report_content_'.$content->getContentId()),
      ));
    }
  }
  else
  {
    return link_to_login($text);
  }
}

?>
