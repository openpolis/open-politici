<?php


abstract class BaseOpImportPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_import';

	
	const CLASS_DEFAULT = 'lib.model.OpImport';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const IMPORT_TYPE_ID = 'op_import.IMPORT_TYPE_ID';

	
	const IMPORT_MININT_ID = 'op_import.IMPORT_MININT_ID';

	
	const IMPORT_FILE = 'op_import.IMPORT_FILE';

	
	const IMPORT_LOCATION = 'op_import.IMPORT_LOCATION';

	
	const STARTED_AT = 'op_import.STARTED_AT';

	
	const FINISHED_AT = 'op_import.FINISHED_AT';

	
	const RUN_TYPE = 'op_import.RUN_TYPE';

	
	const TOTAL = 'op_import.TOTAL';

	
	const ERRORS = 'op_import.ERRORS';

	
	const WARNINGS = 'op_import.WARNINGS';

	
	const INSERTED = 'op_import.INSERTED';

	
	const ID = 'op_import.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ImportTypeId', 'ImportMinintId', 'ImportFile', 'ImportLocation', 'StartedAt', 'FinishedAt', 'RunType', 'Total', 'Errors', 'Warnings', 'Inserted', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpImportPeer::IMPORT_TYPE_ID, OpImportPeer::IMPORT_MININT_ID, OpImportPeer::IMPORT_FILE, OpImportPeer::IMPORT_LOCATION, OpImportPeer::STARTED_AT, OpImportPeer::FINISHED_AT, OpImportPeer::RUN_TYPE, OpImportPeer::TOTAL, OpImportPeer::ERRORS, OpImportPeer::WARNINGS, OpImportPeer::INSERTED, OpImportPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('import_type_id', 'import_minint_id', 'import_file', 'import_location', 'started_at', 'finished_at', 'run_type', 'total', 'errors', 'warnings', 'inserted', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ImportTypeId' => 0, 'ImportMinintId' => 1, 'ImportFile' => 2, 'ImportLocation' => 3, 'StartedAt' => 4, 'FinishedAt' => 5, 'RunType' => 6, 'Total' => 7, 'Errors' => 8, 'Warnings' => 9, 'Inserted' => 10, 'Id' => 11, ),
		BasePeer::TYPE_COLNAME => array (OpImportPeer::IMPORT_TYPE_ID => 0, OpImportPeer::IMPORT_MININT_ID => 1, OpImportPeer::IMPORT_FILE => 2, OpImportPeer::IMPORT_LOCATION => 3, OpImportPeer::STARTED_AT => 4, OpImportPeer::FINISHED_AT => 5, OpImportPeer::RUN_TYPE => 6, OpImportPeer::TOTAL => 7, OpImportPeer::ERRORS => 8, OpImportPeer::WARNINGS => 9, OpImportPeer::INSERTED => 10, OpImportPeer::ID => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('import_type_id' => 0, 'import_minint_id' => 1, 'import_file' => 2, 'import_location' => 3, 'started_at' => 4, 'finished_at' => 5, 'run_type' => 6, 'total' => 7, 'errors' => 8, 'warnings' => 9, 'inserted' => 10, 'id' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpImportMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpImportMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpImportPeer::getTableMap();
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
		return str_replace(OpImportPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpImportPeer::IMPORT_TYPE_ID);

		$criteria->addSelectColumn(OpImportPeer::IMPORT_MININT_ID);

		$criteria->addSelectColumn(OpImportPeer::IMPORT_FILE);

		$criteria->addSelectColumn(OpImportPeer::IMPORT_LOCATION);

		$criteria->addSelectColumn(OpImportPeer::STARTED_AT);

		$criteria->addSelectColumn(OpImportPeer::FINISHED_AT);

		$criteria->addSelectColumn(OpImportPeer::RUN_TYPE);

		$criteria->addSelectColumn(OpImportPeer::TOTAL);

		$criteria->addSelectColumn(OpImportPeer::ERRORS);

		$criteria->addSelectColumn(OpImportPeer::WARNINGS);

		$criteria->addSelectColumn(OpImportPeer::INSERTED);

		$criteria->addSelectColumn(OpImportPeer::ID);

	}

	const COUNT = 'COUNT(op_import.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_import.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpImportPeer::doSelectRS($criteria, $con);
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
		$objects = OpImportPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpImportPeer::populateObjects(OpImportPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpImportPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpImportPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpImportType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportPeer::IMPORT_TYPE_ID, OpImportTypePeer::ID);

		$rs = OpImportPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpImportMinint(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportPeer::IMPORT_MININT_ID, OpImportMinintPeer::ID);

		$rs = OpImportPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpImportType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportPeer::addSelectColumns($c);
		$startcol = (OpImportPeer::NUM_COLUMNS - OpImportPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpImportTypePeer::addSelectColumns($c);

		$c->addJoin(OpImportPeer::IMPORT_TYPE_ID, OpImportTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpImportTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpImportType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpImport($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImports();
				$obj2->addOpImport($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpImportMinint(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportPeer::addSelectColumns($c);
		$startcol = (OpImportPeer::NUM_COLUMNS - OpImportPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpImportMinintPeer::addSelectColumns($c);

		$c->addJoin(OpImportPeer::IMPORT_MININT_ID, OpImportMinintPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportPeer::getOMClass();

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
										$temp_obj2->addOpImport($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImports();
				$obj2->addOpImport($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportPeer::IMPORT_TYPE_ID, OpImportTypePeer::ID);

		$criteria->addJoin(OpImportPeer::IMPORT_MININT_ID, OpImportMinintPeer::ID);

		$rs = OpImportPeer::doSelectRS($criteria, $con);
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

		OpImportPeer::addSelectColumns($c);
		$startcol2 = (OpImportPeer::NUM_COLUMNS - OpImportPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpImportTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpImportTypePeer::NUM_COLUMNS;

		OpImportMinintPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpImportMinintPeer::NUM_COLUMNS;

		$c->addJoin(OpImportPeer::IMPORT_TYPE_ID, OpImportTypePeer::ID);

		$c->addJoin(OpImportPeer::IMPORT_MININT_ID, OpImportMinintPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpImportTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpImportType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImport($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImports();
				$obj2->addOpImport($obj1);
			}


					
			$omClass = OpImportMinintPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpImportMinint(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpImport($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpImports();
				$obj3->addOpImport($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpImportType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportPeer::IMPORT_MININT_ID, OpImportMinintPeer::ID);

		$rs = OpImportPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpImportMinint(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportPeer::IMPORT_TYPE_ID, OpImportTypePeer::ID);

		$rs = OpImportPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpImportType(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportPeer::addSelectColumns($c);
		$startcol2 = (OpImportPeer::NUM_COLUMNS - OpImportPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpImportMinintPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpImportMinintPeer::NUM_COLUMNS;

		$c->addJoin(OpImportPeer::IMPORT_MININT_ID, OpImportMinintPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportPeer::getOMClass();

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
					$temp_obj2->addOpImport($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImports();
				$obj2->addOpImport($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpImportMinint(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportPeer::addSelectColumns($c);
		$startcol2 = (OpImportPeer::NUM_COLUMNS - OpImportPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpImportTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpImportTypePeer::NUM_COLUMNS;

		$c->addJoin(OpImportPeer::IMPORT_TYPE_ID, OpImportTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpImportTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpImportType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImport($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImports();
				$obj2->addOpImport($obj1);
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
		return OpImportPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpImportPeer::ID); 

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
			$comparison = $criteria->getComparison(OpImportPeer::ID);
			$selectCriteria->add(OpImportPeer::ID, $criteria->remove(OpImportPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpImportPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpImportPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpImport) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpImportPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpImport $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpImportPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpImportPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpImportPeer::DATABASE_NAME, OpImportPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpImportPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpImportPeer::DATABASE_NAME);

		$criteria->add(OpImportPeer::ID, $pk);


		$v = OpImportPeer::doSelect($criteria, $con);

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
			$criteria->add(OpImportPeer::ID, $pks, Criteria::IN);
			$objs = OpImportPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpImportPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpImportMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpImportMapBuilder');
}
