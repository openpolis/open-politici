<?php


abstract class BaseOpImportSimilarPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_import_similar';

	
	const CLASS_DEFAULT = 'lib.model.OpImportSimilar';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const NEW_CSV_REC = 'op_import_similar.NEW_CSV_REC';

	
	const OLD_CSV_REC = 'op_import_similar.OLD_CSV_REC';

	
	const CONTEXT = 'op_import_similar.CONTEXT';

	
	const LOCATION_ID = 'op_import_similar.LOCATION_ID';

	
	const CREATED_AT = 'op_import_similar.CREATED_AT';

	
	const DELETED_AT = 'op_import_similar.DELETED_AT';

	
	const DELETING_USER_ID = 'op_import_similar.DELETING_USER_ID';

	
	const N_DIFFS = 'op_import_similar.N_DIFFS';

	
	const CHARGES_DIFFER = 'op_import_similar.CHARGES_DIFFER';

	
	const NAMES_DIFFER = 'op_import_similar.NAMES_DIFFER';

	
	const BIRTH_DATES_DIFFER = 'op_import_similar.BIRTH_DATES_DIFFER';

	
	const BIRTH_PLACES_DIFFER = 'op_import_similar.BIRTH_PLACES_DIFFER';

	
	const ID = 'op_import_similar.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('NewCsvRec', 'OldCsvRec', 'Context', 'LocationId', 'CreatedAt', 'DeletedAt', 'DeletingUserId', 'NDiffs', 'ChargesDiffer', 'NamesDiffer', 'BirthDatesDiffer', 'BirthPlacesDiffer', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpImportSimilarPeer::NEW_CSV_REC, OpImportSimilarPeer::OLD_CSV_REC, OpImportSimilarPeer::CONTEXT, OpImportSimilarPeer::LOCATION_ID, OpImportSimilarPeer::CREATED_AT, OpImportSimilarPeer::DELETED_AT, OpImportSimilarPeer::DELETING_USER_ID, OpImportSimilarPeer::N_DIFFS, OpImportSimilarPeer::CHARGES_DIFFER, OpImportSimilarPeer::NAMES_DIFFER, OpImportSimilarPeer::BIRTH_DATES_DIFFER, OpImportSimilarPeer::BIRTH_PLACES_DIFFER, OpImportSimilarPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('new_csv_rec', 'old_csv_rec', 'context', 'location_id', 'created_at', 'deleted_at', 'deleting_user_id', 'n_diffs', 'charges_differ', 'names_differ', 'birth_dates_differ', 'birth_places_differ', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('NewCsvRec' => 0, 'OldCsvRec' => 1, 'Context' => 2, 'LocationId' => 3, 'CreatedAt' => 4, 'DeletedAt' => 5, 'DeletingUserId' => 6, 'NDiffs' => 7, 'ChargesDiffer' => 8, 'NamesDiffer' => 9, 'BirthDatesDiffer' => 10, 'BirthPlacesDiffer' => 11, 'Id' => 12, ),
		BasePeer::TYPE_COLNAME => array (OpImportSimilarPeer::NEW_CSV_REC => 0, OpImportSimilarPeer::OLD_CSV_REC => 1, OpImportSimilarPeer::CONTEXT => 2, OpImportSimilarPeer::LOCATION_ID => 3, OpImportSimilarPeer::CREATED_AT => 4, OpImportSimilarPeer::DELETED_AT => 5, OpImportSimilarPeer::DELETING_USER_ID => 6, OpImportSimilarPeer::N_DIFFS => 7, OpImportSimilarPeer::CHARGES_DIFFER => 8, OpImportSimilarPeer::NAMES_DIFFER => 9, OpImportSimilarPeer::BIRTH_DATES_DIFFER => 10, OpImportSimilarPeer::BIRTH_PLACES_DIFFER => 11, OpImportSimilarPeer::ID => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('new_csv_rec' => 0, 'old_csv_rec' => 1, 'context' => 2, 'location_id' => 3, 'created_at' => 4, 'deleted_at' => 5, 'deleting_user_id' => 6, 'n_diffs' => 7, 'charges_differ' => 8, 'names_differ' => 9, 'birth_dates_differ' => 10, 'birth_places_differ' => 11, 'id' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpImportSimilarMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpImportSimilarMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpImportSimilarPeer::getTableMap();
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
		return str_replace(OpImportSimilarPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpImportSimilarPeer::NEW_CSV_REC);

		$criteria->addSelectColumn(OpImportSimilarPeer::OLD_CSV_REC);

		$criteria->addSelectColumn(OpImportSimilarPeer::CONTEXT);

		$criteria->addSelectColumn(OpImportSimilarPeer::LOCATION_ID);

		$criteria->addSelectColumn(OpImportSimilarPeer::CREATED_AT);

		$criteria->addSelectColumn(OpImportSimilarPeer::DELETED_AT);

		$criteria->addSelectColumn(OpImportSimilarPeer::DELETING_USER_ID);

		$criteria->addSelectColumn(OpImportSimilarPeer::N_DIFFS);

		$criteria->addSelectColumn(OpImportSimilarPeer::CHARGES_DIFFER);

		$criteria->addSelectColumn(OpImportSimilarPeer::NAMES_DIFFER);

		$criteria->addSelectColumn(OpImportSimilarPeer::BIRTH_DATES_DIFFER);

		$criteria->addSelectColumn(OpImportSimilarPeer::BIRTH_PLACES_DIFFER);

		$criteria->addSelectColumn(OpImportSimilarPeer::ID);

	}

	const COUNT = 'COUNT(op_import_similar.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_import_similar.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpImportSimilarPeer::doSelectRS($criteria, $con);
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
		$objects = OpImportSimilarPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpImportSimilarPeer::populateObjects(OpImportSimilarPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpImportSimilarPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpImportSimilarPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportSimilarPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpImportSimilarPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportSimilarPeer::DELETING_USER_ID, OpUserPeer::ID);

		$rs = OpImportSimilarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportSimilarPeer::addSelectColumns($c);
		$startcol = (OpImportSimilarPeer::NUM_COLUMNS - OpImportSimilarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpLocationPeer::addSelectColumns($c);

		$c->addJoin(OpImportSimilarPeer::LOCATION_ID, OpLocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportSimilarPeer::getOMClass();

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
										$temp_obj2->addOpImportSimilar($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImportSimilars();
				$obj2->addOpImportSimilar($obj1); 			}
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

		OpImportSimilarPeer::addSelectColumns($c);
		$startcol = (OpImportSimilarPeer::NUM_COLUMNS - OpImportSimilarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpImportSimilarPeer::DELETING_USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportSimilarPeer::getOMClass();

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
										$temp_obj2->addOpImportSimilar($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImportSimilars();
				$obj2->addOpImportSimilar($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportSimilarPeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpImportSimilarPeer::DELETING_USER_ID, OpUserPeer::ID);

		$rs = OpImportSimilarPeer::doSelectRS($criteria, $con);
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

		OpImportSimilarPeer::addSelectColumns($c);
		$startcol2 = (OpImportSimilarPeer::NUM_COLUMNS - OpImportSimilarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpLocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpLocationPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpImportSimilarPeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpImportSimilarPeer::DELETING_USER_ID, OpUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportSimilarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImportSimilar($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportSimilars();
				$obj2->addOpImportSimilar($obj1);
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
					$temp_obj3->addOpImportSimilar($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpImportSimilars();
				$obj3->addOpImportSimilar($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportSimilarPeer::DELETING_USER_ID, OpUserPeer::ID);

		$rs = OpImportSimilarPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportSimilarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportSimilarPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpImportSimilarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportSimilarPeer::addSelectColumns($c);
		$startcol2 = (OpImportSimilarPeer::NUM_COLUMNS - OpImportSimilarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpImportSimilarPeer::DELETING_USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportSimilarPeer::getOMClass();

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
					$temp_obj2->addOpImportSimilar($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportSimilars();
				$obj2->addOpImportSimilar($obj1);
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

		OpImportSimilarPeer::addSelectColumns($c);
		$startcol2 = (OpImportSimilarPeer::NUM_COLUMNS - OpImportSimilarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpLocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpLocationPeer::NUM_COLUMNS;

		$c->addJoin(OpImportSimilarPeer::LOCATION_ID, OpLocationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportSimilarPeer::getOMClass();

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
					$temp_obj2->addOpImportSimilar($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportSimilars();
				$obj2->addOpImportSimilar($obj1);
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
		return OpImportSimilarPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpImportSimilarPeer::ID); 

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
			$comparison = $criteria->getComparison(OpImportSimilarPeer::ID);
			$selectCriteria->add(OpImportSimilarPeer::ID, $criteria->remove(OpImportSimilarPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpImportSimilarPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpImportSimilarPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpImportSimilar) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpImportSimilarPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpImportSimilar $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpImportSimilarPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpImportSimilarPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpImportSimilarPeer::DATABASE_NAME, OpImportSimilarPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpImportSimilarPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpImportSimilarPeer::DATABASE_NAME);

		$criteria->add(OpImportSimilarPeer::ID, $pk);


		$v = OpImportSimilarPeer::doSelect($criteria, $con);

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
			$criteria->add(OpImportSimilarPeer::ID, $pks, Criteria::IN);
			$objs = OpImportSimilarPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpImportSimilarPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpImportSimilarMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpImportSimilarMapBuilder');
}
