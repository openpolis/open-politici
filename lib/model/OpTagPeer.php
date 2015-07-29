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
  require_once 'lib/model/om/BaseOpTagPeer.php';
  
  // include object class
  include_once 'lib/model/OpTag.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_report' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpTagPeer extends BaseOpTagPeer
{
  
  /**
   * torna tutti i tag che hanno come valore di stringa quella passata per parametro
   * non è enforced l'unicità su questa colonna, quindi potrebbero essere più di un tag
   *
   * @param string $value 
   * @return void
   * @author Guglielmo Celata
   */
  public static function getByTagName($value)
  {
    $c = new Criteria();
    $c->add(OpTagPeer::TAG, $value);
    
    return self::doSelect($c);
  }
  
  public static function getPopularTags($max = 30, $period = 'all')
  {
    $tags = array();
    $not_deleted_string = '\'0000-00-00 00:00:00\'';
    $con = Propel::getConnection();

    $query = 'SELECT '.OpTagPeer::TAG.' AS tag,
	         '.OpTagPeer::UPDATED_AT.' AS updated_at, 
			 '.OpTagPeer::NORMALIZED_TAG.' AS normalized_tag,       
             '.OpTagPeer::ID.' AS tagid, COUNT('.OpTagPeer::NORMALIZED_TAG.') AS cont FROM 
			 '.OpTagPeer::TABLE_NAME.
             ' INNER JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
             ' ON '.OpTagPeer::ID.'='.OpTagHasOpOpinableContentPeer::TAG_ID.
             ' INNER JOIN '.OpOpenContentPeer::TABLE_NAME.
             ' ON '.OpOpenContentPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' WHERE '.OpOpenContentPeer::DELETED_AT.
             ' IS NULL AND '.OpTagHasOpOpinableContentPeer::IS_OBSCURED.'=0';
    if ($period!='all')
      $query.=' AND '.OpTagPeer::UPDATED_AT.'>\''.$period.'\'';

    $query.=' GROUP BY '.OpTagPeer::NORMALIZED_TAG.' ORDER BY cont DESC';
    
    
    $stmt = $con->prepareStatement($query);
    if ($max > 0)
      $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;
    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $tags[$rs->getString('normalized_tag').'%'.$rs->getString('tag').'_'.$rs->getInt('tagid').'-'.$rs->getInt('cont').'*'.$rs->getString('updated_at')]=floor(($rs->getInt('cont') / $max_popularity * (sfConfig::get('app_tag_popularity_degrees'))) + 1);
    }
    ksort($tags);
    return $tags;
  }

  public static function getPoliticians($tag_id, $max = 10, $period = 'all')
  {
    $politicians = array();
    $con = Propel::getConnection();
    $query = 'SELECT '.OpPoliticianPeer::LAST_NAME.
	         ' AS name, '.OpPoliticianPeer::CONTENT_ID.' as id, COUNT('.OpPoliticianPeer::LAST_NAME.
			 ') AS cont, '.OpDeclarationPeer::DATE.
			 ' AS date FROM '.OpPoliticianPeer::TABLE_NAME.
             ' LEFT JOIN '.OpDeclarationPeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::POLITICIAN_ID.'='.OpPoliticianPeer::CONTENT_ID.
             ' LEFT JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
             ' ON '.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.'='.OpDeclarationPeer::CONTENT_ID.
             ' WHERE '.OpTagHasOpOpinableContentPeer::TAG_ID.'='.$tag_id;
    if ($period!='all')
      $query.=' AND '.OpDeclarationPeer::DATE.' >\''.$period.'\'';			 

    $query.= ' GROUP BY '.OpPoliticianPeer::LAST_NAME.
             ' ORDER BY cont DESC';
 
    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;
    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $politicians[$rs->getString('name').'_'.$rs->getInt('id').'-'.$rs->getInt('cont').'*'.$rs->getString('date')] = floor(($rs->getInt('cont') / $max_popularity * sfConfig::get('app_tag_popularity_degrees')) + 1);
    }
    ksort($politicians);
    return $politicians;
  }
	
  public static function getTagsForPolitician($politician_id, $max = 20, $period = 'all')
  {
    $tags = array();
    $con = Propel::getConnection();
    $query = 'SELECT '.OpTagPeer::TAG.' AS tag,
	         '.OpTagPeer::NORMALIZED_TAG.' AS normalized_tag, 
	         '.OpTagPeer::UPDATED_AT.' AS updated_at,       
             '.OpTagPeer::ID.' AS tagid, COUNT('.OpTagPeer::NORMALIZED_TAG.') AS cont,
             '.OpTagHasOpOpinableContentPeer::USER_ID. ' As user FROM 
             '.OpTagPeer::TABLE_NAME.
             ' INNER JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
             ' ON '.OpTagPeer::ID.'='.OpTagHasOpOpinableContentPeer::TAG_ID.
             ' INNER JOIN '.OpOpenContentPeer::TABLE_NAME.
             ' ON '.OpOpenContentPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' INNER JOIN '.OpDeclarationPeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' WHERE '.OpOpenContentPeer::DELETED_AT.
             ' IS NULL AND '.OpTagHasOpOpinableContentPeer::IS_OBSCURED.
             '=0 AND '.OpDeclarationPeer::POLITICIAN_ID.'='.$politician_id;
    if ($period!='all')
      $query.= ' AND '.OpTagPeer::UPDATED_AT.'>\''.$period.'\'';

      $query.= ' GROUP BY '.OpTagPeer::NORMALIZED_TAG.
               ' ORDER BY cont DESC';
 
    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;
    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $tags[$rs->getString('normalized_tag').'%'.$rs->getString('tag').'_'.$rs->getInt('tagid').'-'.$rs->getInt('cont').'*'.$rs->getString('updated_at')]=floor(($rs->getInt('cont') / $max_popularity * (sfConfig::get('app_tag_popularity_degrees'))) + 1);
    }
    ksort($tags);
    return $tags;
  }
	
  public static function getInstitutionTags($institution_id, $max = 20, $period = 'all')
  {
    $tags = array();
    $con = Propel::getConnection();
    $query = 'SELECT '.OpTagPeer::TAG.' AS tag,
	         '.OpTagPeer::NORMALIZED_TAG.' AS normalized_tag, 
	         '.OpTagPeer::UPDATED_AT.' AS updated_at,  
             '.OpTagPeer::ID.' AS tagid, COUNT('.OpTagPeer::NORMALIZED_TAG.') AS cont,
             '.OpTagHasOpOpinableContentPeer::USER_ID. ' As user FROM 
             '.OpTagPeer::TABLE_NAME.' INNER JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
             ' ON '.OpTagPeer::ID.'='.OpTagHasOpOpinableContentPeer::TAG_ID.
             ' INNER JOIN '.OpOpenContentPeer::TABLE_NAME.
             ' ON '.OpOpenContentPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' INNER JOIN '.OpDeclarationPeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' INNER JOIN '.OpInstitutionChargePeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::POLITICIAN_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID.
             ' WHERE '.OpOpenContentPeer::DELETED_AT.
             ' IS NULL AND '.OpTagHasOpOpinableContentPeer::IS_OBSCURED.
             '=0 AND '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id.
             ' AND '.OpInstitutionChargePeer::DATE_END.' IS NULL ';
    if ($period!='all')
        $query.=' AND '.OpTagPeer::UPDATED_AT.'>\''.$period.'\'';

    $query.=' GROUP BY '.OpTagPeer::NORMALIZED_TAG.
            ' ORDER BY cont DESC';

    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;
    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $tags[$rs->getString('normalized_tag').'%'.$rs->getString('tag').'_'.$rs->getInt('tagid').'§'.$rs->getInt('cont').'*'.$rs->getString('updated_at')]=floor(($rs->getInt('cont') / $max_popularity * sfConfig::get('app_tag_popularity_degrees')) + 1);
    }
    ksort($tags);
    return $tags;
  }

  public static function getLocationTags($location_id, $routing, $max = 20, $period = 'all')
  {
    $tags = array();
    $con = Propel::getConnection();
	$query = 'SELECT '.OpTagPeer::TAG.' AS tag, 
	'.OpTagPeer::NORMALIZED_TAG.' AS normalized_tag, 
	'.OpTagPeer::UPDATED_AT.' AS updated_at, 
	'.OpTagPeer::ID.' AS tagid, COUNT('.OpTagPeer::NORMALIZED_TAG.') AS cont FROM 
	'.OpTagHasOpOpinableContentPeer::TABLE_NAME.' INNER JOIN ( SELECT DISTINCT 
	'.OpDeclarationPeer::CONTENT_ID .' AS contentid, 
	'.OpDeclarationPeer::TITLE.' FROM 
	'.OpDeclarationPeer::TABLE_NAME.' INNER JOIN 
	'.OpOpenContentPeer::TABLE_NAME.' ON 
	'.OpOpenContentPeer::CONTENT_ID.'=
	'.OpDeclarationPeer::CONTENT_ID.' INNER JOIN 
	'.OpInstitutionChargePeer::TABLE_NAME.' ON 
	'.OpInstitutionChargePeer::POLITICIAN_ID.'=
	'.OpDeclarationPeer::POLITICIAN_ID.' INNER JOIN 
	'.OpInstitutionPeer::TABLE_NAME.' ON 
	'.OpInstitutionPeer::ID.'=
	'.OpInstitutionChargePeer::INSTITUTION_ID.' INNER JOIN 
	'.OpOpenContentPeer::TABLE_NAME.' AS institutionContent ON institutionContent.CONTENT_ID =
	'.OpInstitutionChargePeer::CONTENT_ID.' WHERE institutionContent.DELETED_AT IS NULL AND 
	'.OpOpenContentPeer::DELETED_AT.' IS NULL AND 
	'.OpInstitutionChargePeer::DATE_END.' IS NULL AND 
	'.OpInstitutionChargePeer::LOCATION_ID.'='.$location_id.') AS table1 ON table1.contentid=
	'.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.' INNER JOIN 
	'.OpTagPeer::TABLE_NAME.' ON 
	'.OpTagPeer::ID.' = 
	'.OpTagHasOpOpinableContentPeer::TAG_ID.' WHERE 
	'.OpTagHasOpOpinableContentPeer::IS_OBSCURED.'=0';
	
	if ($period!='all')
        $query.=' AND '.OpTagPeer::UPDATED_AT.'>\''.$period.'\'';
		
	$query.=' GROUP BY '.OpTagPeer::TAG.' ORDER BY cont DESC';	
		
	/*
    $query = 'SELECT '.OpTagPeer::TAG.' AS tag,
	         '.OpTagPeer::NORMALIZED_TAG.' AS normalized_tag,
	         '.OpTagPeer::UPDATED_AT.' AS updated_at,
             '.OpTagPeer::ID.' AS tagid, COUNT('.OpTagPeer::NORMALIZED_TAG.') AS cont,
             '.OpTagHasOpOpinableContentPeer::USER_ID. 
             ' As user FROM '.OpTagPeer::TABLE_NAME.
             ' INNER JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
             ' ON '.OpTagPeer::ID.'='.OpTagHasOpOpinableContentPeer::TAG_ID.
             ' INNER JOIN '.OpOpenContentPeer::TABLE_NAME.
             ' ON '.OpOpenContentPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' INNER JOIN '.OpDeclarationPeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.
             ' INNER JOIN '.OpInstitutionChargePeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::POLITICIAN_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID.
             ' INNER JOIN '.OpInstitutionPeer::TABLE_NAME.
             ' ON '.OpInstitutionPeer::ID.'='.OpInstitutionChargePeer::INSTITUTION_ID.
             ' WHERE '.OpOpenContentPeer::DELETED_AT.
             ' IS NULL AND '.OpTagHasOpOpinableContentPeer::IS_OBSCURED.
             '=0 AND '.OpInstitutionChargePeer::LOCATION_ID.'='.$location_id;
		
    switch($routing)
    {
      case 'politician/regPoliticians':
        $query.=' AND ('.OpinstitutionPeer::NAME.'=\'Giunta regionale\' OR '.OpinstitutionPeer::NAME.'=\'Consiglio regionale\')';
        break;
      case 'politician/provPoliticians':
        $query.=' AND ('.OpinstitutionPeer::NAME.'=\'Giunta provinciale\' OR '.OpinstitutionPeer::NAME.'=\'Consiglio provinciale\')';
        break;
      case 'politician/munPoliticians':
        $query.=' AND ('.OpinstitutionPeer::NAME.'=\'Giunta comunale\' OR '.OpinstitutionPeer::NAME.'=\'Consiglio comunale\')';
        break;			
    }
	
    if ($period!='all')
        $query.=' AND '.OpTagPeer::UPDATED_AT.'>\''.$period.'\'';
					
    $query.=' AND '.OpInstitutionChargePeer::DATE_END.
            ' IS NULL GROUP BY '.OpTagPeer::NORMALIZED_TAG.
            ' ORDER BY cont DESC';
*/
    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;

    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $tags[$rs->getString('normalized_tag').'%'.$rs->getString('tag').'_'.$rs->getInt('tagid').'§'.$rs->getInt('cont').'*'.$rs->getString('updated_at')]=floor(($rs->getInt('cont') / $max_popularity * sfConfig::get('app_tag_popularity_degrees')) + 1);
    }
    ksort($tags);
    return $tags;
  }

  public static function getMyTags($user_id=0)
  {
    $tags = array();
    $con = Propel::getConnection();
    $query = 'SELECT '.OpTagPeer::TAG.' AS tag,
		'.OpTagPeer::ID.' AS tagid
		FROM '.OpTagPeer::TABLE_NAME.'
		INNER JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.'
		ON '.OpTagPeer::ID.'='.OpTagHasOpOpinableContentPeer::TAG_ID.'
		INNER JOIN '.OpOpenContentPeer::TABLE_NAME.'
		ON '.OpOpenContentPeer::CONTENT_ID.'='.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.'
		WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL
		AND '.OpTagHasOpOpinableContentPeer::IS_OBSCURED.'=0
		AND '.OpTagHasOpOpinableContentPeer::USER_ID.'='.$user_id.'  
		GROUP BY '.OpTagPeer::NORMALIZED_TAG;
	 
	  $stmt = $con->prepareStatement($query);
  	  $rs = $stmt->executeQuery();
  	  
	  while ($rs->next())
	  {
  			$tags[$rs->getString('tag')]=$rs->getInt('tagid');
	  }
  
 	  return $tags;
	}
  
  public static function getLastUpdated()
  {
    $c = new Criteria();
	$c->AddJoin(OpTagPeer::ID, OpTagHasOpOpinableContentPeer::TAG_ID, Criteria::LEFT_JOIN);
	$c->addDescendingOrderByColumn(OpTagPeer::UPDATED_AT);
	$c->Add(OpTagHasOpOpinableContentPeer::IS_OBSCURED, 0, Criteria::EQUAL);
	$last_updated_tag = OpTagPeer::doSelectOne($c);
    
	return $last_updated_tag->getUpdatedAt();
  }
  
  public static function getCorrelatedTags($tag_id)
  {
    $c = new Criteria();
    $c->Add(OpTagHasOpOpinableContentPeer::IS_OBSCURED,0, Criteria::EQUAL);	
    $c->Add(OpTagHasOpOpinableContentPeer::TAG_ID, $tag_id, Criteria::EQUAL);

    $tag_has_opinable_contents = OpTagHasOpOpinableContentPeer::doSelect($c);
	
	$tags = array();
    $con = Propel::getConnection();
    $query = 'SELECT '.OpTagPeer::ID.
	         ' AS tagid, '.OpTagPeer::TAG.
	         ' AS tag, count('.OpTagHasOpOpinableContentPeer::TAG_ID.
			 ') AS cont, '.OpTagPeer::UPDATED_AT.
			 ' AS updated_at FROM '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
			 ', '.OpTagPeer::TABLE_NAME.
			 ' WHERE (';
			 
	foreach ($tag_has_opinable_contents as $tag_has_opinable_content)
	{
	  $query.= OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.' = '.$tag_has_opinable_content->getOpinableContentId().' OR ';
	}
	
	$query.= '0) AND '.OpTagHasOpOpinableContentPeer::TAG_ID.' <> '.$tag_id.
	         ' AND '.OpTagHasOpOpinablecontentPeer::TAG_ID.'='.OpTagPeer::ID.
			 ' AND '.OpTagHasOpOpinableContentPeer::IS_OBSCURED.
			 '=0 GROUP BY '.OpTagHasOpOpinableContentPeer::TAG_ID;	
    
	
	$stmt = $con->prepareStatement($query);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;

    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $tags[$rs->getString('tag').'_'.$rs->getInt('tagid').'-'.$rs->getInt('cont').'*'.$rs->getString('updated_at')]=floor(($rs->getInt('cont') / $max_popularity * sfConfig::get('app_tag_popularity_degrees')) + 1);
    }
    ksort($tags);
    return $tags;

			
  } 
}
?>