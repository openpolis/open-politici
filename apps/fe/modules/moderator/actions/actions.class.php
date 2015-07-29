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

/**
 * moderator actions.
 *
 * @package    openpolis
 * @subpackage moderator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class moderatorActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  }

  public function executeReportedContents()
  {
    $this->content_pager = OpContentPeer::getReportedSpamPager($this->getRequestParameter('page', 1));
  }
  
  public function executeResetContentReports()
  {
    $content = OpContentPeer::getContentFromHash($this->getRequestParameter('hash'));
    $this->forward404Unless($content);

    $content->deleteReports();
    $content->save();

    $this->redirect($this->getRequest()->getReferer());
  }
  
  public function executeUserReports()
  {
  	 $this->setLayout('noColumnLayout');
	   $this->reports = OpReportPeer::doSelect(new Criteria()); 
  }
  
  
  public function executeUserReportsForAdopter()
  {
    $this->setLayout('noColumnLayout');
    $this->reports = OpReportPeer::doSelectWithFilterForAdopter($this->getUser()->getSubscriberId());
    if ($this->hasRequestParameter('referer'))
      $this->referer = urldecode($this->getRequestParameter('referer'));
    else
      $this->referer = $this->getRequest()->getReferer();
  }
  
  public function executeUserCommentReports()
  {
  	 $this->comment_reports=OpCommentReportPeer::doSelect(new Criteria()); 
  
  }
  
  public function executeDeleteReport()
  {
  	$report_to_delete=OpReportPeer::RetrieveByPk($this->getRequestParameter('user_id'), $this->getRequestParameter('content_id'));
		$report_to_delete->delete();
		
    if ($this->hasRequestParameter('referer'))		
		  return $this->redirect($this->getRequest()->getReferer() . "?referer=" . $this->getRequestParameter('referer'));
		else
		  return $this->redirect($this->getRequest()->getReferer());
		
  }
  
  public function executeDeleteCommentReport()
  {
  		$report_to_delete=OpCommentReportPeer::RetrieveByPk($this->getRequestParameter('user_id'), $this->getRequestParameter('comment_id'));
		$report_to_delete->delete();
		
		return $this->redirect('moderator/userCommentReports');
  }
}

?>
