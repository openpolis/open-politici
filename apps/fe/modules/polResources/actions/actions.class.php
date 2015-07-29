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
* polResources actions.
*
* @package    openpolis
* @subpackage polResources
* @author     Gianluca Canale
* @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
*/
class polResourcesActions extends sfActions
{
	/**************************************/
	protected function getResourceOrCreate($content_id = 'content_id')
	{
		if (!$this->getRequestParameter('content_id', 0))
		{
			$resource = new OpResources();
		}
		else
		{
			$resource = OpResourcesPeer::retrieveByPk($this->getRequestParameter($content_id));
		
			$this->forward404Unless($resource);
		}
		
		return $resource;
	}
	
	/**************************************/
	public function executeCreate()
	{
		$politician_id = $this->getRequestParameter('politician_id');
		$this->forward404Unless($politician_id);
		return $this->redirect('polResources/edit?politician_id='.$politician_id);
	}
	
	/**************************************/
	public function executeEdit()
	{
		$this->resource = $this->getResourceOrCreate();
		
		if($this->getRequestParameter('politician_id'))
		{
			$this->politician_id = $this->getRequestParameter('politician_id');
		}
		else
		{
			$this->politician_id = $this->resource->getOpPolitician()->getContentId();
		}
		$this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
		
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
			$this->updateResourceFromRequest();
		
			$this->saveResource($this->resource);
		
			return $this->redirect('politician/page?content_id='.$this->resource->getPoliticianId());
		}
	}
	
	/**************************************/
	public function handleErrorEdit()
	{
		$this->politician_id = $this->getRequestParameter('politician_id');
		$this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
		$this->resource = $this->getResourceOrCreate();
		$this->updateResourceFromRequest();
		
		return sfView::SUCCESS;
	}
	
	/**************************************/
	protected function updateResourceFromRequest()
	{
		$resource = $this->getRequestParameter('resource');
	
		if ($this->getRequestParameter('politician_id'))
		{
			$this->resource->setPoliticianId($this->getRequestParameter('politician_id'));
		}
		
		if (isset($resource['resources_type_id']))
		{
			$this->resource->setResourcesTypeId($resource['resources_type_id']);
		}
		
		if (isset($resource['valore']))
		{
			$this->resource->setValore($resource['valore']);
		}
		
		if (isset($resource['descrizione']))
		{
			$this->resource->setDescrizione($resource['descrizione']);
		}
	
	}
	
	/**************************************/
	protected function saveResource($resource)
	{
		$resource->save();
	}	
	
	/**************************************/
    public function executeObscuration()
    {
      $this->resource_id = $this->getRequestParameter('resource_id');
  
    }
	
	/**************************************/
	public function executeDelete()
	{
		$this->hasLayout = $this->getRequestParameter('has_layout');
		$resource = OpResourcesPeer::retrieveByPk($this->getRequestParameter('content_id'));
		$this->forward404Unless($resource);
		
		$this->op_politician_id = $resource->getPoliticianId();
		
		//settaggio del campo deleted at di open content
		$open_content=OpOpenContentPeer::RetrieveByPk($this->getRequestParameter('content_id'));
		$open_content->setDeletedAt(time());
		$open_content->save();
		
		//inserimento nella tabella obscured content
		$obscured_content = new OpObscuredContent();
		$obscured_content->setUserId($this->getRequestParameter('user_id'));
		$obscured_content->setContentId($this->getRequestParameter('content_id'));
		$obscured_content->setReason($this->getRequestParameter('reason'));
		$obscured_content->save();

    // eventuale aggiornamento del campo op_user.last_contribution e op_user.resources
    $user = OpUserPeer::retrieveByPK($this->getRequestParameter('user_id'));
    $user->updateLastContribution();
    $user->setResources($user->countResources());
    $user->save();

	$pol = OpPoliticianPeer::retrieveByPk( $this->op_politician_id );

    unset($user);
		
		return $this->redirect('@politico_new?slug='. $pol->getSlug() .'&content_id='.$this->op_politician_id);
	}

}

?>
