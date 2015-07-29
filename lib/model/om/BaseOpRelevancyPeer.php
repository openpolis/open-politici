<?php


abstract class BaseOpRelevancyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_relevancy';

	
	const CLASS_DEFAULT = 'lib.model.OpRelevancy';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_relevancy.CONTENT_ID';

	
	const USER_ID = 'op_relevancy.USER_ID';

	
	const SCORE = 'op_relevancy.SCORE';

	
	const CREATED_AT = 'op_relevancy.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'UserId', 'Score', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (OpRelevancyPeer::CONTENT_ID, OpRelevancyPeer::USER_ID, OpRelevancyPeer::SCORE, OpRelevancyPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'user_id', 'score', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'UserId' => 1, 'Score' => 2, 'CreatedAt' => 3, ),
		BasePeer::TYPE_COLNAME => array (OpRelevancyPeer::CONTENT_ID => 0, OpRelevancyPeer::USER_ID => 1, OpRelevancyPeer::SCORE => 2, OpRelevancyPeer::CREATED_AT => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'user_id' => 1, 'score' => 2, 'created_at' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpRelevancyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpRelevancyMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpRelevancyPeer::getTableMap();
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
		return str_replace(OpRelevancyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpRelevancyPeer::CONTENT_ID);

		$criteria->addSelectColumn(OpRelevancyPeer::USER_ID);

		$criteria->addSelectColumn(OpRelevancyPeer::SCORE);

		$criteria->addSelectColumn(OpRelevancyPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(op_relevancy.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_relevancy.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpRelevancyPeer::doSelectRS($criteria, $con);
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
		$objects = OpRelevancyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpRelevancyPeer::populateObjects(OpRelevancyPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpRelevancyPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpRelevancyPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpRelevancyPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpRelevancyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpRelevancyPeer::USER_ID, OpUserPeer::ID);

		$rs = OpRelevancyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpRelevancyPeer::addSelectColumns($c);
		$startcol = (OpRelevancyPeer::NUM_COLUMNS - OpRelevancyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpinableContentPeer::addSelectColumns($c);

		$c->addJoin(OpRelevancyPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpRelevancyPeer::getOMClass();

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
										$temp_obj2->addOpRelevancy($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpRelevancys();
				$obj2->addOpRelevancy($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpRelevancyPeer::addSelectColumns($c);
		$startcol = (OpRelevancyPeer::NUM_COLUMNS - OpRelevancyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpRelevancyPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpRelevancyPeer::getOMClass();

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
										$temp_obj2->addOpRelevancy($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpRelevancys();
				$obj2->addOpRelevancy($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpRelevancyPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$criteria->addJoin(OpRelevancyPeer::USER_ID, OpUserPeer::ID);

		$rs = OpRelevancyPeer::doSelectRS($criteria, $con);
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

		OpRelevancyPeer::addSelectColumns($c);
		$startcol2 = (OpRelevancyPeer::NUM_COLUMNS - OpRelevancyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpinableContentPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpRelevancyPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$c->addJoin(OpRelevancyPeer::USER_ID, OpUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpRelevancyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpRelevancy($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpRelevancys();
				$obj2->addOpRelevancy($obj1);
			}


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpRelevancy($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpRelevancys();
				$obj3->addOpRelevancy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpRelevancyPeer::USER_ID, OpUserPeer::ID);

		$rs = OpRelevancyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpRelevancyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpRelevancyPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpRelevancyPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpRelevancyPeer::addSelectColumns($c);
		$startcol2 = (OpRelevancyPeer::NUM_COLUMNS - OpRelevancyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpRelevancyPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpRelevancyPeer::getOMClass();

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
					$temp_obj2->addOpRelevancy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpRelevancys();
				$obj2->addOpRelevancy($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpRelevancyPeer::addSelectColumns($c);
		$startcol2 = (OpRelevancyPeer::NUM_COLUMNS - OpRelevancyPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpinableContentPeer::NUM_COLUMNS;

		$c->addJoin(OpRelevancyPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpRelevancyPeer::getOMClass();

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
					$temp_obj2->addOpRelevancy($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpRelevancys();
				$obj2->addOpRelevancy($obj1);
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
		return OpRelevancyPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(OpRelevancyPeer::CONTENT_ID);
			$selectCriteria->add(OpRelevancyPeer::CONTENT_ID, $criteria->remove(OpRelevancyPeer::CONTENT_ID), $comparison);

			$comparison = $criteria->getComparison(OpRelevancyPeer::USER_ID);
			$selectCriteria->add(OpRelevancyPeer::USER_ID, $criteria->remove(OpRelevancyPeer::USER_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpRelevancyPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpRelevancyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpRelevancy) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(OpRelevancyPeer::CONTENT_ID, $vals[0], Criteria::IN);
			$criteria->add(OpRelevancyPeer::USER_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpRelevancy $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpRelevancyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpRelevancyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpRelevancyPeer::DATABASE_NAME, OpRelevancyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpRelevancyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $content_id, $user_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpRelevancyPeer::CONTENT_ID, $content_id);
		$criteria->add(OpRelevancyPeer::USER_ID, $user_id);
		$v = OpRelevancyPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpRelevancyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpRelevancyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpRelevancyMapBuilder');
}
