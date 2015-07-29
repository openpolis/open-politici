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
 * feed actions.
 *
 * @package    openpolis
 * @subpackage feed
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
 
class feedActions extends sfActions
{
  ########################################
  public function executeIndex()
  {
    $this->response->setTitle('Rss/xml | openpolis');   
  }
  
  ########################################
  public function executeLastPoliticians()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI POLITICI INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));  	

    //selezione ultimi politici  
    $c = new Criteria();
    $c->Add(OpContentPeer::OP_CLASS, 'OpPolitician', Criteria::EQUAL);
	  $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
	  $c->setLimit(sfConfig::get('app_feed_max'));
	  $politicians = OpContentPeer::doSelect($c);

    // feed rss items
    foreach ($politicians as $politician)
    {
      $c1 = new Criteria();
      $c1->Add(OpPoliticianPeer::CONTENT_ID, $politician->getId());	  
      $politician_info = OpPoliticianPeer::doSelectOne($c1);

      $politician_name = strtoupper($politician_info->getLastName()).' '.ucfirst(strtolower($politician_info->getFirstName()));
      //definizione del singolo item			
      $item = array('title'       => $politician_name,
                    'link'        => '@politico_new?content_id='.$politician->getId() . '&slug='. $politician->getSlug(),
                    'authorEmail' => sfConfig::get('app_feed_author_mail'),
                    'authorName'  => sfConfig::get('app_feed_author_name'),
                    'pubdate'     => $politician->getCreatedAt('U'),
                    'uniqueId'    => $politician->getId(),
                    'description' => 'Nato a '.$politician_info->getBirthLocation().' il '.substr($politician_info->getBirthDate(), 8, 2).'.'.substr($politician_info->getBirthDate(), 5, 2).'.'.substr($politician_info->getBirthDate(), 0, 4),
                   );
      $feed->addItemFromArray($item);
    }
	  $this->feed = $feed;    			      
  }

  ########################################
  public function executeLastResources()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI CONTATTI E LINK INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));  	

    //selezione ultimi contatti e link  
    $c = new Criteria();
    $c->Add(OpContentPeer::OP_CLASS, 'OpResources', Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $resources = OpContentPeer::doSelect($c);

    // feed rss items
    foreach ($resources as $resource)
    {
      $c1 = new Criteria();
      $c1->Add(OpResourcesPeer::CONTENT_ID, $resource->getId());	  
      $resource_info = OpResourcesPeer::doSelectOne($c1);
      
      if ($resource_info->getOpOpenContent()->getOpUser()->getPublicName()=='1')
		    $name = ucfirst(strtolower($resource_info->getOpOpenContent()->getOpUser()->getFirstName())).' '.strtoupper($resource_info->getOpOpenContent()->getOpUser()->getLastName());
		  else
		    $name = $resource_info->getOpOpenContent()->getOpUser()->getNickname();
      
      $politician_name = strtoupper($resource_info->getOpPolitician()->getLastName()).' '.ucfirst(strtolower($resource_info->getOpPolitician()->getFirstName()));
      
      $info = $resource_info->getValore().' ('.$resource_info->getOpResourcesType()->getResourceType().')';
      //definizione del singolo item			
      $item = array('title'       => $politician_name,
                    'link'        => '@politico_new?content_id='.$resource_info->getPoliticianId(). '&slug='. $resource_info->getOpPolitician()->getSlug(),
                    'authorName'  => $name,
                    /*'authorEmail' => $resource_info->getOpOpenContent()->getOpUser()->getEmail(),*/
                    'pubdate'     => $resource->getCreatedAt('U'),
                    'uniqueId'    => $resource->getId(),
                    'description' => $info
                   );
      $feed->addItemFromArray($item);
    }
	  $this->feed = $feed;
	
	  $this->setTemplate('lastPoliticians');    			      
  }  

  ########################################
  public function executeLastInstitutionCharges()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIME CARICHE ISTITUZIONALI INSERITE');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));  	

    //selezione ultime cariche istituzionali  
    $c = new Criteria();
    $c->Add(OpContentPeer::OP_CLASS, 'OpInstitutionCharge', Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $institution_charges = OpContentPeer::doSelect($c);

    // feed rss items
    foreach ($institution_charges as $institution_charge)
    {
      $c1 = new Criteria();
      $c1->Add(OpInstitutionChargePeer::CONTENT_ID, $institution_charge->getId());	  
      $institution_charge_info = OpInstitutionChargePeer::doSelectOne($c1);

      $politician_name = strtoupper($institution_charge_info->getOpPolitician()->getLastName()).' '.ucfirst(strtolower($institution_charge_info->getOpPolitician()->getFirstName()));
      
      if ($institution_charge_info->getOpOpenContent()->getOpUser()->getPublicName()=='1')
		    $name = ucfirst(strtolower($institution_charge_info->getOpOpenContent()->getOpUser()->getFirstName())).' '.strtoupper($institution_charge_info->getOpOpenContent()->getOpUser()->getLastName());
		  else
		    $name = $institution_charge_info->getOpOpenContent()->getOpUser()->getNickname();
      
      
      //definizione del singolo item			
      $item = array('title'       => $politician_name,
					'link'        => '@politico_new?content_id='.$institution_charge_info->getPoliticianId() .'&slug='. $institution_charge_info->getOpPolitician()->getSlug(),
                    'authorName'  => $name,
                    /*'authorEmail' => $institution_charge_info->getOpOpenContent()->getOpUser()->getEmail(),*/
                    'pubdate'     => $institution_charge->getCreatedAt('U'),
                    'uniqueId'    => $institution_charge->getId(),
                    'description' => $institution_charge_info->getOpChargeType()->getName()
                    /*'description' => Text::chargeDefinition($institution_charge_info, false, false)*/
                   );
      $feed->addItemFromArray($item);
    }
	  $this->feed = $feed;

    $this->setTemplate('lastPoliticians');    			      
  }  

  ########################################
  public function executeLastPoliticalCharges()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIME CARICHE POLITICHE INSERITE');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));  	

    //selezione ultime cariche politiche  
    $c = new Criteria();
    $c->Add(OpContentPeer::OP_CLASS, 'OpPoliticalCharge', Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $political_charges = OpContentPeer::doSelect($c);

    // feed rss items
    foreach ($political_charges as $political_charge)
    {
      $c1 = new Criteria();
      $c1->Add(OpPoliticalChargePeer::CONTENT_ID, $political_charge->getId());	  
      $political_charge_info = OpPoliticalChargePeer::doSelectOne($c1);
      
      if ($political_charge_info->getOpOpenContent()->getOpUser()->getPublicName()=='1')
		    $name = ucfirst(strtolower($political_charge_info->getOpOpenContent()->getOpUser()->getFirstName())).' '.strtoupper($political_charge_info->getOpOpenContent()->getOpUser()->getLastName());
		  else
		    $name = $political_charge_info->getOpOpenContent()->getOpUser()->getNickname();
      
      $politician_name = strtoupper($political_charge_info->getOpPolitician()->getLastName()).' '.ucfirst(strtolower($political_charge_info->getOpPolitician()->getFirstName()));
      $charge = ($political_charge_info->getChargeTypeId()==sfConfig::get('app_charge_type_id_carica') ? $political_charge_info->getDescription() : 'iscritto');
      //definizione del singolo item			
      $item = array('title'       => $politician_name,
				            'link'        => '@politico_new?content_id='.$political_charge_info->getPoliticianId() .'&slug='. $political_charge_info->getOpPolitician()->getSlug(),
                    'authorName'  => $name,
				            /*'authorEmail' => $political_charge_info->getOpOpenContent()->getOpUser()->getEmail(),*/
				            'pubdate'     => $political_charge->getCreatedAt('U'),
				            'uniqueId'    => $political_charge->getId(),
                    'description' => $charge.' ('.$political_charge_info->getOpParty()->getName().')'
			             );

      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;
    
    $this->setTemplate('lastPoliticians');    			      
  }

  ########################################
  public function executeLastOrganizationCharges()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIME CARICHE ORGANIZZATIVE INSERITE');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));  	

    //selezione ultime cariche organizzative  
    $c = new Criteria();
    $c->Add(OpContentPeer::OP_CLASS, 'OpOrganizationCharge', Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $organization_charges = OpContentPeer::doSelect($c);

    // feed rss items
    foreach ($organization_charges as $organization_charge)
    {
      $c1 = new Criteria();
      $c1->Add(OpOrganizationChargePeer::CONTENT_ID, $organization_charge->getId());	  
      $organization_charge_info = OpOrganizationChargePeer::doSelectOne($c1);

      $politician_name = strtoupper($organization_charge_info->getOpPolitician()->getLastName()).' '.ucfirst(strtolower($organization_charge_info->getOpPolitician()->getFirstName()));

      if ($organization_charge_info->getOpOpenContent()->getOpUser()->getPublicName()=='1')
		    $name = ucfirst(strtolower($organization_charge_info->getOpOpenContent()->getOpUser()->getFirstName())).' '.strtoupper($organization_charge_info->getOpOpenContent()->getOpUser()->getLastName());
		  else
		    $name = $organization_charge_info->getOpOpenContent()->getOpUser()->getNickname();

      //definizione del singolo item			
      $item = array('title'       => $politician_name,

                    'link'        => '@politico_new?content_id='.$organization_charge_info->getPoliticianId() .'&slug='. $organization_charge_info->getOpPolitician()->getSlug(),
                    'authorName'  => $name,
                    /*'authorEmail' => $organization_charge_info->getOpOpenContent()->getOpUser()->getEmail(),*/
                    'pubdate'     => $organization_charge->getCreatedAt('U'),
                    'uniqueId'    => $organization_charge->getId(),
                    'description' => $organization_charge_info->getOpOrganization()->getName().' - '.$organization_charge_info->getChargeName()
                   );

      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;

    $this->setTemplate('lastPoliticians');    			      
  }
  
  ########################################	    	   	
  public function executePopularDeclarations()
  {
    $feed = sfFeed::newInstance('atom1');

    // channel 
    $feed->setTitle('Openpolis - ULTIME DICHIARAZIONI PIU\' POPOLARI INSERITE');
    $feed->setLink(sfConfig::get('app_feed_link'));

    //declarations 
    $c = new Criteria;
    $c->addDescendingOrderByColumn(OpDeclarationPeer::RELEVANCY_SCORE);
    $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $declarations = OpDeclarationPeer::doSelectJoinOpOpenContent($c);

    // items
    foreach ($declarations as $declaration)
    {
      $c1 = new Criteria();
      $c1->Add(OpResourcesPeer::RESOURCES_TYPE_ID, sfConfig::get('app_resource_type_official_mail'), Criteria::EQUAL);
      $c1->Add(OpResourcesPeer::POLITICIAN_ID,$declaration->getPoliticianId());
      $resource=OpResourcesPeer::doSelectOne($c1);
      $link='';
      if ($resource)
        $link=$resource->getValore();

      $item = array('title'       => $declaration->getTitle(),
                    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
                    //'link'        => '@declaration?stripped_title='.$declaration->getStrippedTitle(),
                    'link'	=> '@dichiarazione_new?'. $declaration->getSlugUrl(),
                    'authorEmail' => sfConfig::get('app_feed_author_mail'),
                    'authorName'  => sfConfig::get('app_feed_author_name'),
                    'pubdate'     => $declaration->getDate('U'),
                    'uniqueId'    => $declaration->getContentId(),
                    //'uniqueId'    => $declaration->getStrippedTitle(),
                    'description' => $declaration->getText(),
                   );

      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;

    $this->setTemplate('lastPoliticians');  
  }

  ########################################	    	   	
  public function executeLastDeclarations()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIME DICHIARAZIONI INSERITE');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));

    //query for declarations 
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    $c->addDescendingOrderByColumn(OpDeclarationPeer::CONTENT_ID);    
    $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $declarations = OpDeclarationPeer::doSelectJoinOpOpenContent($c);

    // feed rss items
    foreach ($declarations as $declaration)
    {
      $politician_name = ucfirst(strtolower($declaration->getOpPolitician()->getFirstName())).' '.strtoupper($declaration->getOpPolitician()->getLastName());
       
      //definizione del singolo item			
      $item = array('title'       => $politician_name.' - '.$declaration->getTitle(),
//  	    'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
  		'link' => '@dichiarazione_new?'. $declaration->getSlugUrl(),
		  'authorEmail' => sfConfig::get('app_feed_author_mail'),
  	    'authorName'  => sfConfig::get('app_feed_author_name'),
  	    'pubdate'     => $declaration->getDate('U'),
  	    'uniqueId'    => $declaration->getContentId(),
				//'uniqueId'    => $declaration->getStrippedTitle(),
				'description' => $declaration->getText(),
			);
      
	    $feed->addItemFromArray($item);
    }
  	$this->feed = $feed;
	
  	$this->setTemplate('lastPoliticians');  
  }

  ########################################	
  public function executeTagDeclarations()
  {
    $tag_id = $this->getRequestParameter('tag_id',0);
    $tag = OpTagPeer::RetrieveByPk($tag_id);
    
    $compilatori = 'all';
    if ($this->hasRequestParameter('compilatori')) {
      $compilatori = $this->getRequestParameter('compilatori');
    }

    $feed = sfFeed::newInstance('atom1');

    // channel 
    $feed->setTitle('Openpolis - Argomento: '.$tag->getTag());
    $feed->setLink(sfConfig::get('app_feed_link'));
    $feed->setFeedUrl(sfContext::getInstance()->getController()->genUrl("@feed_tag_declarations?tag_id=" . $tag->getId() . ($compilatori != 'all' ? '&compilatori=' . $compilatori : ''), true));
    // $feed->setHubUrl(sfconfig::get('app_feed_hub_url', 'http://openpolis-tag-rss.superfeedr.com/'));

    //declarations 
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    $c->addDescendingOrderByColumn(OpDeclarationPeer::CONTENT_ID);

    //join con OpTagHasOpOpinableContent
    $c->addJoin(OpDeclarationPeer::CONTENT_ID, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID);

    //join con OpTagHasOpenContent
    $c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);


    if ($compilatori == 'redazione') {
      $c->add(OpOpenContentPeer::USER_ID, explode(",", sfConfig::get('app_utenze_redazionali', '6,8')), Criteria::IN);
    }

    $criterion = $c->getNewCriterion(OpTagHasOpOpinableContentPeer::TAG_ID, $tag_id);
    $c->add($criterion);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $declarations = OpDeclarationPeer::doSelect($c);

    // items
    foreach ($declarations as $declaration)
    {
      $c1 = new Criteria();
      $c1->add(OpResourcesPeer::RESOURCES_TYPE_ID, sfConfig::get('app_resource_type_official_mail'), Criteria::EQUAL);
      $c1->add(OpResourcesPeer::POLITICIAN_ID,$declaration->getPoliticianId());
      $resource=OpResourcesPeer::doSelectOne($c1);
      $link='';
      if($resource)
        $link=$resource->getValore();
        $count=count(OpInstitutionChargePeer::getPoliticianChargeAtDate($declaration->getPoliticianId(),$declaration->getDate()));
        $cariche="";
        
        
        if($count>0)
        {
          $cariche="Alla data della dichiarazione: ";
          foreach (OpInstitutionChargePeer::getPoliticianChargeAtDate($declaration->getPoliticianId(),$declaration->getDate()) as $num => $institution_charge)
          {
            $cariche=$cariche.Text::chargeDefinition($institution_charge, false, false, true).($num<$count-1 ? '- ':'');
          }
          $cariche=str_ireplace("&nbsp;"," ",$cariche)."<br/><br/>";
        }
        

      $item = array('title'       => $declaration->getOpPolitician() . ": " . $declaration->getTitle(),
                    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
							'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
        				    'authorEmail' => sfConfig::get('app_feed_author_mail'),
        				    'authorName'  => sfConfig::get('app_feed_author_name'),
        				    'pubdate'     => $declaration->getDate('U'),
        				    'uniqueId'    => $declaration->getContentId(),
        				    'description' => $cariche. $declaration->getText() . "<br/>" .
				                             'fonte: <a href="' . $declaration->getSourceURL(). '">' . $declaration->getSourceName(). '</a>',
			       );
 
      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;
	
	  $this->setTemplate('lastPoliticians');  
  }

  ########################################
  public function executePoliticianPopularDeclarations()
  {
    $politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id',1));
	
    $feed = sfFeed::newInstance('atom1');
		
    // channel 
    $feed->setTitle('Openpolis - LE ULTIME DICHIARAZIONI PIU\' VOTATE DI '.$politician->toString());
    $feed->setLink(sfConfig::get('app_feed_link'));
				
    //declarations 
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    $c->Add(OpDeclarationPeer::POLITICIAN_ID, $politician->getContentId());
	$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
	$c->addDescendingOrderByColumn(OpDeclarationPeer::RELEVANCY_SCORE);
	$c->setLimit(sfConfig::get('app_feed_max'));
	$declarations = OpDeclarationPeer::doSelectJoinOpOpenContent($c);
		
    // items
    foreach ($declarations as $declaration)
	{
	  $c1 = new Criteria();
	  $c1->Add(OpResourcesPeer::RESOURCES_TYPE_ID, sfConfig::get('app_resource_type_official_mail'), Criteria::EQUAL);
	  $c1->Add(OpResourcesPeer::POLITICIAN_ID,$declaration->getPoliticianId());
	  $resource=OpResourcesPeer::doSelectOne($c1);
   	  $link='';
      if($resource)
        $link=$resource->getValore();
						
      $item = array('title'       => $declaration->getTitle(),
                    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
					'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
					//'link'        => '@declaration?stripped_title='.$declaration->getStrippedTitle(),
				    'authorEmail' => sfConfig::get('app_feed_author_mail'),
				    'authorName'  => sfConfig::get('app_feed_author_name'),
				    'pubdate'     => $declaration->getDate('U'),
				    'uniqueId'    => $declaration->getContentId(),
					//'uniqueId'    => $declaration->getStrippedTitle(),
				    'description' => $declaration->getText(),
			       );
      $feed->addItemFromArray($item);
    }
	$this->feed = $feed;
	
	$this->setTemplate('lastPoliticians');  
  }

  ########################################
  public function executePoliticianLastDeclarations()
  {
    $politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id',1));
	
    $feed = sfFeed::newInstance('atom1');
		
    // channel 
    $feed->setTitle('Openpolis - LE ULTIME DICHIARAZIONI DI '.$politician->toString());
    $feed->setLink(sfConfig::get('app_feed_link'));
				
    //declarations 
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    $c->Add(OpDeclarationPeer::POLITICIAN_ID, $politician->getContentId());
    $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $declarations = OpDeclarationPeer::doSelectJoinOpOpenContent($c);
		
    // items
    foreach ($declarations as $declaration)
    {
      $c1 = new Criteria();
      $c1->Add(OpResourcesPeer::RESOURCES_TYPE_ID, sfConfig::get('app_resource_type_official_mail'), Criteria::EQUAL);
      $c1->Add(OpResourcesPeer::POLITICIAN_ID,$declaration->getPoliticianId());
      $resource=OpResourcesPeer::doSelectOne($c1);
      $link='';
      if($resource)
        $link=$resource->getValore();

      $item = array('title'       => $declaration->getTitle(),
				    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
					//'link'        => '@declaration?stripped_title='.$declaration->getStrippedTitle(),
					'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
				    'authorEmail' => sfConfig::get('app_feed_author_mail'),
				    'authorName'  => sfConfig::get('app_feed_author_name'),
				    'pubdate'     => $declaration->getDate('U'),
				    'uniqueId'    => $declaration->getContentId(),
					//'uniqueId'    => $declaration->getStrippedTitle(),
				    'description' => $declaration->getText(),
			       );
      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;
	
	$this->setTemplate('lastPoliticians');  
  }

  ########################################	
  //feed delle ultime dichiarazioni relative ad una istituzione
  public function executeInstitutionDeclarations()
  {
    $feed = sfFeed::newInstance('atom1');
		
	$institution_id = $this->getRequestParameter('institution_id');
		
    // channel 
    $feed->setTitle('Openpolis - ULTIME DICHIARAZIONI INSERITE');
    $feed->setLink(sfConfig::get('app_feed_link'));
				
    //declarations 
    $declarations = OpDeclarationPeer::getPopularsForInstitution($institution_id);

    // items
    foreach ($declarations as $declaration)
    {
      $c1 = new Criteria();
      $c1->Add(OpResourcesPeer::RESOURCES_TYPE_ID, sfConfig::get('app_resource_type_official_mail'), Criteria::EQUAL);
      $c1->Add(OpResourcesPeer::POLITICIAN_ID,$declaration->getPoliticianId());
      $resource=OpResourcesPeer::doSelectOne($c1);
	
      $link='';
      if ($resource)
        $link=$resource->getValore();
						
      $item = array('title'       => $declaration->getTitle(),
				    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
					//'link'        => '@declaration?stripped_title='.$declaration->getStrippedTitle(),
				    'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
					'authorEmail' => sfConfig::get('app_feed_author_mail'),
				    'authorName'  => sfConfig::get('app_feed_author_name'),
				    'pubdate'     => $declaration->getDate('U'),
				    'uniqueId'    => $declaration->getContentId(),
					//'uniqueId'    => $declaration->getStrippedTitle(),
				    'description' => $declaration->getText(),
			       );
      $feed->addItemFromArray($item);
    }
	$this->feed = $feed;
	
	$this->setTemplate('lastPoliticians');  
  }

  ########################################	
  //feed delle ultime dichiarazioni relative ad un'ente locale
  public function executeLocationDeclarations()
  {
    $feed = sfFeed::newInstance('atom1');
		
    $location_id = $this->getRequestParameter('location_id');
		
    $internalUri=sfRouting::getInstance()->getCurrentInternalUri();
    $routing=substr($internalUri,0,strpos($internalUri,'?'));
		
    // channel 
    $feed->setTitle('Openpolis - ULTIME DICHIARAZIONI INSERITE');
    $feed->setLink(sfConfig::get('app_feed_link'));
				
    //declarations 
    $declarations = OpDeclarationPeer::getPopularsForLocation($location_id, $routing);
		
    // items
    foreach ($declarations as $declaration)
    {
      $c1 = new Criteria();
      $c1->Add(OpResourcesPeer::RESOURCES_TYPE_ID, sfConfig::get('app_resource_type_official_mail'), Criteria::EQUAL);
      $c1->Add(OpResourcesPeer::POLITICIAN_ID,$declaration->getPoliticianId());
      $resource=OpResourcesPeer::doSelectOne($c1);
			
      $link='';
      if ($resource)
        $link=$resource->getValore();

      $item = array('title'       => $declaration->getTitle(),
				    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
					//'link'        => '@declaration?stripped_title='.$declaration->getStrippedTitle(),
				    'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
					'authorEmail' => sfConfig::get('app_feed_author_mail'),
				    'authorName'  => sfConfig::get('app_feed_author_name'),
				    'pubdate'     => $declaration->getDate('U'),
				    'uniqueId'    => $declaration->getContentId(),
					//'uniqueId'    => $declaration->getStrippedTitle(),
				    'description' => $declaration->getText(),
			       );
      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;
	
	$this->setTemplate('lastPoliticians');  
  }
  
  ########################################	    	   	
  public function executeLastComments()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI COMMENTI INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));

    //query for comments
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpCommentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $comments = OpCommentPeer::doSelect($c);

    // feed rss items
    foreach ($comments as $comment)
    {
      
	  $declaration = OpDeclarationPeer::RetrieveByPk($comment->getContentId());
    
    if ($comment->getOpUser()->getPublicName()=='1')
		  $name = ucfirst(strtolower($comment->getOpUser()->getFirstName())).' '.strtoupper($comment->getOpUser()->getLastName());
		else
		  $name = $comment->getOpUser()->getNickname();
    
    //definizione del singolo item			
    $item = array('title'       => 'dichiarazione: '.$declaration->getTitle().' ('.ucfirst(strtolower($declaration->getOpPolitician()->getFirstName())).' '.strtoupper($declaration->getOpPolitician()->getLastName()).')',
                  //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
                  'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
				  'authorName'  => $name,
                  /*'authorEmail' => $comment->getOpUser()->getEmail(),*/
                  'pubdate'     => $comment->getCreatedAt('U'),
                  'uniqueId'    => $comment->getId(),
                  'description' => 'da '.$name.'<br />'.$comment->getBody(),
                 );

    $feed->addItemFromArray($item);
    }
    $this->feed = $feed;
	
	  $this->setTemplate('lastPoliticians');  
  }
  
  ########################################	    	   	
  public function executeLastCommentsForOpinableContent()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI COMMENTI INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));
    
	  $content_id = $this->getRequestParameter('content_id'); 
    $declaration = OpDeclarationPeer::RetrieveByPk($declaration_id);
	
	  //query for comments
    $c = new Criteria();
    $c->Add(OpCommentPeer::CONTENT_ID, $content_id, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpCommentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $comments = OpCommentPeer::doSelect($c);

    // feed rss items
    foreach ($comments as $comment)
    {
      
      if ($comment->getOpUser()->getPublicName()=='1')
        $name = ucfirst(strtolower($comment->getOpUser()->getFirstName())).' '.strtoupper($comment->getOpUser()->getLastName());
      else
		    $name = $comment->getOpUser()->getNickname();
      
      //definizione del singolo item			
      $item = array('title'       => 'dichiarazione: '.$declaration->getTitle().' ('.ucfirst(strtolower($declaration->getOpPolitician()->getFirstName())).' '.strtoupper($declaration->getOpPolitician()->getLastName()).')',
				    //'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
                    'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
					'authorName'  => $name,
				            /*'authorEmail' => $comment->getOpUser()->getEmail(),*/
				            'pubdate'     => $comment->getCreatedAt('U'),
				            'uniqueId'    => $comment->getId(),
                    'description' => 'da '.$name.'<br />'.$comment->getBody(),
			             );

      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;

    $this->setTemplate('lastPoliticians');  
  }



  public function executeLastCommentsForDeclaration()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI COMMENTI INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));
    
	  $declaration_id = $this->getRequestParameter('declaration_id'); 
    $declaration = OpDeclarationPeer::RetrieveByPk($declaration_id);
	
	  //query for comments
    $c = new Criteria();
    $c->Add(OpCommentPeer::CONTENT_ID, $declaration_id, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpCommentPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $comments = OpCommentPeer::doSelect($c);

    // feed rss items
    foreach ($comments as $comment)
    {
      
      if ($comment->getOpUser()->getPublicName()=='1')
        $name = ucfirst(strtolower($comment->getOpUser()->getFirstName())).' '.strtoupper($comment->getOpUser()->getLastName());
      else
		    $name = $comment->getOpUser()->getNickname();
      
      //definizione del singolo item			
      $item = array('title'       => 'dichiarazione: '.$declaration->getTitle().' ('.ucfirst(strtolower($declaration->getOpPolitician()->getFirstName())).' '.strtoupper($declaration->getOpPolitician()->getLastName()).')',
				           // 'link'        => '/polDeclarations/index?declaration_id='.$declaration->getContentId(),
				'link'        => '@dichiarazione_new?'.$declaration->getSlugUrl(),
                    'authorName'  => $name,
				            /*'authorEmail' => $comment->getOpUser()->getEmail(),*/
				            'pubdate'     => $comment->getCreatedAt('U'),
				            'uniqueId'    => $comment->getId(),
                    'description' => 'da '.$name.'<br />'.$comment->getBody(),
			             );

      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;

    $this->setTemplate('lastPoliticians');  
  }
  
  ########################################	    	   	
  public function executeLastUsers()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI UTENTI REGISTRATI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));

    //query for users
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpUserPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $users = OpUserPeer::doSelect($c);
    
	// feed rss items
    foreach ($users as $user)
    {
      $role = '';
	  if ($user->getIsAdministrator())
	    $role = 'amministratore';
	  elseif($user->getIsModerator())	
	    $role = 'moderatore';
	  else
	    $role = 'utente';
		
		if ($user->getPublicName()=='1')
		  $name = strtoupper($user->getLastName()).' '.ucfirst(strtolower($user->getFirstName()));
		else
		  $name = $user->getNickname();
		
		$location = $user->getOpLocation()->getName().' ('.$user->getOpLocation()->getProv().')';  
		 	 
      //definizione del singolo item			
      $item = array('title' => $name,
				  'link'          => '@user_profile?hash='.$user->getHash(),
					/*'authorName'    => $name,
				  'authorEmail'   => $user->getEmail(),*/
				  'pubdate'       => $user->getCreatedAt('U'),
				  'uniqueId'      => $user->getId(),
					'description'   => $location.' - '.$role
			       );
      
	  $feed->addItemFromArray($item);
    }
	$this->feed = $feed;
	
	$this->setTemplate('lastPoliticians');  
  }

  ########################################	    	   	
  public function executeLastTags()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI TAG INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));

    //query for tags
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpTagPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $tags = OpTagPeer::doSelect($c);
    
	  // feed rss items
    foreach ($tags as $tag)
    {

      //definizione del singolo item			
      $item = array('title'       => $tag->getTag(),
				            'link'        => '/argument/list?tag='.$tag->getId(),
					          'uniqueId'    => $tag->getId(),
					          'description' => $tag->getNormalizedTag(),
                   );
      
	    $feed->addItemFromArray($item);
    }
    $this->feed = $feed;

    $this->setTemplate('lastPoliticians');  
  }
  
  ########################################	    	   	
  public function executeLastReports()
  {
    //inizializzazione feed rss
    $feed = sfFeed::newInstance('atom1');

    //definizione titolo 
    $feed->setTitle('Openpolis - ULTIMI REPORT INSERITI');

    //definizione link di riferimento
    $feed->setLink(sfConfig::get('app_feed_link'));

    //query for reports
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpReportPeer::CREATED_AT);
    $c->setLimit(sfConfig::get('app_feed_max'));
    $reports = OpReportPeer::doSelect($c);
	    
    // feed rss items
    foreach ($reports as $report)
    {
      switch($report->getReportType())
      {
        case 'o':
          $report_type = 'offensivo';
		      break;
        case 's':
          $report_type = 'spam';
          break;	  
        default:
          $report_type = 'errore';  
      }	
      
      if ($report->getOpUser()->getPublicName()=='1')
        $name = ucfirst(strtolower($report->getOpUser()->getFirstName())).' '.strtoupper($report->getOpUser()->getLastName());
      else
		    $name = $report->getOpUser()->getNickname();
      
      
      //definizione del singolo item			
      $item = array('title'       => 'autore :'.$name,
                    'link'        => '/politician/page?content_id='.$report->getContentId(),
                    'authorName'  => $name,
                    'authorEmail' => sfConfig::get('app_feed_author_mail'),
                    'pubdate'     => $report->getCreatedAt('U'),
                    'description' => 'tipo di report: '.$report_type.'<br />'.'note: '.$report->getNotes()
                   );

      $feed->addItemFromArray($item);
    }
    $this->feed = $feed;

    $this->setTemplate('lastPoliticians');  
  }      
    
  
}

?>