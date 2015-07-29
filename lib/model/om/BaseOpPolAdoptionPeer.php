<?php


abstract class BaseOpPolAdoptionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_pol_adoption';

	
	const CLASS_DEFAULT = 'lib.model.OpPolAdoption';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const USER_ID = 'op_pol_adoption.USER_ID';

	
	const POLITICIAN_ID = 'op_pol_adoption.POLITICIAN_ID';

	
	const REQUESTED_AT = 'op_pol_adoption.REQUESTED_AT';

	
	const GRANTED_AT = 'op_pol_adoption.GRANTED_AT';

	
	const REVOKED_AT = 'op_pol_adoption.REVOKED_AT';

	
	const REFUSED_AT = 'op_pol_adoption.REFUSED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UserId', 'PoliticianId', 'RequestedAt', 'GrantedAt', 'RevokedAt', 'RefusedAt', ),
		BasePeer::TYPE_COLNAME => array (OpPolAdoptionPeer::USER_ID, OpPolAdoptionPeer::POLITICIAN_ID, OpPolAdoptionPeer::REQUESTED_AT, OpPolAdoptionPeer::GRANTED_AT, OpPolAdoptionPeer::REVOKED_AT, OpPolAdoptionPeer::REFUSED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'politician_id', 'requested_at', 'granted_at', 'revoked_at', 'refused_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'PoliticianId' => 1, 'RequestedAt' => 2, 'GrantedAt' => 3, 'RevokedAt' => 4, 'RefusedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (OpPolAdoptionPeer::USER_ID => 0, OpPolAdoptionPeer::POLITICIAN_ID => 1, OpPolAdoptionPeer::REQUESTED_AT => 2, OpPolAdoptionPeer::GRANTED_AT => 3, OpPolAdoptionPeer::REVOKED_AT => 4, OpPolAdoptionPeer::REFUSED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'politician_id' => 1, 'requested_at' => 2, 'granted_at' => 3, 'revoked_at' => 4, 'refused_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpPolAdoptionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpPolAdoptionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpPolAdoptionPeer::getTableMap();
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
		return str_replace(OpPolAdoptionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpPolAdoptionPeer::USER_ID);

		$criteria->addSelectColumn(OpPolAdoptionPeer::POLITICIAN_ID);

		$criteria->addSelectColumn(OpPolAdoptionPeer::REQUESTED_AT);

		$criteria->addSelectColumn(OpPolAdoptionPeer::GRANTED_AT);

		$criteria->addSelectColumn(OpPolAdoptionPeer::REVOKED_AT);

		$criteria->addSelectColumn(OpPolAdoptionPeer::REFUSED_AT);

	}

	const COUNT = 'COUNT(op_pol_adoption.USER_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_pol_adoption.USER_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpPolAdoptionPeer::doSelectRS($criteria, $con);
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
		$objects = OpPolAdoptionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpPolAdoptionPeer::populateObjects(OpPolAdoptionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpPolAdoptionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpPolAdoptionPeer::getOMClass();
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
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPolAdoptionPeer::USER_ID, OpUserPeer::ID);

		$rs = OpPolAdoptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpPolitician(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPolAdoptionPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpPolAdoptionPeer::doSelectRS($criteria, $con);
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

		OpPolAdoptionPeer::addSelectColumns($c);
		$startcol = (OpPolAdoptionPeer::NUM_COLUMNS - OpPolAdoptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpPolAdoptionPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPolAdoptionPeer::getOMClass();

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
										$temp_obj2->addOpPolAdoption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPolAdoptions();
				$obj2->addOpPolAdoption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpPolitician(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPolAdoptionPeer::addSelectColumns($c);
		$startcol = (OpPolAdoptionPeer::NUM_COLUMNS - OpPolAdoptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpPolAdoptionPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPolAdoptionPeer::getOMClass();

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
										$temp_obj2->addOpPolAdoption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPolAdoptions();
				$obj2->addOpPolAdoption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPolAdoptionPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpPolAdoptionPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpPolAdoptionPeer::doSelectRS($criteria, $con);
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

		OpPolAdoptionPeer::addSelectColumns($c);
		$startcol2 = (OpPolAdoptionPeer::NUM_COLUMNS - OpPolAdoptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpPolAdoptionPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpPolAdoptionPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPolAdoptionPeer::getOMClass();


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
					$temp_obj2->addOpPolAdoption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPolAdoptions();
				$obj2->addOpPolAdoption($obj1);
			}


					
			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpPolitician(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPolAdoption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPolAdoptions();
				$obj3->addOpPolAdoption($obj1);
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
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPolAdoptionPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpPolAdoptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpPolitician(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPolAdoptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPolAdoptionPeer::USER_ID, OpUserPeer::ID);

		$rs = OpPolAdoptionPeer::doSelectRS($criteria, $con);
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

		OpPolAdoptionPeer::addSelectColumns($c);
		$startcol2 = (OpPolAdoptionPeer::NUM_COLUMNS - OpPolAdoptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpPolAdoptionPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPolAdoptionPeer::getOMClass();

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
					$temp_obj2->addOpPolAdoption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPolAdoptions();
				$obj2->addOpPolAdoption($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpPolitician(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPolAdoptionPeer::addSelectColumns($c);
		$startcol2 = (OpPolAdoptionPeer::NUM_COLUMNS - OpPolAdoptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpPolAdoptionPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPolAdoptionPeer::getOMClass();

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
					$temp_obj2->addOpPolAdoption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPolAdoptions();
				$obj2->addOpPolAdoption($obj1);
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
		return OpPolAdoptionPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpPolAdoptionPeer::USER_ID);
			$selectCriteria->add(OpPolAdoptionPeer::USER_ID, $criteria->remove(OpPolAdoptionPeer::USER_ID), $comparison);

			$comparison = $criteria->getComparison(OpPolAdoptionPeer::POLITICIAN_ID);
			$selectCriteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $criteria->remove(OpPolAdoptionPeer::POLITICIAN_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpPolAdoptionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpPolAdoptionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpPolAdoption) {

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

			$criteria->add(OpPolAdoptionPeer::USER_ID, $vals[0], Criteria::IN);
			$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpPolAdoption $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpPolAdoptionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpPolAdoptionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpPolAdoptionPeer::DATABASE_NAME, OpPolAdoptionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpPolAdoptionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $user_id, $politician_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpPolAdoptionPeer::USER_ID, $user_id);
		$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $politician_id);
		$v = OpPolAdoptionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpPolAdoptionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpPolAdoptionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpPolAdoptionMapBuilder');
}
