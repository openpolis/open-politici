<?php


abstract class BaseOpTagHasOpOpinableContentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_tag_has_op_opinable_content';

	
	const CLASS_DEFAULT = 'lib.model.OpTagHasOpOpinableContent';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const TAG_ID = 'op_tag_has_op_opinable_content.TAG_ID';

	
	const OPINABLE_CONTENT_ID = 'op_tag_has_op_opinable_content.OPINABLE_CONTENT_ID';

	
	const USER_ID = 'op_tag_has_op_opinable_content.USER_ID';

	
	const IS_OBSCURED = 'op_tag_has_op_opinable_content.IS_OBSCURED';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('TagId', 'OpinableContentId', 'UserId', 'IsObscured', ),
		BasePeer::TYPE_COLNAME => array (OpTagHasOpOpinableContentPeer::TAG_ID, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpTagHasOpOpinableContentPeer::USER_ID, OpTagHasOpOpinableContentPeer::IS_OBSCURED, ),
		BasePeer::TYPE_FIELDNAME => array ('tag_id', 'opinable_content_id', 'user_id', 'is_obscured', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('TagId' => 0, 'OpinableContentId' => 1, 'UserId' => 2, 'IsObscured' => 3, ),
		BasePeer::TYPE_COLNAME => array (OpTagHasOpOpinableContentPeer::TAG_ID => 0, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID => 1, OpTagHasOpOpinableContentPeer::USER_ID => 2, OpTagHasOpOpinableContentPeer::IS_OBSCURED => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('tag_id' => 0, 'opinable_content_id' => 1, 'user_id' => 2, 'is_obscured' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpTagHasOpOpinableContentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpTagHasOpOpinableContentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpTagHasOpOpinableContentPeer::getTableMap();
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
		return str_replace(OpTagHasOpOpinableContentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::TAG_ID);

		$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID);

		$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::USER_ID);

		$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::IS_OBSCURED);

	}

	const COUNT = 'COUNT(op_tag_has_op_opinable_content.TAG_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_tag_has_op_opinable_content.TAG_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
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
		$objects = OpTagHasOpOpinableContentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpTagHasOpOpinableContentPeer::populateObjects(OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpTagHasOpOpinableContentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpTagHasOpOpinableContentPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpTag(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpTag(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpTagPeer::addSelectColumns($c);

		$c->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpTagPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpTag(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpTagHasOpOpinableContent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpinableContentPeer::addSelectColumns($c);

		$c->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();

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
										$temp_obj2->addOpTagHasOpOpinableContent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1); 			}
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

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();

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
										$temp_obj2->addOpTagHasOpOpinableContent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
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

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol2 = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpTagPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpTagPeer::NUM_COLUMNS;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpOpinableContentPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$c->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$c->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpTagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpTag(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpTagHasOpOpinableContent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1);
			}


					
			$omClass = OpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpTagHasOpOpinableContent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpTagHasOpOpinableContents();
				$obj3->addOpTagHasOpOpinableContent($obj1);
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
					$temp_obj4->addOpTagHasOpOpinableContent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpTagHasOpOpinableContents();
				$obj4->addOpTagHasOpOpinableContent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpTag(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpTagHasOpOpinableContentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$criteria->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpTagHasOpOpinableContentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpTag(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol2 = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpinableContentPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$c->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();

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
					$temp_obj2->addOpTagHasOpOpinableContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpTagHasOpOpinableContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpTagHasOpOpinableContents();
				$obj3->addOpTagHasOpOpinableContent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol2 = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpTagPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpTagPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$c->addJoin(OpTagHasOpOpinableContentPeer::USER_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpTagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpTag(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpTagHasOpOpinableContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpTagHasOpOpinableContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpTagHasOpOpinableContents();
				$obj3->addOpTagHasOpOpinableContent($obj1);
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

		OpTagHasOpOpinableContentPeer::addSelectColumns($c);
		$startcol2 = (OpTagHasOpOpinableContentPeer::NUM_COLUMNS - OpTagHasOpOpinableContentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpTagPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpTagPeer::NUM_COLUMNS;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpOpinableContentPeer::NUM_COLUMNS;

		$c->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);

		$c->addJoin(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpTagHasOpOpinableContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpTagPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpTag(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpTagHasOpOpinableContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpTagHasOpOpinableContents();
				$obj2->addOpTagHasOpOpinableContent($obj1);
			}

			$omClass = OpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpTagHasOpOpinableContent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpTagHasOpOpinableContents();
				$obj3->addOpTagHasOpOpinableContent($obj1);
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
		return OpTagHasOpOpinableContentPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpTagHasOpOpinableContentPeer::TAG_ID);
			$selectCriteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $criteria->remove(OpTagHasOpOpinableContentPeer::TAG_ID), $comparison);

			$comparison = $criteria->getComparison(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID);
			$selectCriteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $criteria->remove(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpTagHasOpOpinableContentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpTagHasOpOpinableContentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpTagHasOpOpinableContent) {

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

			$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $vals[0], Criteria::IN);
			$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpTagHasOpOpinableContent $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpTagHasOpOpinableContentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpTagHasOpOpinableContentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpTagHasOpOpinableContentPeer::DATABASE_NAME, OpTagHasOpOpinableContentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpTagHasOpOpinableContentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $tag_id, $opinable_content_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $tag_id);
		$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $opinable_content_id);
		$v = OpTagHasOpOpinableContentPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpTagHasOpOpinableContentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpTagHasOpOpinableContentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpTagHasOpOpinableContentMapBuilder');
}
