<?php


abstract class BaseOpOrganizationChargePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_organization_charge';

	
	const CLASS_DEFAULT = 'lib.model.OpOrganizationCharge';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_organization_charge.CONTENT_ID';

	
	const POLITICIAN_ID = 'op_organization_charge.POLITICIAN_ID';

	
	const DATE_START = 'op_organization_charge.DATE_START';

	
	const DATE_END = 'op_organization_charge.DATE_END';

	
	const CHARGE_NAME = 'op_organization_charge.CHARGE_NAME';

	
	const ORGANIZATION_ID = 'op_organization_charge.ORGANIZATION_ID';

	
	const CURRENT = 'op_organization_charge.CURRENT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'PoliticianId', 'DateStart', 'DateEnd', 'ChargeName', 'OrganizationId', 'Current', ),
		BasePeer::TYPE_COLNAME => array (OpOrganizationChargePeer::CONTENT_ID, OpOrganizationChargePeer::POLITICIAN_ID, OpOrganizationChargePeer::DATE_START, OpOrganizationChargePeer::DATE_END, OpOrganizationChargePeer::CHARGE_NAME, OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationChargePeer::CURRENT, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'politician_id', 'date_start', 'date_end', 'charge_name', 'organization_id', 'current', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'PoliticianId' => 1, 'DateStart' => 2, 'DateEnd' => 3, 'ChargeName' => 4, 'OrganizationId' => 5, 'Current' => 6, ),
		BasePeer::TYPE_COLNAME => array (OpOrganizationChargePeer::CONTENT_ID => 0, OpOrganizationChargePeer::POLITICIAN_ID => 1, OpOrganizationChargePeer::DATE_START => 2, OpOrganizationChargePeer::DATE_END => 3, OpOrganizationChargePeer::CHARGE_NAME => 4, OpOrganizationChargePeer::ORGANIZATION_ID => 5, OpOrganizationChargePeer::CURRENT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'politician_id' => 1, 'date_start' => 2, 'date_end' => 3, 'charge_name' => 4, 'organization_id' => 5, 'current' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpOrganizationChargeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpOrganizationChargeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpOrganizationChargePeer::getTableMap();
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
		return str_replace(OpOrganizationChargePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpOrganizationChargePeer::CONTENT_ID);

		$criteria->addSelectColumn(OpOrganizationChargePeer::POLITICIAN_ID);

		$criteria->addSelectColumn(OpOrganizationChargePeer::DATE_START);

		$criteria->addSelectColumn(OpOrganizationChargePeer::DATE_END);

		$criteria->addSelectColumn(OpOrganizationChargePeer::CHARGE_NAME);

		$criteria->addSelectColumn(OpOrganizationChargePeer::ORGANIZATION_ID);

		$criteria->addSelectColumn(OpOrganizationChargePeer::CURRENT);

	}

	const COUNT = 'COUNT(op_organization_charge.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_organization_charge.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
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
		$objects = OpOrganizationChargePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpOrganizationChargePeer::populateObjects(OpOrganizationChargePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpOrganizationChargePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpOrganizationChargePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpOpenContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpOpenContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpenContentPeer::addSelectColumns($c);

		$c->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOpenContentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpOpenContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpOrganizationCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1); 			}
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

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();

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
										$temp_obj2->addOpOrganizationCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOrganizationPeer::addSelectColumns($c);

		$c->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();

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
										$temp_obj2->addOpOrganizationCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
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

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpOrganizationPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpOrganizationPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpOpenContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOpenContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOrganizationCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1);
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
					$temp_obj3->addOpOrganizationCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOrganizationCharges();
				$obj3->addOpOrganizationCharge($obj1);
			}


					
			$omClass = OpOrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpOrganization(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpOrganizationCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpOrganizationCharges();
				$obj4->addOpOrganizationCharge($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpOpenContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpOrganization(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpOrganizationChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpOrganizationChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpOpenContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		OpOrganizationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpOrganizationPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();

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
					$temp_obj2->addOpOrganizationCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1);
			}

			$omClass = OpOrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpOrganization(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpOrganizationCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOrganizationCharges();
				$obj3->addOpOrganizationCharge($obj1);
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

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpOrganizationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpOrganizationPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpOrganizationChargePeer::ORGANIZATION_ID, OpOrganizationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOpenContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOpenContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOrganizationCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1);
			}

			$omClass = OpOrganizationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpOrganization(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpOrganizationCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOrganizationCharges();
				$obj3->addOpOrganizationCharge($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpOrganization(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpOrganizationChargePeer::addSelectColumns($c);
		$startcol2 = (OpOrganizationChargePeer::NUM_COLUMNS - OpOrganizationChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpOrganizationChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpOrganizationChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpOrganizationChargePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpOpenContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOpenContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpOrganizationCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpOrganizationCharges();
				$obj2->addOpOrganizationCharge($obj1);
			}

			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpPolitician(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpOrganizationCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpOrganizationCharges();
				$obj3->addOpOrganizationCharge($obj1);
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
		return OpOrganizationChargePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpOrganizationChargePeer::CONTENT_ID);
			$selectCriteria->add(OpOrganizationChargePeer::CONTENT_ID, $criteria->remove(OpOrganizationChargePeer::CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpOrganizationChargePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpOrganizationChargePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpOrganizationCharge) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpOrganizationChargePeer::CONTENT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpOrganizationCharge $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpOrganizationChargePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpOrganizationChargePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpOrganizationChargePeer::DATABASE_NAME, OpOrganizationChargePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpOrganizationChargePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpOrganizationChargePeer::DATABASE_NAME);

		$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $pk);


		$v = OpOrganizationChargePeer::doSelect($criteria, $con);

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
			$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $pks, Criteria::IN);
			$objs = OpOrganizationChargePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpOrganizationChargePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpOrganizationChargeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpOrganizationChargeMapBuilder');
}
