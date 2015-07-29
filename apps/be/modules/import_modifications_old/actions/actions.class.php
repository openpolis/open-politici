<?php

/**
 * import_modifications actions.
 *
 * @package    op_openpolis
 * @subpackage import_modifications
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class import_modifications_oldActions extends autoimport_modifications_oldActions
{
  public function addFiltersCriteria($c)
  {
    $c->add(OpImportModificationsPeer::REC_TYPE, 'old');
    
    if (isset($this->filters['statuses']))
    {
      $statuses = $this->filters['statuses'];
      unset($this->filters['statuses']);

      switch ($statuses[0])
      {
        case 'W':
          $c->add(OpImportModificationsPeer::BLOCKED_AT, null, Criteria::ISNULL);
          $c->add(OpImportModificationsPeer::CONCRETISED_AT, null, Criteria::ISNULL);
          break;
        case 'C':
          $c->add(OpImportModificationsPeer::CONCRETISED_AT, null, Criteria::ISNOTNULL);
          break;
        case 'B':
          $c->add(OpImportModificationsPeer::BLOCKED_AT, null, Criteria::ISNOTNULL);
          $c->add(OpImportModificationsPeer::CONCRETISED_AT, null, Criteria::ISNULL);
          break;
        case '':
          break;
      }

    }
    
    if (isset($this->filters['import']))
    {
      $import = $this->filters['import'];
      unset($this->filters['import']);
      if ($import != '')
        $c->add(OpImportModificationsPeer::IMPORT_ID, $import);
    }
    
    if (isset($this->filters['context']))
    {
      $context = $this->filters['context'];
      unset($this->filters['context']);
      if ($context != '')
        $c->add(OpImportModificationsPeer::CONTEXT, $context);
    }

    if (isset($this->filters['location_id']))
    {
      $location_id = $this->filters['location_id'];
      unset($this->filters['location_id']);
      if ($location_id != 0)
        $c->add(OpImportModificationsPeer::LOCATION_ID, $location_id);
    }

    // Call the base class implementation to get the other filters
    $result = parent::addFiltersCriteria($c);

    // Restore the categories filter
    if (isset($import))
    {
      $this->filters['import'] = $import;
    }
    
    if (isset($context))
    {
      $this->filters['context'] = $context;
    }

    if (isset($location_id))
    {
      $this->filters['location_id'] = $location_id;
    }

    if (isset($statuses))
    {
      $this->filters['statuses'] = $statuses;
    }

  } 
  
  /**
   * se deleted_at not null (rejected)
   *  - notice (gialla) già rifiutato
   *
   * se deleted_at null
   *  - deleted_at va a now
   *
   * @return void
   * @author Guglielmo Celata
   */
  public function executeReject()
  {
    // recupero contenuto da id
    $id = $this->getRequestParameter('id');
    $op_import_modification = OpImportModificationsPeer::retrieveByPK($id);
    $this->forward404unless($op_import_modification instanceof OpImportModifications);

    $msg = $op_import_modification->reject($this->getUser());
    $this->setFlash($msg['type'], $msg['message']);

    $this->redirect('import_modifications_old/list');    
  }

  public function executeRejectSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpImportModificationsPeer::doReject($this->selected_items_ids, $this->getUser());
      $this->setFlash('notice', sprintf('%d item respinto/i', count($this->selected_items_ids)));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Impossibile respingere questi item.');
      return $this->forward('import_modifications_old', 'list');
    }
    
    return $this->redirect('import_modifications_old/list');
  }

  public function executeRestore()
  {
    // recupero contenuto da id
    $id = $this->getRequestParameter('id');
    $op_import_modification = OpImportModificationsPeer::retrieveByPK($id);
    $this->forward404unless($op_import_modification instanceof OpImportModifications);

    $msg = $op_import_modification->restore();
    $this->setFlash($msg['type'], $msg['message']);

    $this->redirect('import_modifications_old/list');    
  }

  public function executeRestoreSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpImportModificationsPeer::doRestore($this->selected_items_ids);
      $this->setFlash('notice', sprintf('%d item ripristinato/i', count($this->selected_items_ids)));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('restore', 'Impossibile ripristinare questi item.');
      return $this->forward('import_modifications_old', 'list');
    }
    
    return $this->redirect('import_modifications_old/list');
  }


  public function executeConcretise()
  {
    // recupero contenuto da id
    $id = $this->getRequestParameter('id');
    $op_import_modification = OpImportModificationsPeer::retrieveByPK($id);
    $this->forward404unless($op_import_modification instanceof OpImportModifications);

    $msg = $op_import_modification->concretise();
    $this->setFlash($msg['type'], $msg['message']);

    $this->redirect('import_modifications_old/list');    
  }

  public function executeConcretiseSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpImportModificationsPeer::doConcretise($this->selected_items_ids);
      $this->setFlash('notice', sprintf('%d item chiuso/i nel DB', count($this->selected_items_ids)));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('restore', 'Impossibile chiudere questi incarichi nel DB.');
      return $this->forward('import_modifications_new', 'list');
    }
    
    $this->redirect('import_modifications_old/list');    
  }
  
  public function executeConcretiseAll()
  {
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/op_import_modifications/filters');
    $c = new Criteria();
    
    // only non-blocked elements can be concretised
    $c->add(OpImportModificationsPeer::BLOCKED_AT, null, Criteria::ISNULL);

    $this->addFiltersCriteria($c);

    $recs = OpImportModificationsPeer::doSelect($c);
    
    try {
      foreach ($recs as $rec) {
        $rec->concretise();
      }
      $this->setFlash('notice', sprintf('%d item chiuso/i nel DB', count($recs)));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('restore', 'Impossibile chiudere questi incarichi nel DB.');
      return $this->forward('import_modifications_old', 'list');
    }
  }
  
}
