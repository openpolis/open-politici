<?php


abstract class BaseOpOpenContentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_open_content';

	
	const CLASS_DEFAULT = 'lib.model.OpOpenContent';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_open_content.CONTENT_ID';

	
	const USER_ID = 'op_open_content.USER_ID';

	
	const UPDATER_ID = 'op_open_content.UPDATER_ID';

	
	const VERIFIED_AT = 'op_open_content.VERIFIED_AT';

	
	const DELETED_AT = 'op_open_content.DELETED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'UserId', 'UpdaterId', 'VerifiedAt', 'DeletedAt', ),
		BasePeer::TYPE_COLNAME => array (OpOpenContentPeer::CONTENT_ID, OpOpenContentPeer::USER_ID, OpOpenContentPeer::UPDATER_ID, OpOpenContentPeer::VERIFIED_AT, OpOpenContentPeer::DELETED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'user_id', 'updater_id', 'verified_at', 'deleted_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'UserId' => 1, 'UpdaterId' => 2, 'VerifiedAt' => 3, 'DeletedAt' => 4, ),
		BasePeer::TYPE_COLNAME => array (OpOpenContentPeer::CONTENT_ID => 0, OpOpenContentPeer::USER_ID => 1, OpOpenContentPeer::UPDATER_ID => 2, OpOpenContentPeer::VERIFIED_AT => 3, OpOpenContentPeer::DELETED_AT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'user_id' => 1, 'updater_id' => 2, 'verified_at' => 3, 'deleted_at' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpOpenContentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpOpenContentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpOpenContentPeer::getTableMap();
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
		return str_replace(OpOpenContentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpOpenContentPeer::CONTENT_ID);

		$criteria->addSelectColumn(OpOpenContentPeer::USER_ID);

		$criteria->addSelectColumn(OpOpenContentPeer::UPDATER_ID);

		$criteria->addSelectColumn(OpOpenContentPeer::VERIFIED_AT);

		$criteria->addSelectColumn(OpOpenContentPeer::DELETED_AT);

	}

	const COUNT = 'COUNT(op_open_content.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_open_content.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
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
		$objects = OpOpenContentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpOpenContentPeer::populateObjects(OpOpenContentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpOpenContentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpOpenContentPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpUserRelatedByUserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpUserRelatedByUpdaterId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::UPDATER_ID, OpUserPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOpenContentPeer::addSelectColumns($c);
		$startcol = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpContentPeer::addSelectColumns($c);

		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpOpenContent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOpenContents();
				$obj2->addOpOpenContent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpUserRelatedByUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOpenContentPeer::addSelectColumns($c);
		$startcol = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpUserRelatedByUserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpOpenContentRelatedByUserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOpenContentsRelatedByUserId();
				$obj2->addOpOpenContentRelatedByUserId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpUserRelatedByUpdaterId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOpenContentPeer::addSelectColumns($c);
		$startcol = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpOpenContentPeer::UPDATER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpUserRelatedByUpdaterId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpOpenContentRelatedByUpdaterId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOpenContentsRelatedByUpdaterId();
				$obj2->addOpOpenContentRelatedByUpdaterId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);

		$criteria->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpOpenContentPeer::UPDATER_ID, OpUserPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
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

		OpOpenContentPeer::addSelectColumns($c);
		$startcol2 = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);

		$c->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpOpenContentPeer::UPDATER_ID, OpUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOpenContent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOpenContents();
				$obj2->addOpOpenContent($obj1);
			}


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUserRelatedByUserId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpOpenContentRelatedByUserId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOpenContentsRelatedByUserId();
				$obj3->addOpOpenContentRelatedByUserId($obj1);
			}


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpUserRelatedByUpdaterId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpOpenContentRelatedByUpdaterId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpOpenContentsRelatedByUpdaterId();
				$obj4->addOpOpenContentRelatedByUpdaterId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpOpenContentPeer::UPDATER_ID, OpUserPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpUserRelatedByUserId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpUserRelatedByUpdaterId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOpenContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);

		$rs = OpOpenContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOpenContentPeer::addSelectColumns($c);
		$startcol2 = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpUserPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpOpenContentPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpOpenContentPeer::UPDATER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getOpUserRelatedByUserId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOpenContentRelatedByUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOpenContentsRelatedByUserId();
				$obj2->addOpOpenContentRelatedByUserId($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUserRelatedByUpdaterId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpOpenContentRelatedByUpdaterId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOpenContentsRelatedByUpdaterId();
				$obj3->addOpOpenContentRelatedByUpdaterId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpUserRelatedByUserId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOpenContentPeer::addSelectColumns($c);
		$startcol2 = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOpenContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOpenContents();
				$obj2->addOpOpenContent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpUserRelatedByUpdaterId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOpenContentPeer::addSelectColumns($c);
		$startcol2 = (OpOpenContentPeer::NUM_COLUMNS - OpOpenContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOpenContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOpenContents();
				$obj2->addOpOpenContent($obj1);
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
		return OpOpenContentPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpOpenContentPeer::CONTENT_ID);
			$selectCriteria->add(OpOpenContentPeer::CONTENT_ID, $criteria->remove(OpOpenContentPeer::CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpOpenContentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpOpenContentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpOpenContent) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpOpenContentPeer::CONTENT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpOpenContent $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpOpenContentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpOpenContentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpOpenContentPeer::DATABASE_NAME, OpOpenContentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpOpenContentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpOpenContentPeer::DATABASE_NAME);

		$criteria->add(OpOpenContentPeer::CONTENT_ID, $pk);


		$v = OpOpenContentPeer::doSelect($criteria, $con);

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
			$criteria->add(OpOpenContentPeer::CONTENT_ID, $pks, Criteria::IN);
			$objs = OpOpenContentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpOpenContentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpOpenContentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpOpenContentMapBuilder');
}
