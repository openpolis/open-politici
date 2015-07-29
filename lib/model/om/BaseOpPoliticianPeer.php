<?php


abstract class BaseOpPoliticianPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_politician';

	
	const CLASS_DEFAULT = 'lib.model.OpPolitician';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_politician.CONTENT_ID';

	
	const PROFESSION_ID = 'op_politician.PROFESSION_ID';

	
	const USER_ID = 'op_politician.USER_ID';

	
	const CREATOR_ID = 'op_politician.CREATOR_ID';

	
	const FIRST_NAME = 'op_politician.FIRST_NAME';

	
	const LAST_NAME = 'op_politician.LAST_NAME';

	
	const SEX = 'op_politician.SEX';

	
	const PICTURE = 'op_politician.PICTURE';

	
	const BIRTH_DATE = 'op_politician.BIRTH_DATE';

	
	const BIRTH_LOCATION = 'op_politician.BIRTH_LOCATION';

	
	const DEATH_DATE = 'op_politician.DEATH_DATE';

	
	const LAST_CHARGE_UPDATE = 'op_politician.LAST_CHARGE_UPDATE';

	
	const IS_INDEXED = 'op_politician.IS_INDEXED';

	
	const MININT_AKA = 'op_politician.MININT_AKA';

	
	const SLUG = 'op_politician.SLUG';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'ProfessionId', 'UserId', 'CreatorId', 'FirstName', 'LastName', 'Sex', 'Picture', 'BirthDate', 'BirthLocation', 'DeathDate', 'LastChargeUpdate', 'IsIndexed', 'MinintAka', 'Slug', ),
		BasePeer::TYPE_COLNAME => array (OpPoliticianPeer::CONTENT_ID, OpPoliticianPeer::PROFESSION_ID, OpPoliticianPeer::USER_ID, OpPoliticianPeer::CREATOR_ID, OpPoliticianPeer::FIRST_NAME, OpPoliticianPeer::LAST_NAME, OpPoliticianPeer::SEX, OpPoliticianPeer::PICTURE, OpPoliticianPeer::BIRTH_DATE, OpPoliticianPeer::BIRTH_LOCATION, OpPoliticianPeer::DEATH_DATE, OpPoliticianPeer::LAST_CHARGE_UPDATE, OpPoliticianPeer::IS_INDEXED, OpPoliticianPeer::MININT_AKA, OpPoliticianPeer::SLUG, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'profession_id', 'user_id', 'creator_id', 'first_name', 'last_name', 'sex', 'picture', 'birth_date', 'birth_location', 'death_date', 'last_charge_update', 'is_indexed', 'minint_aka', 'slug', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'ProfessionId' => 1, 'UserId' => 2, 'CreatorId' => 3, 'FirstName' => 4, 'LastName' => 5, 'Sex' => 6, 'Picture' => 7, 'BirthDate' => 8, 'BirthLocation' => 9, 'DeathDate' => 10, 'LastChargeUpdate' => 11, 'IsIndexed' => 12, 'MinintAka' => 13, 'Slug' => 14, ),
		BasePeer::TYPE_COLNAME => array (OpPoliticianPeer::CONTENT_ID => 0, OpPoliticianPeer::PROFESSION_ID => 1, OpPoliticianPeer::USER_ID => 2, OpPoliticianPeer::CREATOR_ID => 3, OpPoliticianPeer::FIRST_NAME => 4, OpPoliticianPeer::LAST_NAME => 5, OpPoliticianPeer::SEX => 6, OpPoliticianPeer::PICTURE => 7, OpPoliticianPeer::BIRTH_DATE => 8, OpPoliticianPeer::BIRTH_LOCATION => 9, OpPoliticianPeer::DEATH_DATE => 10, OpPoliticianPeer::LAST_CHARGE_UPDATE => 11, OpPoliticianPeer::IS_INDEXED => 12, OpPoliticianPeer::MININT_AKA => 13, OpPoliticianPeer::SLUG => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'profession_id' => 1, 'user_id' => 2, 'creator_id' => 3, 'first_name' => 4, 'last_name' => 5, 'sex' => 6, 'picture' => 7, 'birth_date' => 8, 'birth_location' => 9, 'death_date' => 10, 'last_charge_update' => 11, 'is_indexed' => 12, 'minint_aka' => 13, 'slug' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpPoliticianMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpPoliticianMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpPoliticianPeer::getTableMap();
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
		return str_replace(OpPoliticianPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpPoliticianPeer::CONTENT_ID);

		$criteria->addSelectColumn(OpPoliticianPeer::PROFESSION_ID);

		$criteria->addSelectColumn(OpPoliticianPeer::USER_ID);

		$criteria->addSelectColumn(OpPoliticianPeer::CREATOR_ID);

		$criteria->addSelectColumn(OpPoliticianPeer::FIRST_NAME);

		$criteria->addSelectColumn(OpPoliticianPeer::LAST_NAME);

		$criteria->addSelectColumn(OpPoliticianPeer::SEX);

		$criteria->addSelectColumn(OpPoliticianPeer::PICTURE);

		$criteria->addSelectColumn(OpPoliticianPeer::BIRTH_DATE);

		$criteria->addSelectColumn(OpPoliticianPeer::BIRTH_LOCATION);

		$criteria->addSelectColumn(OpPoliticianPeer::DEATH_DATE);

		$criteria->addSelectColumn(OpPoliticianPeer::LAST_CHARGE_UPDATE);

		$criteria->addSelectColumn(OpPoliticianPeer::IS_INDEXED);

		$criteria->addSelectColumn(OpPoliticianPeer::MININT_AKA);

		$criteria->addSelectColumn(OpPoliticianPeer::SLUG);

	}

	const COUNT = 'COUNT(op_politician.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_politician.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
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
		$objects = OpPoliticianPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpPoliticianPeer::populateObjects(OpPoliticianPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpPoliticianPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpPoliticianPeer::getOMClass();
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
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpProfession(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpUserRelatedByCreatorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
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

		OpPoliticianPeer::addSelectColumns($c);
		$startcol = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpContentPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

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
										$temp_obj2->addOpPolitician($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpProfession(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianPeer::addSelectColumns($c);
		$startcol = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpProfessionPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpProfessionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpProfession(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpPolitician($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1); 			}
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

		OpPoliticianPeer::addSelectColumns($c);
		$startcol = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

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
										$temp_obj2->addOpPoliticianRelatedByUserId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticiansRelatedByUserId();
				$obj2->addOpPoliticianRelatedByUserId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpUserRelatedByCreatorId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianPeer::addSelectColumns($c);
		$startcol = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpUserPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpUserRelatedByCreatorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpPoliticianRelatedByCreatorId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticiansRelatedByCreatorId();
				$obj2->addOpPoliticianRelatedByCreatorId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
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

		OpPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		OpProfessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpProfessionPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpUserPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$c->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$c->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();


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
					$temp_obj2->addOpPolitician($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1);
			}


					
			$omClass = OpProfessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpProfession(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPolitician($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticians();
				$obj3->addOpPolitician($obj1);
			}


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpUserRelatedByUserId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticianRelatedByUserId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticiansRelatedByUserId();
				$obj4->addOpPoliticianRelatedByUserId($obj1);
			}


					
			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpUserRelatedByCreatorId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticianRelatedByCreatorId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticiansRelatedByCreatorId();
				$obj5->addOpPoliticianRelatedByCreatorId($obj1);
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
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpProfession(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpUserRelatedByCreatorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticianPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$criteria->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$rs = OpPoliticianPeer::doSelectRS($criteria, $con);
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

		OpPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpProfessionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpProfessionPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);

		$c->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpProfessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpProfession(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUserRelatedByUserId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPoliticianRelatedByUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticiansRelatedByUserId();
				$obj3->addOpPoliticianRelatedByUserId($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpUserRelatedByCreatorId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticianRelatedByCreatorId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticiansRelatedByCreatorId();
				$obj4->addOpPoliticianRelatedByCreatorId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpProfession(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpUserPeer::NUM_COLUMNS;

		OpUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpUserPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$c->addJoin(OpPoliticianPeer::USER_ID, OpUserPeer::ID);

		$c->addJoin(OpPoliticianPeer::CREATOR_ID, OpUserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

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
					$temp_obj2->addOpPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpUserRelatedByUserId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPoliticianRelatedByUserId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticiansRelatedByUserId();
				$obj3->addOpPoliticianRelatedByUserId($obj1);
			}

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpUserRelatedByCreatorId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticianRelatedByCreatorId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticiansRelatedByCreatorId();
				$obj4->addOpPoliticianRelatedByCreatorId($obj1);
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

		OpPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		OpProfessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpProfessionPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$c->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

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
					$temp_obj2->addOpPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1);
			}

			$omClass = OpProfessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpProfession(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticians();
				$obj3->addOpPolitician($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpUserRelatedByCreatorId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticianPeer::addSelectColumns($c);
		$startcol2 = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpContentPeer::NUM_COLUMNS;

		OpProfessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpProfessionPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticianPeer::CONTENT_ID, OpContentPeer::ID);

		$c->addJoin(OpPoliticianPeer::PROFESSION_ID, OpProfessionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticianPeer::getOMClass();

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
					$temp_obj2->addOpPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticians();
				$obj2->addOpPolitician($obj1);
			}

			$omClass = OpProfessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpProfession(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPolitician($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticians();
				$obj3->addOpPolitician($obj1);
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
		return OpPoliticianPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpPoliticianPeer::CONTENT_ID);
			$selectCriteria->add(OpPoliticianPeer::CONTENT_ID, $criteria->remove(OpPoliticianPeer::CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpPoliticianPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpPolitician) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpPoliticianPeer::CONTENT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpPolitician $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpPoliticianPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpPoliticianPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpPoliticianPeer::DATABASE_NAME, OpPoliticianPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpPoliticianPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpPoliticianPeer::DATABASE_NAME);

		$criteria->add(OpPoliticianPeer::CONTENT_ID, $pk);


		$v = OpPoliticianPeer::doSelect($criteria, $con);

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
			$criteria->add(OpPoliticianPeer::CONTENT_ID, $pks, Criteria::IN);
			$objs = OpPoliticianPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpPoliticianPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpPoliticianMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpPoliticianMapBuilder');
}
