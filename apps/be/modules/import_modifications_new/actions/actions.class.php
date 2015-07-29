<?php

/**
 * import_modifications actions.
 *
 * @package    op_openpolis
 * @subpackage import_modifications
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class import_modifications_newActions extends autoimport_modifications_newActions
{
  public function addFiltersCriteria($c)
  {
    $c->add(OpImportModificationsPeer::REC_TYPE, 'new');
    
    if (isset($this->filters['statuses']))
    {
      $statuses = $this->filters['statuses'];
      unset($this->filters['statuses']);

      switch ($statuses[0])
      {
        case 'S':
          $c->add(OpImportModificationsPeer::ACTION_TYPE, sprintf("%s%%", OpImportModificationsPeer::HAS_SIMILAR_POLITICIANS), Criteria::LIKE);
          $c->add(OpImportModificationsPeer::CONCRETISED_AT, null, Criteria::ISNULL);
          break;
        case 'W':
          $c->add(OpImportModificationsPeer::ACTION_TYPE, 
                  array(OpImportModificationsPeer::CHARGE_ONLY,
                        OpImportModificationsPeer::CHARGE_BY_MININT_AKA,
                        OpImportModificationsPeer::POLITICIAN_AND_CHARGE), Criteria::IN);
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

    $this->redirect('import_modifications_new');    
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
      return $this->forward('import_modifications_new', 'list');
    }
    
    $this->redirect('import_modifications_new');    
  }

  public function executeRestore()
  {
    // recupero contenuto da id
    $id = $this->getRequestParameter('id');
    $op_import_modification = OpImportModificationsPeer::retrieveByPK($id);
    $this->forward404unless($op_import_modification instanceof OpImportModifications);

    $msg = $op_import_modification->restore();
    $this->setFlash($msg['type'], $msg['message']);

    $this->redirect('import_modifications_new');    
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
      return $this->forward('import_modifications_new', 'list');
    }
    
    $this->redirect('import_modifications_new');    
  }


  
  public function executeConcretise()
  {
    // recupero contenuto da id
    $id = $this->getRequestParameter('id');
    $op_import_modification = OpImportModificationsPeer::retrieveByPK($id);
    $this->forward404unless($op_import_modification instanceof OpImportModifications);

    $msg = $op_import_modification->concretise();
    $this->setFlash($msg['type'], $msg['message']);

    $this->redirect('import_modifications_new');    
  }

  public function executeConcretiseSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpImportModificationsPeer::doConcretise($this->selected_items_ids);
      $this->setFlash('notice', sprintf('%d item aggiunto/i al DB', count($this->selected_items_ids)));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('restore', 'Impossibile aggiungere alcuni di questi item al DB.');
      return $this->forward('import_modifications_new', 'list');
    }
    
    $this->redirect('import_modifications_new');    
  }
  
  public function executeConcretiseAll()
  {
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/op_import_modifications/filters');
    $c = new Criteria();
    
    // only non-blocked, non-similar elements can be concretised
    $c->add(OpImportModificationsPeer::BLOCKED_AT, null, Criteria::ISNULL);
    $c->add(OpImportModificationsPeer::ACTION_TYPE, sprintf("%s%%", OpImportModificationsPeer::HAS_SIMILAR_POLITICIANS), Criteria::NOT_LIKE);

    $this->addFiltersCriteria($c);

    $recs = OpImportModificationsPeer::doSelect($c);
    
    try {
      foreach ($recs as $rec) {
        $rec->concretise();
      }
      $this->setFlash('notice', sprintf('%d item aggiunto/i al DB', count($recs)));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('restore', 'Impossibile aggiungere alcuni di questi item al DB.');
      return $this->forward('import_modifications_new', 'list');
    }
    $this->redirect('import_modifications_new');    
    
  }
  
  public function executeGetSimilars()
  {
    $id = $this->getRequestParameter('id');
    $rec = OpImportModificationsPeer::retrieveByPK($id);
    $this->forward404unless($rec instanceof OpImportModifications);

    $context = $rec->getContext();
    $this->csv_rec = $rec->getCsvRec();
    $this->import_modifications_id = $rec->getId();
    $v = OpImportModificationsPeer::getHashFromReducedCSV($context, $this->csv_rec);

    $ps = OpPoliticianPeer::getSimilarPoliticians($v['first_name'], $v['last_name'], $v['birth_date']);
    usort($ps, array('OpPolitician', 'compareSimilar'));
    $this->ps = $ps;

    $isAjax = $this->getRequest()->isXmlHttpRequest();
    if (!$isAjax)
      $this->redirect('import_modifications_new');    
    else
      return 'Ajax';
  }
  
  public function executeResolveSimilarity()
  {
    $modification_id = $this->getRequestParameter('modification_id');
    $modification = OpImportModificationsPeer::retrieveByPK($modification_id);
    $this->forward404unless($modification instanceof OpImportModifications);

    $similar_id = $this->getRequestParameter('similar_id', 0);
    $similar_politician = OpPoliticianPeer::retrieveByPK($similar_id);
    $this->forward404unless($similar_id == 0 || $similar_politician instanceof OpPolitician);
    
    if ($similar_id == 0) {
      // caso in cui il record CSV non corrisponde a nessuno dei politici simili
      $modification->setActionType(OpImportModificationsPeer::POLITICIAN_AND_CHARGE);
      $modification->save();
      $code = 'PI';
    } else {
      // caso in cui si è trovato un politico 
      $modification->setActionType(OpImportModificationsPeer::CHARGE_BY_MININT_AKA);
      $modification->save();      
      
      // get values from processed (minint) csv
      $v = OpImportModificationsPeer::getHashFromReducedCSV($modification->getContext(), $modification->getCsvRec());

      // define minint_aka string, based on values extracted from csv
      $minint_aka = sprintf("%s+%s", $v['first_name'], $v['last_name']);
      if ($v['birth_date'] != '')
        $minint_aka .= "+" . date('Y/m/d', strtotime($v['birth_date']));
      
      $similar_politician->setMinintAka($minint_aka);
      $similar_politician->save();
      
      $code = 'IA';
      

      //
      // verifica blocco dovuto a cariche overlapping
      //
      $res = OpInstitutionChargePeer::isChargeToImportOverlapping($v, $modification->getContext(), $similar_politician);
      $overlap_status = $res['status'];
      $start = $res['existing_start_date'];
      $end = $res['existing_end_date'];

      // if similar politician has a current or overlapping charge, then block it
      if ($overlap_status == OpInstitutionChargePeer::OVERLAP_EXISTING_AND_OVERLAPPING || 
          $overlap_status == OpInstitutionChargePeer::OVERLAP_EXISTING_CURRENT)
      {
        $modification->reject($this->getUser());
        $code = 'IB';
      }
      
      
    }
    
    
    // ritorno codice (redirect per richieste non ajax)
    $isAjax = $this->getRequest()->isXmlHttpRequest();
    if (!$isAjax){
      // $this->redirect('list');          
    }
    else
    {
      $this->setLayout(false);    
      $this->response->setContentType('text/plain');
      $this->response->setContent($code);    
      return sfView::NONE;  
    }
    
  }
  

  
}
