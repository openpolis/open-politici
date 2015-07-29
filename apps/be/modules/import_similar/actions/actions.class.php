<?php

/**
 * import_similar actions.
 *
 * @package    op_openpolis
 * @subpackage import_similar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class import_similarActions extends autoimport_similarActions
{
  
  public function addFiltersCriteria($c)
  {
    if (isset($this->filters['statuses']))
    {
      $statuses = $this->filters['statuses'];
      unset($this->filters['statuses']);

      switch ($statuses[0])
      {
        case 'A':
          $c->add(OpImportSimilarPeer::DELETED_AT, null, Criteria::ISNULL);
          break;
        case 'R':
          $c->add(OpImportSimilarPeer::DELETED_AT, null, Criteria::ISNOTNULL);
          break;
        case '':
          break;
      }
    }
    
    if (isset($this->filters['context']))
    {
      $context = $this->filters['context'];
      unset($this->filters['context']);
      if ($context != '')
        $c->add(OpImportSimilarPeer::CONTEXT, $context);
    }

    if (isset($this->filters['location_id']))
    {
      $location_id = $this->filters['location_id'];
      unset($this->filters['location_id']);
      if ($location_id != 0)
        $c->add(OpImportSimilarPeer::LOCATION_ID, $location_id);
    }
    
    if (isset($this->filters['n_diffs']))
    {
      $n_diffs = $this->filters['n_diffs'];
      unset($this->filters['n_diffs']);
      if ($n_diffs != 0)
        $c->add(OpImportSimilarPeer::N_DIFFS, $n_diffs);
    }


    if (isset($this->filters['charges_differ']))
    {
      $charges_differ = $this->filters['charges_differ'];
      unset($this->filters['charges_differ']);
      if ($charges_differ != '')
        $c->add(OpImportSimilarPeer::CHARGES_DIFFER, $charges_differ);
    }
    if (isset($this->filters['names_differ']))
    {
      $names_differ = $this->filters['names_differ'];
      unset($this->filters['names_differ']);
      if ($names_differ != '')
        $c->add(OpImportSimilarPeer::NAMES_DIFFER, $names_differ);
    }
    if (isset($this->filters['birth_dates_differ']))
    {
      $birth_dates_differ = $this->filters['birth_dates_differ'];
      unset($this->filters['birth_dates_differ']);
      if ($birth_dates_differ != '')
        $c->add(OpImportSimilarPeer::BIRTH_DATES_DIFFER, $birth_dates_differ);
    }
    if (isset($this->filters['birth_places_differ']))
    {
      $birth_places_differ = $this->filters['birth_places_differ'];
      unset($this->filters['birth_places_differ']);
      if ($birth_places_differ != '')
        $c->add(OpImportSimilarPeer::BIRTH_PLACES_DIFFER, $birth_places_differ);
    }
    


    // Call the base class implementation to get the other filters
    $result = parent::addFiltersCriteria($c);

    // Restore the categories filter
    if (isset($context))
      $this->filters['context'] = $context;

    if (isset($location_id))
      $this->filters['location_id'] = $location_id;

    if (isset($statuses))
      $this->filters['statuses'] = $statuses;
    
    if (isset($n_diffs))
      $this->filters['n_diffs'] = $n_diffs;
    
    if (isset($charges_differ))
      $this->filters['charges_differ'] = $charges_differ;
    if (isset($names_differ))
      $this->filters['names_differ'] = $names_differ;
    if (isset($birth_dates_differ))
      $this->filters['birth_dates_differ'] = $birth_dates_differ;
    if (isset($birth_places_differ))
      $this->filters['birth_places_differ'] = $birth_places_differ;


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
    $op_import_similar = OpImportSimilarPeer::retrieveByPK($id);
    $this->forward404unless($op_import_similar instanceof OpImportSimilar);

    $msg = $op_import_similar->reject($this->getUser());
    $msg_type = $msg['type'];
    $msg_message = $msg['message'];

    list($res_old, $res_new) = $this->launchScripts($op_import_similar->getContext(), $op_import_similar->getLocationId());
    if (trim($res_old) != '' || trim($res_new) != '')
    {
      $msg_type = 'warning';
      $msg_message .= "<br/>Errore negli script python" ."<br/> old: $res_old<br/> new: $res_new";
    }
    
    $this->setFlash($msg_type, $msg_message);
    $this->redirect('import_similar/list');    
  }

  public function executeRejectSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    try
    {
      OpImportSimilarPeer::doReject($this->selected_items_ids, $this->getUser());
      $this->setFlash('notice', 'Tutti gli item sono stati respinti.');
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Impossibile respingere questi item.');
      return $this->forward('import_similar', 'list');
    }

    $locations = OpImportSimilarPeer::getLocationsFromIds($this->selected_items_ids);
    if (count($locations) <= 10) {
      foreach ($locations as $context => $location_ids) {
        foreach ($location_ids as $location_id) {
          $this->launchScripts($context, $location_id);
        }
      }
    } else {
      foreach (array_keys($locations) as $context) {
        $this->launchScripts($context);
      }
    }

    return $this->redirect('import_similar/list');
  }

  public function executeRestore()
  {
    // recupero contenuto da id
    $id = $this->getRequestParameter('id');
    $op_import_similar = OpImportSimilarPeer::retrieveByPK($id);
    $this->forward404unless($op_import_similar instanceof OpImportSimilar);

    $msg = $op_import_similar->restore();
    $msg_type = $msg['type'];
    $msg_message = $msg['message'];

    list($res_old, $res_new) = $this->launchScripts($op_import_similar->getContext(), $op_import_similar->getLocationId());
    if (trim($res_old) != '' || trim($res_new) != '')
    {
      $msg_type = 'warning';
      $msg_message .= "<br/>Errore negli script python" ."<br/> old: $res_old<br/> new: $res_new";
    }

    $this->setFlash($msg_type, $msg_message);
    $this->redirect('import_similar/list');    
  }

  public function executeRestoreSelection()
  {
    $this->selected_items_ids = $this->getRequestParameter('sf_admin_batch_selection', array());
    
    try
    {
      OpImportSimilarPeer::doRestore($this->selected_items_ids);
      $this->setFlash('notice', 'Tutti gli item sono stati ripristinati.');
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('restore', 'Impossibile ripristinare questi item.');
      return $this->forward('import_similar', 'list');
    }
    
    $locations = OpImportSimilarPeer::getLocationsFromIds($this->selected_items_ids);
    if (count($locations) <= 10) {
      foreach ($locations as $context => $location_ids) {
        foreach ($location_ids as $location_id) {
          $this->launchScripts($context, $location_id);
        }
      }
    } else {
      foreach (array_keys($locations) as $context) {
        $this->launchScripts($context);
      }
    }
    
    return $this->redirect('import_similar/list');
  }


  /**
   * launches python scripts to compute modifications anew for given context and, optionally, location
   *
   * @param string $context
   * @param string $location_id 
   * @return array containing the output for old and new computation scripts
   * @author Guglielmo Celata
   */
  protected function launchScripts($context, $location_id = null)
  {
    // lancio script python per il computo delle modifiche
    $pyscript = SF_ROOT_DIR.DIRECTORY_SEPARATOR.'batch'.DIRECTORY_SEPARATOR.'import_minint_v2'.
                            DIRECTORY_SEPARATOR.'import_compute_modifications.py';
    $date = OpImportMinintPeer::getLastImportDate('Ymd');
    $data_path = sfConfig::get('sf_op_data_path', '/home/op/op_data');
    
    $python_executable = sfConfig::get('sf_python_executable', 'python');
    $pycommand = "$python_executable $pyscript --context=$context --date=$date --data-path=$data_path";
    
    if (!is_null($location_id))
    {
      $res = shell_exec("$pycommand --location-id=$location_id --rec-type=old --quiet 2>&1");
      sfContext::getInstance()->getLogger()->info("{scripts} $pycommand --location-id=$location_id --rec-type=old");
      $res = shell_exec("$pycommand --location-id=$location_id --rec-type=new --quiet 2>&1");
      sfContext::getInstance()->getLogger()->info("{scripts} $pycommand --location-id=$location_id --rec-type=new");
    } else {
      $res = shell_exec("$pycommand --rec-type=old --quiet 2>&1");
      sfContext::getInstance()->getLogger()->info("{scripts} $pycommand --rec-type=old");
      $res = shell_exec("$pycommand --rec-type=new --quiet 2>&1");
      sfContext::getInstance()->getLogger()->info("{scripts} $pycommand --rec-type=old");
    }
    
  }
  
  

  
}
