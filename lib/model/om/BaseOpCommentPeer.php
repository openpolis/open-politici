<?php


abstract class BaseOpCommentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_comment';

	
	const CLASS_DEFAULT = 'lib.model.OpComment';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const USER_ID = 'op_comment.USER_ID';

	
	const CONTENT_ID = 'op_comment.CONTENT_ID';

	
	const BODY = 'op_comment.BODY';

	
	const HTML_BODY = 'op_comment.HTML_BODY';

	
	const RELEVANCY_SCORE_UP = 'op_comment.RELEVANCY_SCORE_UP';

	
	const RELEVANCY_SCORE_DOWN = 'op_comment.RELEVANCY_SCORE_DOWN';

	
	const CREATED_AT = 'op_comment.CREATED_AT';

	
	const UPDATED_AT = 'op_comment.UPDATED_AT';

	
	const REPORTS = 'op_comment.REPORTS';

	
	const ID = 'op_comment.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UserId', 'ContentId', 'Body', 'HtmlBody', 'RelevancyScoreUp', 'RelevancyScoreDown', 'CreatedAt', 'UpdatedAt', 'Reports', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpCommentPeer::USER_ID, OpCommentPeer::CONTENT_ID, OpCommentPeer::BODY, OpCommentPeer::HTML_BODY, OpCommentPeer::RELEVANCY_SCORE_UP, OpCommentPeer::RELEVANCY_SCORE_DOWN, OpCommentPeer::CREATED_AT, OpCommentPeer::UPDATED_AT, OpCommentPeer::REPORTS, OpCommentPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'content_id', 'body', 'html_body', 'relevancy_score_up', 'relevancy_score_down', 'created_at', 'updated_at', 'reports', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'ContentId' => 1, 'Body' => 2, 'HtmlBody' => 3, 'RelevancyScoreUp' => 4, 'RelevancyScoreDown' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'Reports' => 8, 'Id' => 9, ),
		BasePeer::TYPE_COLNAME => array (OpCommentPeer::USER_ID => 0, OpCommentPeer::CONTENT_ID => 1, OpCommentPeer::BODY => 2, OpCommentPeer::HTML_BODY => 3, OpCommentPeer::RELEVANCY_SCORE_UP => 4, OpCommentPeer::RELEVANCY_SCORE_DOWN => 5, OpCommentPeer::CREATED_AT => 6, OpCommentPeer::UPDATED_AT => 7, OpCommentPeer::REPORTS => 8, OpCommentPeer::ID => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'content_id' => 1, 'body' => 2, 'html_body' => 3, 'relevancy_score_up' => 4, 'relevancy_score_down' => 5, 'created_at' => 6, 'updated_at' => 7, 'reports' => 8, 'id' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpCommentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpCommentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpCommentPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(OpCommentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpCommentPeer::USER_ID);

		$criteria->addSelectColumn(OpCommentPeer::CONTENT_ID);

		$criteria->addSelectColumn(OpCommentPeer::BODY);

		$criteria->addSelectColumn(OpCommentPeer::HTML_BODY);

		$criteria->addSelectColumn(OpCommentPeer::RELEVANCY_SCORE_UP);

		$criteria->addSelectColumn(OpCommentPeer::RELEVANCY_SCORE_DOWN);

		$criteria->addSelectColumn(OpCommentPeer::CREATED_AT);

		$criteria->addSelectColumn(OpCommentPeer::UPDATED_AT);

		$criteria->addSelectColumn(OpCommentPeer::REPORTS);

		$criteria->addSelectColumn(OpCommentPeer::ID);

	}

	const COUNT = 'COUNT(op_comment.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_comment.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = OpCommentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpCommentPeer::populateObjects(OpCommentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpCommentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpCommentPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpCommentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpCommentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpCommentPeer::addSelectColumns($c);
		$startcol = (OpCommentPeer::NUM_COLUMNS - OpCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpCommentPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpCommentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpComment($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpComments();
				$obj2->addOpComment($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpCommentPeer::addSelectColumns($c);
		$startcol = (OpCommentPeer::NUM_COLUMNS - OpCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpinableContentPeer::addSelectColumns($c);

		$c->addJoin(OpCommentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpCommentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOpinableContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpComment($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpComments();
				$obj2->addOpComment($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpCommentPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpCommentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpCommentPeer::addSelectColumns($c);
		$startcol2 = (OpCommentPeer::NUM_COLUMNS - OpCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpOpinableContentPeer::NUM_COLUMNS;

		$c->addJoin(OpCommentPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpCommentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpCommentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpComment($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpComments();
				$obj2->addOpComment($obj1);
			}


					
			$omClass = OpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpComment($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpComments();
				$obj3->addOpComment($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpCommentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpCommentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpCommentPeer::addSelectColumns($c);
		$startcol2 = (OpCommentPeer::NUM_COLUMNS - OpCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpinableContentPeer::NUM_COLUMNS;

		$c->addJoin(OpCommentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpCommentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpComment($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpComments();
				$obj2->addOpComment($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpCommentPeer::addSelectColumns($c);
		$startcol2 = (OpCommentPeer::NUM_COLUMNS - OpCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpCommentPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpCommentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpComment($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpComments();
				$obj2->addOpComment($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return OpCommentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpCommentPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(OpCommentPeer::ID);
			$selectCriteria->add(OpCommentPeer::ID, $criteria->remove(OpCommentPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(OpCommentPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(OpCommentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpComment) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpCommentPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(OpComment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpCommentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpCommentPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(OpCommentPeer::DATABASE_NAME, OpCommentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpCommentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(OpCommentPeer::DATABASE_NAME);

		$criteria->add(OpCommentPeer::ID, $pk);


		$v = OpCommentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(OpCommentPeer::ID, $pks, Criteria::IN);
			$objs = OpCommentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpCommentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpCommentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpCommentMapBuilder');
}
