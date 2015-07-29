<?php


abstract class BaseOpSimilarPoliticianPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_similar_politician';

	
	const CLASS_DEFAULT = 'lib.model.OpSimilarPolitician';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ORIGINAL_ID = 'op_similar_politician.ORIGINAL_ID';

	
	const SIMILAR_ID = 'op_similar_politician.SIMILAR_ID';

	
	const IS_RESOLVED = 'op_similar_politician.IS_RESOLVED';

	
	const COMPARES_BIRTH_LOCATIONS = 'op_similar_politician.COMPARES_BIRTH_LOCATIONS';

	
	const CREATED_AT = 'op_similar_politician.CREATED_AT';

	
	const UPDATED_AT = 'op_similar_politician.UPDATED_AT';

	
	const USER_ID = 'op_similar_politician.USER_ID';

	
	const ID = 'op_similar_politician.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('OriginalId', 'SimilarId', 'IsResolved', 'ComparesBirthLocations', 'CreatedAt', 'UpdatedAt', 'UserId', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpSimilarPoliticianPeer::ORIGINAL_ID, OpSimilarPoliticianPeer::SIMILAR_ID, OpSimilarPoliticianPeer::IS_RESOLVED, OpSimilarPoliticianPeer::COMPARES_BIRTH_LOCATIONS, OpSimilarPoliticianPeer::CREATED_AT, OpSimilarPoliticianPeer::UPDATED_AT, OpSimilarPoliticianPeer::USER_ID, OpSimilarPoliticianPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('original_id', 'similar_id', 'is_resolved', 'compares_birth_locations', 'created_at', 'updated_at', 'user_id', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('OriginalId' => 0, 'SimilarId' => 1, 'IsResolved' => 2, 'ComparesBirthLocations' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'UserId' => 6, 'Id' => 7, ),
		BasePeer::TYPE_COLNAME => array (OpSimilarPoliticianPeer::ORIGINAL_ID => 0, OpSimilarPoliticianPeer::SIMILAR_ID => 1, OpSimilarPoliticianPeer::IS_RESOLVED => 2, OpSimilarPoliticianPeer::COMPARES_BIRTH_LOCATIONS => 3, OpSimilarPoliticianPeer::CREATED_AT => 4, OpSimilarPoliticianPeer::UPDATED_AT => 5, OpSimilarPoliticianPeer::USER_ID => 6, OpSimilarPoliticianPeer::ID => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('original_id' => 0, 'similar_id' => 1, 'is_resolved' => 2, 'compares_birth_locations' => 3, 'created_at' => 4, 'updated_at' => 5, 'user_id' => 6, 'id' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpSimilarPoliticianMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpSimilarPoliticianMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpSimilarPoliticianPeer::getTableMap();
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
		return str_replace(OpSimilarPoliticianPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::ORIGINAL_ID);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::SIMILAR_ID);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::IS_RESOLVED);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::COMPARES_BIRTH_LOCATIONS);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::CREATED_AT);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::UPDATED_AT);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::USER_ID);

		$criteria->addSelectColumn(OpSimilarPoliticianPeer::ID);

	}

	const COUNT = 'COUNT(op_similar_politician.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_similar_politician.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
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
		$objects = OpSimilarPoliticianPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpSimilarPoliticianPeer::populateObjects(OpSimilarPoliticianPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpSimilarPoliticianPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpSimilarPoliticianPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpPoliticianRelatedByOriginalId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::ORIGINAL_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpPoliticianRelatedBySimilarId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::SIMILAR_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpPoliticianRelatedByOriginalId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpSimilarPoliticianPeer::ORIGINAL_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpPoliticianRelatedByOriginalId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpSimilarPoliticianRelatedByOriginalId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpSimilarPoliticiansRelatedByOriginalId();
				$obj2->addOpSimilarPoliticianRelatedByOriginalId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpPoliticianRelatedBySimilarId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpSimilarPoliticianPeer::SIMILAR_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpPoliticianRelatedBySimilarId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpSimilarPoliticianRelatedBySimilarId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpSimilarPoliticiansRelatedBySimilarId();
				$obj2->addOpSimilarPoliticianRelatedBySimilarId($obj1); 			}
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

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();

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
										$temp_obj2->addOpSimilarPolitician($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpSimilarPoliticians();
				$obj2->addOpSimilarPolitician($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::ORIGINAL_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpSimilarPoliticianPeer::SIMILAR_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
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

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpSimilarPoliticianPeer::ORIGINAL_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpSimilarPoliticianPeer::SIMILAR_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getOpPoliticianRelatedByOriginalId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpSimilarPoliticianRelatedByOriginalId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpSimilarPoliticiansRelatedByOriginalId();
				$obj2->addOpSimilarPoliticianRelatedByOriginalId($obj1);
			}


					
			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpPoliticianRelatedBySimilarId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpSimilarPoliticianRelatedBySimilarId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpSimilarPoliticiansRelatedBySimilarId();
				$obj3->addOpSimilarPoliticianRelatedBySimilarId($obj1);
			}


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpUser(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpSimilarPolitician($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpSimilarPoliticians();
				$obj4->addOpSimilarPolitician($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpPoliticianRelatedByOriginalId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpPoliticianRelatedBySimilarId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpSimilarPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpSimilarPoliticianPeer::ORIGINAL_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpSimilarPoliticianPeer::SIMILAR_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpSimilarPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpPoliticianRelatedByOriginalId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();

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
					$temp_obj2->addOpSimilarPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpSimilarPoliticians();
				$obj2->addOpSimilarPolitician($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpPoliticianRelatedBySimilarId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpSimilarPoliticianPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();

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
					$temp_obj2->addOpSimilarPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpSimilarPoliticians();
				$obj2->addOpSimilarPolitician($obj1);
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

		OpSimilarPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpSimilarPoliticianPeer::NUM_COLUMNS - OpSimilarPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpSimilarPoliticianPeer::ORIGINAL_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpSimilarPoliticianPeer::SIMILAR_ID, OpPoliticianPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpSimilarPoliticianPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getOpPoliticianRelatedByOriginalId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpSimilarPoliticianRelatedByOriginalId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpSimilarPoliticiansRelatedByOriginalId();
				$obj2->addOpSimilarPoliticianRelatedByOriginalId($obj1);
			}

			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpPoliticianRelatedBySimilarId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpSimilarPoliticianRelatedBySimilarId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpSimilarPoliticiansRelatedBySimilarId();
				$obj3->addOpSimilarPoliticianRelatedBySimilarId($obj1);
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
		return OpSimilarPoliticianPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpSimilarPoliticianPeer::ID); 

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
			$comparison = $criteria->getComparison(OpSimilarPoliticianPeer::ID);
			$selectCriteria->add(OpSimilarPoliticianPeer::ID, $criteria->remove(OpSimilarPoliticianPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpSimilarPoliticianPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpSimilarPoliticianPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpSimilarPolitician) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpSimilarPoliticianPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpSimilarPolitician $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpSimilarPoliticianPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpSimilarPoliticianPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpSimilarPoliticianPeer::DATABASE_NAME, OpSimilarPoliticianPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpSimilarPoliticianPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpSimilarPoliticianPeer::DATABASE_NAME);

		$criteria->add(OpSimilarPoliticianPeer::ID, $pk);


		$v = OpSimilarPoliticianPeer::doSelect($criteria, $con);

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
			$criteria->add(OpSimilarPoliticianPeer::ID, $pks, Criteria::IN);
			$objs = OpSimilarPoliticianPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpSimilarPoliticianPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpSimilarPoliticianMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpSimilarPoliticianMapBuilder');
}
