<?php

/**
 * import_log actions.
 *
 * @package    openpolis
 * @subpackage import_log
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class import_logActions extends autoimport_logActions
{
  public function executeBack()
  {
    $this->redirect('import');
  }
  
  public function executeSwitchCheck()
  {
    # partendo dall'id del record di log, recupero il record intero
    $import_log_id = $this->getRequestParameter('id');
    $op_import_log = OpImportLogPeer::retrieveByPK($import_log_id);

    # recupero del file di import, del counter e dell'utente attualmente loggato
    $import_file = $op_import_log->getOpImport()->getImportFile();
    $import_log_counter = $op_import_log->getCounter();
    $user = $this->getUser()->getSubscriber();

    # switch
    $op_import_user_check = OpImportUserCheckPeer::retrieveByPk( $import_file, $import_log_counter );
    if ($op_import_user_check instanceof OpImportUserCheck)
    {
      $op_import_user_check->delete();
      $op_import_user_check = null;
      $this->user_check = null;
    }
    else
    {
      $op_import_user_check = new OpImportUserCheck();
      $op_import_user_check->setImportFile($import_file);
      $op_import_user_check->setImportLogCounter($import_log_counter);
      $op_import_user_check->setOpUser($user);
      $op_import_user_check->save();
      $this->user_check = $op_import_user_check;
    }
    
    $this->log_counter = $import_log_counter;
    $this->log_id = $import_log_id;
    $isAjax = $this->getRequest()->isXmlHttpRequest();
    if (!$isAjax)
      $this->redirect('import_log/list');    
    else
      return 'Ajax';
  }


  public function executeInsertMinintAka()
  {
    # partendo dall'id del record di log, recupero il record intero
    $log_counter = $this->getRequestParameter('log_counter');
    $pol_id = $this->getRequestParameter('pol_id');
    $aka = $this->getRequestParameter('aka');
    $file = $this->getRequestParameter('file');
    
    $pol = OpPoliticianPeer::retrieveByPK($pol_id);
    $user = $this->getUser()->getSubscriber();

    # recupero del file di import, del counter e dell'utente attualmente loggato
    $pol->setMinintAka($aka);
    $pol->save();

    # set status to 'checked' (if not already checked)
    $op_import_user_check = OpImportUserCheckPeer::retrieveByPk( $file, $log_counter );
    if (!$op_import_user_check instanceof OpImportUserCheck)
    {
      $op_import_user_check = new OpImportUserCheck();
      $op_import_user_check->setImportFile($file);
      $op_import_user_check->setImportLogCounter($log_counter);
      $op_import_user_check->setOpUser($user);
      $op_import_user_check->save();
      $this->user_check = $op_import_user_check;
    }
    
    $this->log_counter = $log_counter;
    $isAjax = $this->getRequest()->isXmlHttpRequest();
    if (!$isAjax)
      $this->redirect('import_log/list');    
    else
      return 'Ajax';
  }
  
  protected function addFiltersCriteria($c)
  {
    
    if (isset($this->filters['type']) && $this->filters['type'] !== '')
    {
      if($this->filters['type'] == 'warnings')
      {
        $criterion = $c->getNewCriterion(OpImportLogPeer::STATUS, '%S', Criteria::LIKE);
        $criterion->addOr($c->getNewCriterion(OpImportLogPeer::STATUS, '%DS', Criteria::LIKE));
      }
      if($this->filters['type'] == 'errors')
      {
        $criterion = $c->getNewCriterion(OpImportLogPeer::STATUS, array('SA', 'SD', 'SL', 'SNO', 'SPD'), Criteria::IN);
      }
      $c->add($criterion);
    }
    
    if (isset($this->filters['importing_data_is_empty']))
    {
      $criterion = $c->getNewCriterion(OpImportLogPeer::IMPORTING_DATA, '');
      $criterion->addOr($c->getNewCriterion(OpImportLogPeer::IMPORTING_DATA, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['importing_data']) && $this->filters['importing_data'] !== '')
    {
      $c->add(OpImportLogPeer::IMPORTING_DATA, strtr($this->filters['importing_data'], '*', '%'), Criteria::LIKE);
    }
    
    
    if (isset($this->filters['status_is_empty']))
    {
      $criterion = $c->getNewCriterion(OpImportLogPeer::STATUS, '');
      $criterion->addOr($c->getNewCriterion(OpImportLogPeer::STATUS, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['status']) && $this->filters['status'] !== '')
    {
      $c->add(OpImportLogPeer::STATUS, strtr($this->filters['status'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['message_is_empty']))
    {
      $criterion = $c->getNewCriterion(OpImportLogPeer::MESSAGE, '');
      $criterion->addOr($c->getNewCriterion(OpImportLogPeer::MESSAGE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['message']) && $this->filters['message'] !== '')
    {
      $c->add(OpImportLogPeer::MESSAGE, strtr($this->filters['message'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['import_id_is_empty']))
    {
      $criterion = $c->getNewCriterion(OpImportLogPeer::IMPORT_ID, '');
      $criterion->addOr($c->getNewCriterion(OpImportLogPeer::IMPORT_ID, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['import_id']) && $this->filters['import_id'] !== '')
    {
      $c->add(OpImportLogPeer::IMPORT_ID, $this->filters['import_id']);
    }
  }
  
}
