<?php

/**
 * verifications actions.
 *
 * @package    op_openpolis
 * @subpackage verifications
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class verificationsActions extends autoverificationsActions
{


  public function addFiltersCriteria($c)
  {
    if (isset($this->filters['statuses']))
    {
      $statuses = $this->filters['statuses'];
      if (count($statuses))
      {
        foreach ($statuses as $status)
        {
          switch ($status)
          {
            case 'A':
              $crit = $c->getNewCriterion(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
              $crit->addAnd($c->getNewCriterion(OpOpenContentPeer::VERIFIED_AT, null, Criteria::ISNOTNULL)); 
              break;
            case 'R':
              $crit = $c->getNewCriterion(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNOTNULL);
              $crit->addAnd($c->getNewCriterion(OpOpenContentPeer::VERIFIED_AT, null, Criteria::ISNOTNULL)); 
              break;
            case '':
              $crit = $c->getNewCriterion(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
              $crit->addAnd($c->getNewCriterion(OpOpenContentPeer::VERIFIED_AT, null, Criteria::ISNULL)); 
              break;
          }
        }
        if (isset($crit)) $c->add($crit);
      }
    }
    
    if (isset($this->filters['statuses_is_empty']))
    {
      $statusesIsEmpty = $this->filters['statuses_is_empty'];
      unset($this->filters['statuses_is_empty']);
    }
    if (isset($this->filters['statuses']))
    {
      $statuses = $this->filters['statuses'];
      unset($this->filters['statuses']);
    }

    // Call the base class implementation to get the other filters
    $result = parent::addFiltersCriteria($c);

    // Restore the statuses filter
    if (isset($statusesIsEmpty))
    {
      $this->filters['statuses_is_empty'] = $statusesIsEmpty;
    }
    if (isset($statuses))
    {
      $this->filters['statuses'] = $statuses;
    }
    
  } 

  /**
   * se deleted_at not null, l'open_content deve essere restored 
   *  - eliminato il record in obscured_content
   *  - deleted_at va a null
   *  - verified_at va a now
   *  - aggiungere un record a verified_content
   *
   *
   * se deleted_at null e verified_at null
   *  - verified_at va a now
   *  - aggiungere record a verified_content
   *
   * se deleted_at null e verified_at not null (status == accepted)
   *  - notice (gialla) già accettato
   *
   * alla fine, viene ricaricata la pagina
   *
   * @return void
   * @author Guglielmo Celata
   */
  public function executeAccept()
  {
    // recupero contenuto da id
    $content_id = $this->getRequestParameter('content_id');
    $op_open_content = OpOpenContentPeer::retrieveByPK($content_id);
    $this->forward404unless($op_open_content instanceof OpOpenContent);
    
    $msg = $op_open_content->accept($this->getUser());
    $this->setFlash($msg['type'], $msg['message']);

    // aggiorna indice testuale solo se l'incarico è ripristinato
    if ($msg['operation'] == 'ripristinato') {
      $institution_charge = OpInstitutionChargePeer::retrieveByPK($content_id);
      $institution_charge->updatePoliticianSolrIndex();
    }

    $this->redirect('verifications/list');    
  }

  /**
   * se deleted_at not null (rejected)
   *  - notice (gialla) già rifiutato
   *
   * se deleted_at null, per qualsiasi verified_at (accepted or not verified)
   *  - verified_at va a now
   *  - aggiungere record a verified_content
   *  - deleted_at va a now
   *  - aggiungere record a obscured_content, con reason: oscurato da amministratori (verifica)
   *    dovrebbe essere possibile (javascript, motivare l'oscuramento)
   *
   * @return void
   * @author Guglielmo Celata
   */
  public function executeReject()
  {
    // recupero contenuto da id
    $content_id = $this->getRequestParameter('content_id');
    $op_open_content = OpOpenContentPeer::retrieveByPK($content_id);
    $this->forward404unless($op_open_content instanceof OpOpenContent);

    $msg = $op_open_content->reject($this->getUser());
    $this->setFlash($msg['type'], $msg['message']);

    // aggiorna indice testuale solo se l'incarico è rimosso
    if ($msg['operation'] == 'rifiutato') {
      $institution_charge = OpInstitutionChargePeer::retrieveByPK($content_id);
      $institution_charge->updatePoliticianSolrIndex();
    }
    
    $this->redirect('verifications/list');    
  }
  
  
  public function executeAcceptSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpOpenContentPeer::doAccept($this->selected_items_ids, $this->getUser());
      $this->setFlash('notice', 'Tutti gli inserimenti sono stati accettati.');
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('accept', 'Impossibile verificare questi inserimenti.');
      return $this->forward('verifications', 'list');
    }
    
    return $this->redirect('verifications/list');
  }


  public function executeRejectSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpOpenContentPeer::doReject($this->selected_items_ids, $this->getUser());
      $this->setFlash('notice', 'Tutti gli inserimenti sono stati respinti.');
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('accept', 'Impossibile verificare questi inserimenti.');
      return $this->forward('verifications', 'list');
    }
    
    return $this->redirect('verifications/list');
  }

}
