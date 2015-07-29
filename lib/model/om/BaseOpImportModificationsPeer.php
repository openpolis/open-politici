<?php


abstract class BaseOpImportModificationsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_import_modifications';

	
	const CLASS_DEFAULT = 'lib.model.OpImportModifications';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const REC_TYPE = 'op_import_modifications.REC_TYPE';

	
	const CONTEXT = 'op_import_modifications.CONTEXT';

	
	const CSV_REC = 'op_import_modifications.CSV_REC';

	
	const ACTION_TYPE = 'op_import_modifications.ACTION_TYPE';

	
	const BLOCKED_AT = 'op_import_modifications.BLOCKED_AT';

	
	const CONCRETISED_AT = 'op_import_modifications.CONCRETISED_AT';

	
	const IMPORT_ID = 'op_import_modifications.IMPORT_ID';

	
	const LOCATION_ID = 'op_import_modifications.LOCATION_ID';

	
	const ID = 'op_import_modifications.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('RecType', 'Context', 'CsvRec', 'ActionType', 'BlockedAt', 'ConcretisedAt', 'ImportId', 'LocationId', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpImportModificationsPeer::REC_TYPE, OpImportModificationsPeer::CONTEXT, OpImportModificationsPeer::CSV_REC, OpImportModificationsPeer::ACTION_TYPE, OpImportModificationsPeer::BLOCKED_AT, OpImportModificationsPeer::CONCRETISED_AT, OpImportModificationsPeer::IMPORT_ID, OpImportModificationsPeer::LOCATION_ID, OpImportModificationsPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('rec_type', 'context', 'csv_rec', 'action_type', 'blocked_at', 'concretised_at', 'import_id', 'location_id', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('RecType' => 0, 'Context' => 1, 'CsvRec' => 2, 'ActionType' => 3, 'BlockedAt' => 4, 'ConcretisedAt' => 5, 'ImportId' => 6, 'LocationId' => 7, 'Id' => 8, ),
		BasePeer::TYPE_COLNAME => array (OpImportModificationsPeer::REC_TYPE => 0, OpImportModificationsPeer::CONTEXT => 1, OpImportModificationsPeer::CSV_REC => 2, OpImportModificationsPeer::ACTION_TYPE => 3, OpImportModificationsPeer::BLOCKED_AT => 4, OpImportModificationsPeer::CONCRETISED_AT => 5, OpImportModificationsPeer::IMPORT_ID => 6, OpImportModificationsPeer::LOCATION_ID => 7, OpImportModificationsPeer::ID => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('rec_type' => 0, 'context' => 1, 'csv_rec' => 2, 'action_type' => 3, 'blocked_at' => 4, 'concretised_at' => 5, 'import_id' => 6, 'location_id' => 7, 'id' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpImportModificationsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpImportModificationsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpImportModificationsPeer::getTableMap();
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
		return str_replace(OpImportModificationsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpImportModificationsPeer::REC_TYPE);

		$criteria->addSelectColumn(OpImportModificationsPeer::CONTEXT);

		$criteria->addSelectColumn(OpImportModificationsPeer::CSV_REC);

		$criteria->addSelectColumn(OpImportModificationsPeer::ACTION_TYPE);

		$criteria->addSelectColumn(OpImportModificationsPeer::BLOCKED_AT);

		$criteria->addSelectColumn(OpImportModificationsPeer::CONCRETISED_AT);

		$criteria->addSelectColumn(OpImportModificationsPeer::IMPORT_ID);

		$criteria->addSelectColumn(OpImportModificationsPeer::LOCATION_ID);

		$criteria->addSelectColumn(OpImportModificationsPeer::ID);

	}

	const COUNT = 'COUNT(op_import_modifications.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_import_modifications.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpImportModificationsPeer::doSelectRS($criteria, $con);
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
		$objects = OpImportModificationsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpImportModificationsPeer::populateObjects(OpImportModificationsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpImportModificationsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpImportModificationsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpImportMinint(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportModificationsPeer::IMPORT_ID, OpImportMinintPeer::ID);

		$rs = OpImportModificationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportModificationsPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpImportModificationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpImportMinint(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportModificationsPeer::addSelectColumns($c);
		$startcol = (OpImportModificationsPeer::NUM_COLUMNS - OpImportModificationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpImportMinintPeer::addSelectColumns($c);

		$c->addJoin(OpImportModificationsPeer::IMPORT_ID, OpImportMinintPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportModificationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpImportMinintPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpImportMinint(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpImportModifications($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImportModificationss();
				$obj2->addOpImportModifications($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportModificationsPeer::addSelectColumns($c);
		$startcol = (OpImportModificationsPeer::NUM_COLUMNS - OpImportModificationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpLocationPeer::addSelectColumns($c);

		$c->addJoin(OpImportModificationsPeer::LOCATION_ID, OpLocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportModificationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpLocationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpImportModifications($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImportModificationss();
				$obj2->addOpImportModifications($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportModificationsPeer::IMPORT_ID, OpImportMinintPeer::ID);

		$criteria->addJoin(OpImportModificationsPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpImportModificationsPeer::doSelectRS($criteria, $con);
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

		OpImportModificationsPeer::addSelectColumns($c);
		$startcol2 = (OpImportModificationsPeer::NUM_COLUMNS - OpImportModificationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpImportMinintPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpImportMinintPeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpLocationPeer::NUM_COLUMNS;

		$c->addJoin(OpImportModificationsPeer::IMPORT_ID, OpImportMinintPeer::ID);

		$c->addJoin(OpImportModificationsPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportModificationsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpImportMinintPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpImportMinint(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImportModifications($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportModificationss();
				$obj2->addOpImportModifications($obj1);
			}


					
			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpLocation(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpImportModifications($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpImportModificationss();
				$obj3->addOpImportModifications($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpImportMinint(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportModificationsPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpImportModificationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportModificationsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportModificationsPeer::IMPORT_ID, OpImportMinintPeer::ID);

		$rs = OpImportModificationsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpImportMinint(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportModificationsPeer::addSelectColumns($c);
		$startcol2 = (OpImportModificationsPeer::NUM_COLUMNS - OpImportModificationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpLocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpLocationPeer::NUM_COLUMNS;

		$c->addJoin(OpImportModificationsPeer::LOCATION_ID, OpLocationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportModificationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImportModifications($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportModificationss();
				$obj2->addOpImportModifications($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportModificationsPeer::addSelectColumns($c);
		$startcol2 = (OpImportModificationsPeer::NUM_COLUMNS - OpImportModificationsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpImportMinintPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpImportMinintPeer::NUM_COLUMNS;

		$c->addJoin(OpImportModificationsPeer::IMPORT_ID, OpImportMinintPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportModificationsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpImportMinintPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpImportMinint(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImportModifications($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportModificationss();
				$obj2->addOpImportModifications($obj1);
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
		return OpImportModificationsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpImportModificationsPeer::ID); 

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
			$comparison = $criteria->getComparison(OpImportModificationsPeer::ID);
			$selectCriteria->add(OpImportModificationsPeer::ID, $criteria->remove(OpImportModificationsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpImportModificationsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpImportModificationsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpImportModifications) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpImportModificationsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpImportModifications $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpImportModificationsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpImportModificationsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpImportModificationsPeer::DATABASE_NAME, OpImportModificationsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpImportModificationsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpImportModificationsPeer::DATABASE_NAME);

		$criteria->add(OpImportModificationsPeer::ID, $pk);


		$v = OpImportModificationsPeer::doSelect($criteria, $con);

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
			$criteria->add(OpImportModificationsPeer::ID, $pks, Criteria::IN);
			$objs = OpImportModificationsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpImportModificationsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpImportModificationsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpImportModificationsMapBuilder');
}
