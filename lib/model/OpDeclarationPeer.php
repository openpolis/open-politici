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

  // include base peer class
  require_once 'lib/model/om/BaseOpDeclarationPeer.php';
  
  // include object class
  include_once 'lib/model/OpDeclaration.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_declaration' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpDeclarationPeer extends BaseOpDeclarationPeer {


  /**
   * compara due risorse e torna true se hanno uguali:
   * - politician_id (solo se richiesto)
   * - date
   * - title
   * - source_name
   *
   * Nel caso in cui si comparino dichiarazioni di due politici doppioni,
   * il confronto tra politician_id non è necessario
   *
   * @param OpDeclaration $o1 
   * @param OpDeclaration $o2 
   * @param boolean $compare_politician_id
   * @return void
   * @author Guglielmo Celata
   */
  public static function compare($o1, $o2, $compare_politician_id = false)
  {
    if (!$o1 instanceof OpDeclaration ||
        !$o2 instanceof OpDeclaration )
      throw new Exception("Wrong parameters: both must be OpDeclaration classes");
    
    $res = false;
    /*
    printf("\ncomparing %6d and %6d\n %6d     %6d\n %s => %s\n %s => %s\n %s => %s\n %s => %s\n",
           $o1->getContentId(), $o2->getContentId(),
           $o1->getPoliticianId(), $o2->getPoliticianId(),
           $o1->getDate('U'), $o2->getDate('U'),
           $o1->getTitle(), $o2->getTitle(),
           $o1->getSourceName(), $o2->getSourceName(),
           $o1->getSourceUrl(), $o2->getSourceUrl();
    */         
    if (abs($o1->getDate('U') - $o2->getDate('U') <= 24*3600) &&
        $o1->getTitle() == $o2->getTitle() &&
        $o1->getSourceName() == $o2->getSourceName() &&
        $o1->getSourceUrl() == $o2->getSourceUrl())
    {
      $res = true;      
    }
    
    if ($compare_politician_id)
    {
      $res = $res && ($o1->getPoliticianId() == $o2->getPoliticianId());
    }
    
    // printf("res: %s\n", $res?'uguali':'diverse');
    return $res;
  }



  public static function getIDSInsertedByRedazione(Criteria $crit = null)
  {
    $c = self::buildInsertedByRedazioneCriterion($crit);

    $c->clearSelectColumns();
    $c->addSelectColumn(self::CONTENT_ID);
    $c->addGroupByColumn(self::CONTENT_ID);
    
    $ids = array();
    $rs = self::doSelectRS($c);
    while ($rs->next()) {
      $ids[] = $rs->getInt(1);
    }
    return $ids; 
  }
    
  public static function getInsertedByRedazioneGroupedByDate(Criteria $crit = null)
  {
    $c = self::buildInsertedByRedazioneCriterion($crit);
    
    $c->addGroupByColumn(OpDeclarationPeer::CONTENT_ID);
    
    $results = OpDeclarationPeer::doSelectJoinAll($c);
    
    $grouped_results = array();
    foreach ($results as $res)
    {
      $date = strtotime($res->getDate('Y-m-d'));
      if (!is_string($date) && !is_int($date))
        $date = 0;

      if (!array_key_exists($date, $grouped_results))
      {
        $grouped_results[$date] = array();        
      }
      $grouped_results[$date] []= $res;
    }
    krsort($grouped_results);
    
    return $grouped_results;
  }


  public static function getNumInsertedByRedazioneByDate(Criteria $crit = null)
  {    
    $c = self::buildInsertedByRedazioneCriterion($crit);
    
    $c->clearSelectColumns();
    $c->addSelectColumn(self::DATE);
    $c->addAsColumn('numDeclarations', 'COUNT('.self::CONTENT_ID.')');
    $c->addGroupByColumn(OpDeclarationPeer::DATE);
    
    $numbers = array();
    $rs = self::doSelectRS($c);
    while ($rs->next()) {
      sfContext::getInstance()->getLogger()->info("{getNumInsertedByRedazioneByDate} " . $rs->getString(1));
      $numbers[$rs->getString(1)] = $rs->getInt(2);
    }
    return $numbers; 
  }
  
  public static function buildInsertedByRedazioneCriterion(Criteria $crit = null)
  {
    if (is_null($crit))
      $c = new Criteria();
    else
      $c = clone $crit;
   
	  $c->addDescendingOrderByColumn(self::DATE);

    //join con OpTagHasOpOpinableContent
    $c->addJoin(self::CONTENT_ID, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID);

    //join con OpOpenContent e OpContent
    $c->addJoin(self::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->addJoin(self::CONTENT_ID, OpContentPeer::ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);

    // join con OpPolitician
    $c->addJoin(self::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
    
    // estrae solo dichiarazioni inserite da redattori
    $c->add(OpOpenContentPeer::USER_ID, explode(",", sfConfig::get('app_utenze_redazionali', '6,8')), Criteria::IN);
   
    return $c;
  }

    
  /**
   * estrae le dichiarazioni correlate a un certo tema
   * ordinate in base al parametro sort
   *
   * @param theme_id - id del tema
   * @param sort - parametro per l'ordinamento (last[default], insert, relevancy)
   *
   * @return oggetto Pager con le dichiarazioni che verificano i criteri
   * @author Guglielmo Celata
   **/
  public static function getDeclarationsByTheme($theme_id, $sort = 'last')
  {
    $c = new Criteria();
    $c->addJoin(self::CONTENT_ID, OpThemeHasDeclarationPeer::DECLARATION_ID);
    $c->addJoin(self::CONTENT_ID, OpContentPeer::ID);
    $c->add(OpThemeHasDeclarationPeer::THEME_ID, $theme_id);
   
	  if ($sort =='last')
      $c->addDescendingOrderByColumn(OpThemeHasDeclarationPeer::CREATED_AT);
    else
	    $c->addAscendingOrderByColumn(OpThemeHasDeclarationPeer::POSITION);

    return OpDeclarationPeer::doSelect($c);
    
  }

  public static function getPopularByTag($tag_id, $politician_id=0, $sort, $limit = true, $date = NULL, $range = 1)
  {
    $c = new Criteria();
	  if($sort =='last')
      $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    elseif($sort == 'insert')
      $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    else
	  $c->addDescendingOrderByColumn(OpDeclarationPeer::RELEVANCY_SCORE);
	 
    // tags
    $c->addJoin(self::CONTENT_ID, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(self::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);

    if($politician_id!=0)
    {
      $c->add(OpDeclarationPeer::POLITICIAN_ID, $politician_id);
    }
    
    if ($date!=NULL)
    {
      $crit0 = $c->getNewCriterion(OpDeclarationPeer::DATE, date('Y-m-d',strtotime($date)-$range*86400), Criteria::GREATER_EQUAL);
      $crit1 = $c->getNewCriterion(OpDeclarationPeer::DATE, date('Y-m-d',strtotime($date)+$range*86400), Criteria::LESS_EQUAL);
      $crit0->addAnd($crit1);
      $c->add($crit0);  
    }
    

    $criterion = $c->getNewCriterion(OpTagHasOpOpinableContentPeer::TAG_ID, $tag_id, Criteria::IN);
    $c->add($criterion);
    //$c->setDistinct();
    //$pager = new sfPropelPager('OpDeclaration', sfConfig::get('app_query_max'));
    //$pager->setCriteria($c);
    //$pager->setPage($page);
    //$pager->init();
    //return $pager;
	if ($limit)
	  $c->setLimit(sfConfig::get('app_declarations_limit'));
    
	$declarations = OpDeclarationPeer::doSelect($c);
	return $declarations;
  }
	
	public static function getPopulars($page)
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(OpDeclarationPeer::RELEVANCY_SCORE);
	    
		// tags
		$c->addJoin(self::CONTENT_ID, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addJoin(self::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addJoin(self::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c->setDistinct();
	
		$pager = new sfPropelPager('OpDeclaration', sfConfig::get('app_query_max'));
		$pager->setCriteria($c);
		$pager->setPage($page);
		$pager->init();
	
		return $pager;
	}
	
	public static function getLatest($page)
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c->setLimit(5);
		$c->setDistinct();
		
		$pager = new sfPropelPager('OpDeclaration', sfConfig::get('app_query_max'));
		$pager->setCriteria($c);
		$pager->setPeerMethod('doSelectJoinOpPoliticianJoinOpOpenContentJoinOpUser');
		$pager->setPage($page);
		$pager->init();
		
		return $pager;
	}
	
	/**
	 * Selects a collection of OpDeclaration objects pre-filled with their OpOpenContent objects.
	 *
	 * @return array Array of OpDeclaration objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinOpOpenContent(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpDeclarationPeer::addSelectColumns($c);
		$startcol = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpenContentPeer::addSelectColumns($c);

		$c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpOpenContent(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addOpDeclaration($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initOpDeclarations();
				$obj2->addOpDeclaration($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}
	
	public static function doSelectJoinOpPoliticianJoinOpOpenContentJoinOpUser(Criteria $c, $con = null)
	{
		$c = clone $c;
	
		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}
	
		// Add select columns for OpInstitutionCharge
		OpDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
	
		// Add select columns for OpPolitician
		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS ;
		
		// Add select columns for OpOpenContent
		OpOpenContentPeer::addSelectColumns($c);
		//$startcol4 = $startcol3 + OpOpenContentPeer::NUM_COLUMNS ;
		
		// Add select columns for OpUser
		//OpUserPeer::addSelectColumns($c);
							
		// Join methods (uso il criterio left_join so voglio il risultato anche se il campo join è vuoto
		$c->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
		//$c->addJoin(OpUserPeer::ID, OpOpenContentPeer::USER_ID);
		
			
		$rs = BasePeer::doSelect($c, $con);
		$results = array();
	
		while($rs->next())
		{
		  // Hydrate the OpDeclaration object
		  $omClass = OpDeclarationPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj1 = new $cls();
		  $obj1->hydrate($rs);
	
		  // Hydrate the OpPolitician object
		  $omClass = OpPoliticianPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj2 = new $cls();
		  $obj2->hydrate($rs, $startcol2);
		  
		  // Hydrate the OpOpenContent object
		  $omClass = OpOpenContentPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj3 = new $cls();
		  $obj3->hydrate($rs, $startcol3);
		  
		  // Hydrate the OpUser object
		  //$omClass = OpUserPeer::getOMClass();
	
		  //$cls = Propel::import($omClass);
		  //$obj4 = new $cls();
		  //$obj4->hydrate($rs, $startcol4);
	
		  // 
		  $obj1->setOpPolitician($obj2);
		  $obj1->setOpOpenContent($obj3);
		  //$obj1->setOpUser($obj4);
		  $results[] = $obj1;
		}
			
		return $results;
	}
	  
	public static function getPopularsForInstitution($institution_id, $max=20)
	{
		$declarations = array();
		$not_deleted_string = '\'0000-00-00 00:00:00\'';
 
  		$con = Propel::getConnection();
  		$query = '
    	SELECT DISTINCT '.OpDeclarationPeer::CONTENT_ID.', '.OpDeclarationPeer::POLITICIAN_ID.
		', '.OpDeclarationPeer::DATE.', '.OpDeclarationPeer::TITLE.', '.OpDeclarationPeer::TEXT.
		', '.OpDeclarationPeer::RELEVANCY_SCORE.', '.OpDeclarationPeer::SOURCE_NAME.', '.OpDeclarationPeer::SOURCE_URL.
		', '.OpDeclarationPeer::SOURCE_FILE.', '.OpDeclarationPeer::SOURCE_MIME.', '.OpDeclarationPeer::SOURCE_SIZE.
		', '.OpDeclarationPeer::SLUG.
        ' FROM '.OpDeclarationPeer::TABLE_NAME.
		' INNER JOIN '
		.OpOpenContentPeer::TABLE_NAME.' ON	'
		.OpOpenContentPeer::CONTENT_ID.'='
		.OpDeclarationPeer::CONTENT_ID.
		' INNER JOIN '
		.OpInstitutionChargePeer::TABLE_NAME.' ON '
		.OpInstitutionChargePeer::POLITICIAN_ID.'='
		.OpDeclarationPeer::POLITICIAN_ID.
		' INNER JOIN '
		.OpOpenContentPeer::TABLE_NAME.' AS institutionContent ON institutionContent.CONTENT_ID ='
		.OpInstitutionChargePeer::CONTENT_ID.
		' WHERE	institutionContent.DELETED_AT IS NULL AND '
		.OpOpenContentPeer::DELETED_AT.
		 ' IS NULL AND '
		.OpOpenContentPeer::DELETED_AT.' IS NULL
		AND '.OpInstitutionChargePeer::DATE_END.' IS NULL AND '
		.OpInstitutionChargePeer::INSTITUTION_ID.'=\''.$institution_id.
		'\' ORDER BY date DESC LIMIT '.$max;
 
  		$stmt = $con->createStatement();
    	$rs = $stmt->executeQuery($query, ResultSet::FETCHMODE_NUM);
		
		return parent::populateObjects($rs);		
	}
	
	public static function getPopularsForLocation($location_id, $routing, $max=20)
	{
		$declarations = array();
		$not_deleted_string = '\'0000-00-00 00:00:00\'';
 
  		$con = Propel::getConnection();
  		$query = '
    	SELECT DISTINCT '.OpDeclarationPeer::CONTENT_ID.', '.OpDeclarationPeer::POLITICIAN_ID.
		', '.OpDeclarationPeer::DATE.', '.OpDeclarationPeer::TITLE.', '.OpDeclarationPeer::TEXT.
		', '.OpDeclarationPeer::RELEVANCY_SCORE.', '.OpDeclarationPeer::SOURCE_NAME.', '.OpDeclarationPeer::SOURCE_URL.
		', '.OpDeclarationPeer::SOURCE_FILE.', '.OpDeclarationPeer::SOURCE_MIME.', '.OpDeclarationPeer::SOURCE_SIZE.
		', '.OpDeclarationPeer::SLUG.
        ' FROM '.OpDeclarationPeer::TABLE_NAME.
		' INNER JOIN '
		.OpOpenContentPeer::TABLE_NAME.' ON	'
		.OpOpenContentPeer::CONTENT_ID.'='
		.OpDeclarationPeer::CONTENT_ID.
		' INNER JOIN '
		.OpInstitutionChargePeer::TABLE_NAME.' ON '
		.OpInstitutionChargePeer::POLITICIAN_ID.'='
		.OpDeclarationPeer::POLITICIAN_ID.
		' INNER JOIN '
		.OpInstitutionPeer::TABLE_NAME.' ON '
		.OpInstitutionPeer::ID.'='
		.OpInstitutionChargePeer::INSTITUTION_ID.
		' INNER JOIN '
		.OpOpenContentPeer::TABLE_NAME.' AS institutionContent ON institutionContent.CONTENT_ID ='
		.OpInstitutionChargePeer::CONTENT_ID.
		' WHERE	institutionContent.DELETED_AT IS NULL AND '
		.OpOpenContentPeer::DELETED_AT.
		 ' IS NULL AND '.OpInstitutionChargePeer::DATE_END.' IS NULL AND 
		'.OpInstitutionChargePeer::LOCATION_ID.'=\''.$location_id.'\'';
		
		switch($routing)
		{
			case 'politician/regPoliticians':
				$query.=' AND ('.OpinstitutionPeer::NAME.'=\'Giunta Regionale\' OR '.OpinstitutionPeer::NAME.'=\'Consiglio Regionale\')';
				break;
			case 'politician/provPoliticians':
				$query.=' AND ('.OpinstitutionPeer::NAME.'=\'Giunta Provinciale\' OR '.OpinstitutionPeer::NAME.'=\'Consiglio Provinciale\')';
				break;
			case 'politician/munPoliticians':
				$query.=' AND ('.OpinstitutionPeer::NAME.'=\'Giunta Comunale\' OR '.OpinstitutionPeer::NAME.'=\'Consiglio Comunale\')';
				break;			
		}
		
		$query.=' ORDER BY date DESC LIMIT '.$max;
 
  		$stmt = $con->createStatement();
    	$rs = $stmt->executeQuery($query, ResultSet::FETCHMODE_NUM);
		
		return parent::populateObjects($rs);		
	}
	
	public static function doSelectForPoliticianGroupedByUser($politician_id, $max = 9)
	{
	  $users = array();
	  
      $con = Propel::getConnection();
      $query = 'SELECT '.OpUserPeer::SHA1_PASSWORD.' as hash '.
	           ', '.OpOpenContentPeer::USER_ID.' as user_id '.
	           ', COUNT('.OpOpenContentPeer::USER_ID.
			   ') as cont FROM '.OpDeclarationPeer::TABLE_NAME.
			   ' LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.
			   ' ON '.OpDeclarationPeer::CONTENT_ID.
			   ' = '.OpOpenContentPeer::CONTENT_ID.
			   ' LEFT JOIN '.OpUserPeer::TABLE_NAME.
			   ' ON '.OpOpenContentPeer::USER_ID.
			   ' = '.OpUserPeer::ID.
			   ' WHERE ('.OpDeclarationPeer::POLITICIAN_ID.
			   ' = \''.$politician_id.'\' AND '.OpOpenContentPeer::DELETED_AT.
			   ' is null) GROUP BY '.OpOpenContentPeer::USER_ID.
			   ' ORDER BY cont DESC';

      $stmt = $con->prepareStatement($query);
      $stmt->setLimit($max);
      $rs = $stmt->executeQuery();
	  
	  while ($rs->next())
    {
	    $users[$rs->getInt('user_id')] = $rs->getInt('cont');
	  }
	  return $users;		   
	}
	
	public static function doSelectForLocationGroupedByUser($location_id, $max = 9)
	{
	  $users = array();
	  
      $con = Propel::getConnection();
      /*
	  $query = 'SELECT '.OpUserPeer::ID.' as user_id '.
	           ', COUNT('.OpOpenContentPeer::USER_ID.
			   ') as cont FROM '.OpDeclarationPeer::TABLE_NAME.
			   ' LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.
			   ' ON '.OpDeclarationPeer::CONTENT_ID.
			   ' = '.OpOpenContentPeer::CONTENT_ID.
			   ' LEFT JOIN '.OpUserPeer::TABLE_NAME.
			   ' ON '.OpOpenContentPeer::USER_ID.
			   ' = '.OpUserPeer::ID.
			   ' LEFT JOIN '.OpInstitutionChargePeer::TABLE_NAME.
			   ' ON '.OpInstitutionChargePeer::POLITICIAN_ID.
			   ' = '.OpDeclarationPeer::POLITICIAN_ID.
			   ' LEFT JOIN '.OpInstitutionPeer::TABLE_NAME.
			   ' ON '.OpInstitutionPeer::ID.
			   ' = '.OpInstitutionChargePeer::INSTITUTION_ID.
			   ' WHERE ('.OpOpenContentPeer::DELETED_AT.
			   ' IS NULL AND '.OpInstitutionChargePeer::DATE_END.
			   ' IS NULL AND '.OpInstitutionChargePeer::LOCATION_ID.
			   ' = '.$location_id.') GROUP BY '.OpOpenContentPeer::USER_ID.
			   ' ORDER BY cont DESC';
      */
	  $query = 'SELECT '.OpOpenContentPeer::USER_ID.' as user_id, COUNT('.OpOpenContentPeer::USER_ID.
	           ') as cont from '.OpOpenContentPeer::TABLE_NAME.' INNER JOIN (SELECT DISTINCT 
			   '.OpDeclarationPeer::CONTENT_ID.' AS contentid, '.OpOpenContentPeer::USER_ID.
			   ', '.OpDeclarationPeer::TITLE.' FROM '.OpDeclarationPeer::TABLE_NAME.
			   ' INNER JOIN '.OpOpenContentPeer::TABLE_NAME.' ON '.OpOpenContentPeer::CONTENT_ID.
			   '= '.OpDeclarationPeer::CONTENT_ID.' INNER JOIN '.OpInstitutionChargePeer::TABLE_NAME.
			   ' ON '.OpInstitutionChargePeer::POLITICIAN_ID.'='.OpDeclarationPeer::POLITICIAN_ID.
			   ' INNER JOIN '.OpInstitutionPeer::TABLE_NAME.' ON '.OpInstitutionPeer::ID.
			   '= '.OpInstitutionChargePeer::INSTITUTION_ID.' INNER JOIN '.OpOpenContentPeer::TABLE_NAME.
			   ' AS institutionContent ON institutionContent.CONTENT_ID = '.OpInstitutionchargePeer::CONTENT_ID.
			   ' WHERE institutionContent.DELETED_AT IS NULL AND '.OpOpenContentPeer::DELETED_AT .
			   ' IS NULL AND '.OpInstitutionChargePeer::DATE_END.' IS NULL AND 
			   '.OpInstitutionChargePeer::LOCATION_ID.'='.$location_id.
			   ') AS declaration ON declaration.contentid='.OpOpenContentPeer::CONTENT_ID.
			   ' GROUP BY '. OpOpenContentPeer::USER_ID.' DESC ORDER BY CONT DESC';
      $stmt = $con->prepareStatement($query);
      $stmt->setLimit($max);
      $rs = $stmt->executeQuery();
	  
	  while ($rs->next())
      {
	    $users[$rs->getInt('user_id')] = $rs->getInt('cont');
	  }
	  return $users;		   
	}
	
	public static function doSelectForTagGroupedByUser($tag_id, $max = 9)
	{
	  $users = array();
	  
      $con = Propel::getConnection();
      $query = 'SELECT '.OpUserPeer::ID.' as user_id '.
	           ', COUNT('.OpOpenContentPeer::USER_ID.
			   ') as cont FROM '.OpDeclarationPeer::TABLE_NAME.
			   ' LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.
			   ' ON '.OpDeclarationPeer::CONTENT_ID.
			   ' = '.OpOpenContentPeer::CONTENT_ID.
			   ' LEFT JOIN '.OpUserPeer::TABLE_NAME.
			   ' ON '.OpOpenContentPeer::USER_ID.
			   ' = '.OpUserPeer::ID.
			   ' LEFT JOIN '.OpOpinableContentPeer::TABLE_NAME.
			   ' ON '.OpOpinableContentPeer::CONTENT_ID.
			   ' = '.OpOpenContentPeer::CONTENT_ID.
			   ' LEFT JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
			   ' ON '.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
			   ' = '.OpOpenContentPeer::CONTENT_ID.
			   ' WHERE ('.OpOpenContentPeer::DELETED_AT.
			   ' IS NULL AND '.OpTagHasOpOpinableContentPeer::TAG_ID.
			   ' = '.$tag_id.') GROUP BY '.OpOpenContentPeer::USER_ID.
			   ' ORDER BY cont DESC';

      $stmt = $con->prepareStatement($query);
      $stmt->setLimit($max);
      $rs = $stmt->executeQuery();
	  
	  while ($rs->next())
      {
	    $users[$rs->getInt('user_id')] = $rs->getInt('cont');
	  }
	  return $users;		   
	}		

	
} // OpDeclarationPeer
?>
