<?php


abstract class BaseOpOrganizationHasOpOrganizationTagPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_organization_has_op_organization_tag';

	
	const CLASS_DEFAULT = 'lib.model.OpOrganizationHasOpOrganizationTag';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ORGANIZATION_ID = 'op_organization_has_op_organization_tag.ORGANIZATION_ID';

	
	const ORGANIZATION_TAG_ID = 'op_organization_has_op_organization_tag.ORGANIZATION_TAG_ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('OrganizationId', 'OrganizationTagId', ),
		BasePeer::TYPE_COLNAME => array (OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('organization_id', 'organization_tag_id', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('OrganizationId' => 0, 'OrganizationTagId' => 1, ),
		BasePeer::TYPE_COLNAME => array (OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID => 0, OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('organization_id' => 0, 'organization_tag_id' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpOrganizationHasOpOrganizationTagMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpOrganizationHasOpOrganizationTagMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpOrganizationHasOpOrganizationTagPeer::getTableMap();
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
		return str_replace(OpOrganizationHasOpOrganizationTagPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID);

		$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID);

	}

	const COUNT = 'COUNT(op_organization_has_op_organization_tag.ORGANIZATION_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_organization_has_op_organization_tag.ORGANIZATION_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con);
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
		$objects = OpOrganizationHasOpOrganizationTagPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpOrganizationHasOpOrganizationTagPeer::populateObjects(OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpOrganizationHasOpOrganizationTagPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpOrganizationTag(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, OpOrganizationTagPeer::ID);

		$rs = OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($c);
		$startcol = (OpOrganizationHasOpOrganizationTagPeer::NUM_COLUMNS - OpOrganizationHasOpOrganizationTagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOrganizationPeer::addSelectColumns($c);

		$c->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationHasOpOrganizationTagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOrganizationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpOrganization(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpOrganizationHasOpOrganizationTag($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOrganizationHasOpOrganizationTags();
				$obj2->addOpOrganizationHasOpOrganizationTag($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpOrganizationTag(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($c);
		$startcol = (OpOrganizationHasOpOrganizationTagPeer::NUM_COLUMNS - OpOrganizationHasOpOrganizationTagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOrganizationTagPeer::addSelectColumns($c);

		$c->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, OpOrganizationTagPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationHasOpOrganizationTagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOrganizationTagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpOrganizationTag(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpOrganizationHasOpOrganizationTag($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOrganizationHasOpOrganizationTags();
				$obj2->addOpOrganizationHasOpOrganizationTag($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$criteria->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, OpOrganizationTagPeer::ID);

		$rs = OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con);
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

		OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationHasOpOrganizationTagPeer::NUM_COLUMNS - OpOrganizationHasOpOrganizationTagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOrganizationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOrganizationPeer::NUM_COLUMNS;

		OpOrganizationTagPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpOrganizationTagPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$c->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, OpOrganizationTagPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationHasOpOrganizationTagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpOrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOrganization(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOrganizationHasOpOrganizationTag($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationHasOpOrganizationTags();
				$obj2->addOpOrganizationHasOpOrganizationTag($obj1);
			}


					
			$omClass = OpOrganizationTagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpOrganizationTag(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpOrganizationHasOpOrganizationTag($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOrganizationHasOpOrganizationTags();
				$obj3->addOpOrganizationHasOpOrganizationTag($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, OpOrganizationTagPeer::ID);

		$rs = OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpOrganizationTag(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationHasOpOrganizationTagPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = OpOrganizationHasOpOrganizationTagPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationHasOpOrganizationTagPeer::NUM_COLUMNS - OpOrganizationHasOpOrganizationTagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOrganizationTagPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOrganizationTagPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, OpOrganizationTagPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationHasOpOrganizationTagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOrganizationTagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOrganizationTag(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOrganizationHasOpOrganizationTag($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationHasOpOrganizationTags();
				$obj2->addOpOrganizationHasOpOrganizationTag($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpOrganizationTag(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationHasOpOrganizationTagPeer::NUM_COLUMNS - OpOrganizationHasOpOrganizationTagPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOrganizationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOrganizationPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, OpOrganizationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationHasOpOrganizationTagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOrganization(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOrganizationHasOpOrganizationTag($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationHasOpOrganizationTags();
				$obj2->addOpOrganizationHasOpOrganizationTag($obj1);
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
		return OpOrganizationHasOpOrganizationTagPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID);
			$selectCriteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $criteria->remove(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID), $comparison);

			$comparison = $criteria->getComparison(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID);
			$selectCriteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $criteria->remove(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpOrganizationHasOpOrganizationTagPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpOrganizationHasOpOrganizationTag) {

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

			$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $vals[0], Criteria::IN);
			$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpOrganizationHasOpOrganizationTag $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpOrganizationHasOpOrganizationTagPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME, OpOrganizationHasOpOrganizationTagPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpOrganizationHasOpOrganizationTagPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $organization_id, $organization_tag_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $organization_id);
		$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $organization_tag_id);
		$v = OpOrganizationHasOpOrganizationTagPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpOrganizationHasOpOrganizationTagPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpOrganizationHasOpOrganizationTagMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpOrganizationHasOpOrganizationTagMapBuilder');
}
