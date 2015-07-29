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
 * user components.
 *
 * @package    openpolis
 * @subpackage user
 * @author     Gianluca Canale 
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class userComponents extends sfComponents
{
  
  
  public function executeAuthorshipMetadata()
  {
    if ($this->item instanceOf OpDeclaration)
      $open_content = $this->item->getOpOpinableContent()->getOpOpenContent();

    if (in_array(get_class($this->item), 
                 array('OpInstitutionCharge', 'OpPoliticalCharge', 'OpOrganizationCharge', 'OpResources'))) {
      $open_content = $this->item->getOpOpenContent();
    }

    $content = $open_content->getOpContent();

    $author_id = $open_content->getUserId();
    $updater_id = $open_content->getUpdaterId();
    
    $this->author = OpUserPeer::retrieveByPK($author_id);
    if ($updater_id)
      $this->updater = OpUserPeer::retrieveByPK($updater_id);
    else
      $this->updater = null;
      
    $this->created_at = $content->getCreatedAt();
    $this->updated_at = $content->getUpdatedAt();
  }
  
  public function executeAttivita()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();
    
    $this->activities = $this->subscriber->getActivities();
  }

  public function executeCharges()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();

		if ($this->getUser()->hasCredential('administrator'))
		  $limit = 100;
		else 
		  $limit = sfConfig::get('app_last_user_contributions');

    $this->oc_charges = $this->subscriber->getAllCharges($limit, $this->upsert);
  }

  public function executeResources()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();

		if ($this->getUser()->hasCredential('administrator'))
		  $limit = 100;
		else 
		  $limit = sfConfig::get('app_last_user_contributions');

    $this->ocs = $this->subscriber->getAllResources($limit, $this->upsert);
  }
  
  public function executePolinsertions()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();

		if ($this->getUser()->hasCredential('administrator'))
		  $limit = 100;
		else 
		  $limit = sfConfig::get('app_last_user_contributions');

    $this->politicians = $this->subscriber->getAllPolinsertions($limit);
  }
  
  public function executeRemovals()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();

		if ($this->getUser()->hasCredential('administrator'))
		  $limit = 100;
		else 
		  $limit = sfConfig::get('app_last_user_contributions');

    $this->ocs = $this->subscriber->getAllRemovals($limit);
  }
  


  /**
   * estrae le ultime N dichiarazioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeDeclarations()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();
		
		if ($this->getUser()->hasCredential('administrator'))
		  $limit = 100;
		else 
		  $limit = sfConfig::get('app_last_user_contributions');
    $this->declarations = $this->subscriber->getAllDeclarations($limit, $this->upsert);
  }


  /**
   * estrae le adozioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAdoptions()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();
		
    $this->adoptees = OpAdoptionPeer::getAdoptees($this->subscriber->getId());
  }



	

  /**
   * estrae gli ultimi N temi
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeThemes()
  {
    if (isset($this->hash))
    {
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
    }
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();
		
    $c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID, $this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
  	$c->setLimit(sfConfig::get('app_last_user_contributions'));
  	$c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
  	$this->themes = OpThemePeer::doSelectJoinOpOpinableContent($c);
  }

  /**
   * estrae gli ultimi N commenti
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeComments()
  {
    if (isset($this->hash))
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->hash);
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();

		if ($this->getUser()->hasCredential('administrator'))
		  $limit = 100;
		else 
		  $limit = sfConfig::get('app_last_user_contributions');

  	$c = new Criteria();
  	$c->add(OpCommentPeer::USER_ID, $this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
  	$c->setLimit($limit);
  	$c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
  	$this->comments = OpCommentPeer::doSelectJoinOpOpinableContent($c);
  }


  /**
   * elenco degli adopter di un politico
   * vengono estratti tutti gli adopter diretti o indiretti
   * gli adopter indiretti sono quelli che hanno adottato la
   * località in cui il politico ha incarichi
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAdoptionUsers()
  {
    $adopter_ids = OpAdoptionPeer::getAdoptersForPolitician($this->getRequestParameter('content_id'));
    $adopter_objs = array();
    

    if ($adopter_ids && count($adopter_ids) > 0)
      foreach ($adopter_ids as $u_id)
        $adopter_objs []= OpUserPeer::retrieveByPK($u_id);
    
    $this->adopters = $adopter_objs;
    $this->politician = OpPoliticianPeer::retrieveByPK($this->getRequestParameter('content_id'));
    
  }
 
  /**
   * elenco degli adopter per una certa località
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeLocAdoptionUsers()
  {
    $adopter_ids = OpAdoptionPeer::getAdoptersForLocation($this->getRequestParameter('location_id'));
    $adopter_objs = array();
    

    if ($adopter_ids && count($adopter_ids) > 0)
      foreach ($adopter_ids as $u_id)
        $adopter_objs []= OpUserPeer::retrieveByPK($u_id);
    
    $this->adopters = $adopter_objs;
    $this->location = OpLocationPeer::retrieveByPK($this->getRequestParameter('location_id'));
    
  }
  
  public function executePoliticianUsers()
  {
    $this->users = OpDeclarationPeer::doSelectForPoliticianGroupedByUser($this->getRequestParameter('content_id'));
  }
  
  public function executeLocationUsers()
  {
    $this->users = OpDeclarationPeer::doSelectForLocationGroupedByUser($this->getRequestParameter('location_id'));
  }
  
  public function executeTagUsers()
  {
    $this->users = OpDeclarationPeer::doSelectForTagGroupedByUser($this->getRequestParameter('tag'));
  }
  
  public function executeUsersList()
  {
    $c = new Criteria();
    if ($this->region_id != -1 || $this->location_id != -1)
      $c->addJoin(OpUserPeer::LOCATION_ID, OpLocationPeer::ID, Criteria::LEFT_JOIN);
      
  	if($this->region_id != '-1')
  	  $c->Add(OpLocationPeer::REGIONAL_ID, $this->region_id);
  	
  	if($this->location_id != '-1')
  	  $c->Add(OpLocationPeer::ID, $this->location_id);
  	  
  	$cnick1 = $c->getNewCriterion(OpUserPeer::NICKNAME, array('admin', 'importer'), Criteria::NOT_IN);
    $cnick2 = $c->getNewCriterion(OpUserPeer::NICKNAME, null, Criteria::ISNULL);
    $cnick1->addOr($cnick2);  
  	$c->add($cnick1);
    $c->add(OpUserPeer::IS_ACTIVE, 1);
  	// DEPRECATED
  	// $c->add(OpUserPeer::CREATED_AT, null, Criteria::ISNOTNULL);

    $col = "";
    switch ($this->sort_field)
    {
      case 'risorse':
        $col = OpUserPeer::RESOURCES;
        break;
      case 'incarichi':
        $col = OpUserPeer::CHARGES;
        break;
      case 'dichiarazioni':
        $col = OpUserPeer::DECLARATIONS;
        break;
      case 'temi':
        $col = OpUserPeer::THEMES;
        break;
      case 'commenti':
        $col = OpUserPeer::COMMENTS;
        break;
      case 'ultimo_contributo':
        $col = OpUserPeer::LAST_CONTRIBUTION;
        break;
      case 'registrazione':
        $col = OpUserPeer::CREATED_AT;
        break;      
      default:
        $col = OpUserPeer::LAST_CONTRIBUTION;
        break;
    }

    if ($this->sort_order == 'ASC')
  	  $c->addAscendingOrderByColumn($col);
    else
  	  $c->addDescendingOrderByColumn($col);
  	
  	$pager = new sfPropelPager('OpUser', sfConfig::get('app_pagination_users'));
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->users_pager = $pager;
  }	
  
}

?>  	