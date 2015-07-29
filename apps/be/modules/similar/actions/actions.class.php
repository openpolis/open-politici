<?php

/**
 * similar actions.
 *
 * @package    op_openpolis
 * @subpackage similar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class similarActions extends autosimilarActions
{
  public function executeSwitchCheck()
  {
    # partendo dall'id del record di log, recupero il record intero
    $id = $this->getRequestParameter('id');
    $op_similar_politician = OpSimilarPoliticianPeer::retrieveByPK($id);


    # switch
    $op_similar_politician->setIsResolved(!$op_similar_politician->getIsResolved());
    $op_similar_politician->setUserId($this->getUser()->getSubscriberId());
    $op_similar_politician->save();
    
    $this->op_similar_politician = $op_similar_politician;
    $this->id = $op_similar_politician->getId();
    
    $this->redirect('similar/list');    
  }

  public function executeKeepOriginal()
  {
    # partendo dall'id del record di log, recupero il record intero
    $id = $this->getRequestParameter('id');
    $op_similar_record = OpSimilarPoliticianPeer::retrieveByPK($id);

    $op_original = $op_similar_record->getOpPoliticianRelatedByOriginalId();
    $op_similar = $op_similar_record->getOpPoliticianRelatedBySimilarId();

    // trasferisce risorse e rimuove in modo transazionale
    $con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
    try {
    	$con->begin();
      OpPoliticianPeer::transferResources($op_similar, $op_original, $con);
      $op_similar->delete($con);      
    	$con->commit();
      $this->setFlash('notice', 'Operazione eseguita con successo.');
    } catch (PropelException $e) {
    	$con->rollback();
      $this->setFlash('error', $e);
    }

    $this->redirect('similar/list');
  }
  
  public function executeKeepSimilar()
  {
    # partendo dall'id del record di log, recupero il record intero
    $id = $this->getRequestParameter('id');
    $op_similar_record = OpSimilarPoliticianPeer::retrieveByPK($id);

    $op_original = $op_similar_record->getOpPoliticianRelatedByOriginalId();
    $op_similar = $op_similar_record->getOpPoliticianRelatedBySimilarId();

    // trasferisce risorse e rimuove in modo transazionale
    $con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
    try {
    	$con->begin();
      OpPoliticianPeer::transferResources($op_original, $op_similar, $con);
      $op_original->delete($con);
    	$con->commit();
      $this->setFlash('notice', 'Operazione eseguita con successo.');
    } catch (PropelException $e) {
    	$con->rollback();
      $this->setFlash('error', $e);
    }
    

    $this->redirect('similar/list');
  }
}
