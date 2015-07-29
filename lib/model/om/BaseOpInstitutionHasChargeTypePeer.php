<?php


abstract class BaseOpInstitutionHasChargeTypePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_institution_has_charge_type';

	
	const CLASS_DEFAULT = 'lib.model.OpInstitutionHasChargeType';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const INSTITUTION_ID = 'op_institution_has_charge_type.INSTITUTION_ID';

	
	const CHARGE_TYPE_ID = 'op_institution_has_charge_type.CHARGE_TYPE_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('InstitutionId', 'ChargeTypeId', ),
		BasePeer::TYPE_COLNAME => array (OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('institution_id', 'charge_type_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('InstitutionId' => 0, 'ChargeTypeId' => 1, ),
		BasePeer::TYPE_COLNAME => array (OpInstitutionHasChargeTypePeer::INSTITUTION_ID => 0, OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('institution_id' => 0, 'charge_type_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpInstitutionHasChargeTypeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpInstitutionHasChargeTypeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpInstitutionHasChargeTypePeer::getTableMap();
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
		return str_replace(OpInstitutionHasChargeTypePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::INSTITUTION_ID);

		$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID);

	}

	const COUNT = 'COUNT(op_institution_has_charge_type.INSTITUTION_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_institution_has_charge_type.INSTITUTION_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con);
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
		$objects = OpInstitutionHasChargeTypePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpInstitutionHasChargeTypePeer::populateObjects(OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpInstitutionHasChargeTypePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpInstitutionHasChargeTypePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpInstitution(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$rs = OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpChargeType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$rs = OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpInstitution(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionHasChargeTypePeer::addSelectColumns($c);
		$startcol = (OpInstitutionHasChargeTypePeer::NUM_COLUMNS - OpInstitutionHasChargeTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpInstitutionPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionHasChargeTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpInstitutionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpInstitution(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpInstitutionHasChargeType($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionHasChargeTypes();
				$obj2->addOpInstitutionHasChargeType($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpChargeType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionHasChargeTypePeer::addSelectColumns($c);
		$startcol = (OpInstitutionHasChargeTypePeer::NUM_COLUMNS - OpInstitutionHasChargeTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpChargeTypePeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionHasChargeTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpChargeTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpChargeType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpInstitutionHasChargeType($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionHasChargeTypes();
				$obj2->addOpInstitutionHasChargeType($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$rs = OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con);
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

		OpInstitutionHasChargeTypePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionHasChargeTypePeer::NUM_COLUMNS - OpInstitutionHasChargeTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpChargeTypePeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionHasChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpInstitution(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpInstitutionHasChargeType($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionHasChargeTypes();
				$obj2->addOpInstitutionHasChargeType($obj1);
			}


					
			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpChargeType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpInstitutionHasChargeType($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionHasChargeTypes();
				$obj3->addOpInstitutionHasChargeType($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpInstitution(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$rs = OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpChargeType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionHasChargeTypePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$rs = OpInstitutionHasChargeTypePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpInstitution(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionHasChargeTypePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionHasChargeTypePeer::NUM_COLUMNS - OpInstitutionHasChargeTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpChargeTypePeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionHasChargeTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpChargeType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpInstitutionHasChargeType($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionHasChargeTypes();
				$obj2->addOpInstitutionHasChargeType($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpChargeType(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionHasChargeTypePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionHasChargeTypePeer::NUM_COLUMNS - OpInstitutionHasChargeTypePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpInstitutionPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, OpInstitutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionHasChargeTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpInstitution(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpInstitutionHasChargeType($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionHasChargeTypes();
				$obj2->addOpInstitutionHasChargeType($obj1);
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
		return OpInstitutionHasChargeTypePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpInstitutionHasChargeTypePeer::INSTITUTION_ID);
			$selectCriteria->add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $criteria->remove(OpInstitutionHasChargeTypePeer::INSTITUTION_ID), $comparison);

			$comparison = $criteria->getComparison(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID);
			$selectCriteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $criteria->remove(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpInstitutionHasChargeTypePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpInstitutionHasChargeTypePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpInstitutionHasChargeType) {

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

			$criteria->add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $vals[0], Criteria::IN);
			$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpInstitutionHasChargeType $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpInstitutionHasChargeTypePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpInstitutionHasChargeTypePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpInstitutionHasChargeTypePeer::DATABASE_NAME, OpInstitutionHasChargeTypePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpInstitutionHasChargeTypePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $institution_id, $charge_type_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $institution_id);
		$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $charge_type_id);
		$v = OpInstitutionHasChargeTypePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpInstitutionHasChargeTypePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpInstitutionHasChargeTypeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpInstitutionHasChargeTypeMapBuilder');
}
