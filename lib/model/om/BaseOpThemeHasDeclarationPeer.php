<?php


abstract class BaseOpThemeHasDeclarationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_theme_has_declaration';

	
	const CLASS_DEFAULT = 'lib.model.OpThemeHasDeclaration';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const DECLARATION_ID = 'op_theme_has_declaration.DECLARATION_ID';

	
	const THEME_ID = 'op_theme_has_declaration.THEME_ID';

	
	const PARTY_ID = 'op_theme_has_declaration.PARTY_ID';

	
	const POSITION = 'op_theme_has_declaration.POSITION';

	
	const CREATED_AT = 'op_theme_has_declaration.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('DeclarationId', 'ThemeId', 'PartyId', 'Position', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (OpThemeHasDeclarationPeer::DECLARATION_ID, OpThemeHasDeclarationPeer::THEME_ID, OpThemeHasDeclarationPeer::PARTY_ID, OpThemeHasDeclarationPeer::POSITION, OpThemeHasDeclarationPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('declaration_id', 'theme_id', 'party_id', 'position', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('DeclarationId' => 0, 'ThemeId' => 1, 'PartyId' => 2, 'Position' => 3, 'CreatedAt' => 4, ),
		BasePeer::TYPE_COLNAME => array (OpThemeHasDeclarationPeer::DECLARATION_ID => 0, OpThemeHasDeclarationPeer::THEME_ID => 1, OpThemeHasDeclarationPeer::PARTY_ID => 2, OpThemeHasDeclarationPeer::POSITION => 3, OpThemeHasDeclarationPeer::CREATED_AT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('declaration_id' => 0, 'theme_id' => 1, 'party_id' => 2, 'position' => 3, 'created_at' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpThemeHasDeclarationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpThemeHasDeclarationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpThemeHasDeclarationPeer::getTableMap();
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
		return str_replace(OpThemeHasDeclarationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpThemeHasDeclarationPeer::DECLARATION_ID);

		$criteria->addSelectColumn(OpThemeHasDeclarationPeer::THEME_ID);

		$criteria->addSelectColumn(OpThemeHasDeclarationPeer::PARTY_ID);

		$criteria->addSelectColumn(OpThemeHasDeclarationPeer::POSITION);

		$criteria->addSelectColumn(OpThemeHasDeclarationPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(op_theme_has_declaration.DECLARATION_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_theme_has_declaration.DECLARATION_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
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
		$objects = OpThemeHasDeclarationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpThemeHasDeclarationPeer::populateObjects(OpThemeHasDeclarationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpThemeHasDeclarationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpThemeHasDeclarationPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpDeclaration(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpTheme(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpParty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpDeclaration(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpDeclarationPeer::addSelectColumns($c);

		$c->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpDeclaration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpThemeHasDeclaration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpTheme(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpThemePeer::addSelectColumns($c);

		$c->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpThemePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpTheme(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpThemeHasDeclaration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpParty(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPartyPeer::addSelectColumns($c);

		$c->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPartyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpParty(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpThemeHasDeclaration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$criteria->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);

		$criteria->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
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

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpDeclarationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpDeclarationPeer::NUM_COLUMNS;

		OpThemePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpThemePeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$c->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);

		$c->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpDeclarationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpDeclaration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpThemeHasDeclaration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1);
			}


					
			$omClass = OpThemePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpTheme(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpThemeHasDeclaration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpThemeHasDeclarations();
				$obj3->addOpThemeHasDeclaration($obj1);
			}


					
			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpParty(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpThemeHasDeclaration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpThemeHasDeclarations();
				$obj4->addOpThemeHasDeclaration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpDeclaration(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);

		$criteria->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpTheme(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$criteria->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpParty(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpThemeHasDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$criteria->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);

		$rs = OpThemeHasDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpDeclaration(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpThemePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpThemePeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);

		$c->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpThemePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpTheme(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpThemeHasDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpParty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpThemeHasDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpThemeHasDeclarations();
				$obj3->addOpThemeHasDeclaration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpTheme(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpDeclarationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpDeclarationPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$c->addJoin(OpThemeHasDeclarationPeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpDeclarationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpDeclaration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpThemeHasDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpParty(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpThemeHasDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpThemeHasDeclarations();
				$obj3->addOpThemeHasDeclaration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpParty(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpThemeHasDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpThemeHasDeclarationPeer::NUM_COLUMNS - OpThemeHasDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpDeclarationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpDeclarationPeer::NUM_COLUMNS;

		OpThemePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpThemePeer::NUM_COLUMNS;

		$c->addJoin(OpThemeHasDeclarationPeer::DECLARATION_ID, OpDeclarationPeer::CONTENT_ID);

		$c->addJoin(OpThemeHasDeclarationPeer::THEME_ID, OpThemePeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpThemeHasDeclarationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpDeclarationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpDeclaration(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpThemeHasDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpThemeHasDeclarations();
				$obj2->addOpThemeHasDeclaration($obj1);
			}

			$omClass = OpThemePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpTheme(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpThemeHasDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpThemeHasDeclarations();
				$obj3->addOpThemeHasDeclaration($obj1);
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
		return OpThemeHasDeclarationPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpThemeHasDeclarationPeer::DECLARATION_ID);
			$selectCriteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $criteria->remove(OpThemeHasDeclarationPeer::DECLARATION_ID), $comparison);

			$comparison = $criteria->getComparison(OpThemeHasDeclarationPeer::THEME_ID);
			$selectCriteria->add(OpThemeHasDeclarationPeer::THEME_ID, $criteria->remove(OpThemeHasDeclarationPeer::THEME_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpThemeHasDeclarationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpThemeHasDeclarationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpThemeHasDeclaration) {

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

			$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $vals[0], Criteria::IN);
			$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(OpThemeHasDeclaration $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpThemeHasDeclarationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpThemeHasDeclarationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpThemeHasDeclarationPeer::DATABASE_NAME, OpThemeHasDeclarationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpThemeHasDeclarationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $declaration_id, $theme_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $declaration_id);
		$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $theme_id);
		$v = OpThemeHasDeclarationPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseOpThemeHasDeclarationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpThemeHasDeclarationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpThemeHasDeclarationMapBuilder');
}
