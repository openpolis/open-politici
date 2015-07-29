<?php


abstract class BaseOpPoliticianHasOpEducationLevelPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_politician_has_op_education_level';

	
	const CLASS_DEFAULT = 'lib.model.OpPoliticianHasOpEducationLevel';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const POLITICIAN_ID = 'op_politician_has_op_education_level.POLITICIAN_ID';

	
	const EDUCATION_LEVEL_ID = 'op_politician_has_op_education_level.EDUCATION_LEVEL_ID';

	
	const DESCRIPTION = 'op_politician_has_op_education_level.DESCRIPTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('PoliticianId', 'EducationLevelId', 'Description', ),
		BasePeer::TYPE_COLNAME => array (OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpPoliticianHasOpEducationLevelPeer::DESCRIPTION, ),
		BasePeer::TYPE_FIELDNAME => array ('politician_id', 'education_level_id', 'description', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('PoliticianId' => 0, 'EducationLevelId' => 1, 'Description' => 2, ),
		BasePeer::TYPE_COLNAME => array (OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID => 0, OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID => 1, OpPoliticianHasOpEducationLevelPeer::DESCRIPTION => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('politician_id' => 0, 'education_level_id' => 1, 'description' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpPoliticianHasOpEducationLevelMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpPoliticianHasOpEducationLevelMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpPoliticianHasOpEducationLevelPeer::getTableMap();
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
		return str_replace(OpPoliticianHasOpEducationLevelPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID);

		$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID);

		$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::DESCRIPTION);

	}

	const COUNT = 'COUNT(op_politician_has_op_education_level.POLITICIAN_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_politician_has_op_education_level.POLITICIAN_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con);
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
		$objects = OpPoliticianHasOpEducationLevelPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpPoliticianHasOpEducationLevelPeer::populateObjects(OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpPoliticianHasOpEducationLevelPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpPoliticianHasOpEducationLevelPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpPolitician(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpEducationLevel(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID);

		$rs = OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpPolitician(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianHasOpEducationLevelPeer::addSelectColumns($c);
		$startcol = (OpPoliticianHasOpEducationLevelPeer::NUM_COLUMNS - OpPoliticianHasOpEducationLevelPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianHasOpEducationLevelPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpPolitician(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpPoliticianHasOpEducationLevel($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticianHasOpEducationLevels();
				$obj2->addOpPoliticianHasOpEducationLevel($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpEducationLevel(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianHasOpEducationLevelPeer::addSelectColumns($c);
		$startcol = (OpPoliticianHasOpEducationLevelPeer::NUM_COLUMNS - OpPoliticianHasOpEducationLevelPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpEducationLevelPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianHasOpEducationLevelPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpEducationLevelPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpEducationLevel(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpPoliticianHasOpEducationLevel($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticianHasOpEducationLevels();
				$obj2->addOpPoliticianHasOpEducationLevel($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID);

		$rs = OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con);
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

		OpPoliticianHasOpEducationLevelPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianHasOpEducationLevelPeer::NUM_COLUMNS - OpPoliticianHasOpEducationLevelPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		OpEducationLevelPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpEducationLevelPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianHasOpEducationLevelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpPolitician(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpPoliticianHasOpEducationLevel($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticianHasOpEducationLevels();
				$obj2->addOpPoliticianHasOpEducationLevel($obj1);
			}


					
			$omClass = OpEducationLevelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpEducationLevel(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPoliticianHasOpEducationLevel($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticianHasOpEducationLevels();
				$obj3->addOpPoliticianHasOpEducationLevel($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpPolitician(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID);

		$rs = OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpEducationLevel(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianHasOpEducationLevelPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpPoliticianHasOpEducationLevelPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpPolitician(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianHasOpEducationLevelPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianHasOpEducationLevelPeer::NUM_COLUMNS - OpPoliticianHasOpEducationLevelPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpEducationLevelPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpEducationLevelPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianHasOpEducationLevelPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpEducationLevelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpEducationLevel(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpPoliticianHasOpEducationLevel($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticianHasOpEducationLevels();
				$obj2->addOpPoliticianHasOpEducationLevel($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpEducationLevel(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianHasOpEducationLevelPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianHasOpEducationLevelPeer::NUM_COLUMNS - OpPoliticianHasOpEducationLevelPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianHasOpEducationLevelPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpPolitician(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpPoliticianHasOpEducationLevel($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticianHasOpEducationLevels();
				$obj2->addOpPoliticianHasOpEducationLevel($obj1);
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
		return OpPoliticianHasOpEducationLevelPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID);
			$selectCriteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $criteria->remove(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID), $comparison);

			$comparison = $criteria->getComparison(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID);
			$selectCriteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $criteria->remove(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpPoliticianHasOpEducationLevelPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpPoliticianHasOpEducationLevel) {

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

			$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $vals[0], Criteria::IN);
			$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpPoliticianHasOpEducationLevel $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpPoliticianHasOpEducationLevelPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME, OpPoliticianHasOpEducationLevelPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpPoliticianHasOpEducationLevelPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $politician_id, $education_level_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $politician_id);
		$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $education_level_id);
		$v = OpPoliticianHasOpEducationLevelPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpPoliticianHasOpEducationLevelPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpPoliticianHasOpEducationLevelMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpPoliticianHasOpEducationLevelMapBuilder');
}
