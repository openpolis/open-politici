<?php


abstract class BaseOpPoliticalChargePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_political_charge';

	
	const CLASS_DEFAULT = 'lib.model.OpPoliticalCharge';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_political_charge.CONTENT_ID';

	
	const CHARGE_TYPE_ID = 'op_political_charge.CHARGE_TYPE_ID';

	
	const POLITICIAN_ID = 'op_political_charge.POLITICIAN_ID';

	
	const LOCATION_ID = 'op_political_charge.LOCATION_ID';

	
	const PARTY_ID = 'op_political_charge.PARTY_ID';

	
	const DATE_START = 'op_political_charge.DATE_START';

	
	const DATE_END = 'op_political_charge.DATE_END';

	
	const DESCRIPTION = 'op_political_charge.DESCRIPTION';

	
	const CURRENT = 'op_political_charge.CURRENT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'ChargeTypeId', 'PoliticianId', 'LocationId', 'PartyId', 'DateStart', 'DateEnd', 'Description', 'Current', ),
		BasePeer::TYPE_COLNAME => array (OpPoliticalChargePeer::CONTENT_ID, OpPoliticalChargePeer::CHARGE_TYPE_ID, OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticalChargePeer::LOCATION_ID, OpPoliticalChargePeer::PARTY_ID, OpPoliticalChargePeer::DATE_START, OpPoliticalChargePeer::DATE_END, OpPoliticalChargePeer::DESCRIPTION, OpPoliticalChargePeer::CURRENT, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'charge_type_id', 'politician_id', 'location_id', 'party_id', 'date_start', 'date_end', 'description', 'current', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'ChargeTypeId' => 1, 'PoliticianId' => 2, 'LocationId' => 3, 'PartyId' => 4, 'DateStart' => 5, 'DateEnd' => 6, 'Description' => 7, 'Current' => 8, ),
		BasePeer::TYPE_COLNAME => array (OpPoliticalChargePeer::CONTENT_ID => 0, OpPoliticalChargePeer::CHARGE_TYPE_ID => 1, OpPoliticalChargePeer::POLITICIAN_ID => 2, OpPoliticalChargePeer::LOCATION_ID => 3, OpPoliticalChargePeer::PARTY_ID => 4, OpPoliticalChargePeer::DATE_START => 5, OpPoliticalChargePeer::DATE_END => 6, OpPoliticalChargePeer::DESCRIPTION => 7, OpPoliticalChargePeer::CURRENT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'charge_type_id' => 1, 'politician_id' => 2, 'location_id' => 3, 'party_id' => 4, 'date_start' => 5, 'date_end' => 6, 'description' => 7, 'current' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpPoliticalChargeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpPoliticalChargeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpPoliticalChargePeer::getTableMap();
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
		return str_replace(OpPoliticalChargePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpPoliticalChargePeer::CONTENT_ID);

		$criteria->addSelectColumn(OpPoliticalChargePeer::CHARGE_TYPE_ID);

		$criteria->addSelectColumn(OpPoliticalChargePeer::POLITICIAN_ID);

		$criteria->addSelectColumn(OpPoliticalChargePeer::LOCATION_ID);

		$criteria->addSelectColumn(OpPoliticalChargePeer::PARTY_ID);

		$criteria->addSelectColumn(OpPoliticalChargePeer::DATE_START);

		$criteria->addSelectColumn(OpPoliticalChargePeer::DATE_END);

		$criteria->addSelectColumn(OpPoliticalChargePeer::DESCRIPTION);

		$criteria->addSelectColumn(OpPoliticalChargePeer::CURRENT);

	}

	const COUNT = 'COUNT(op_political_charge.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_political_charge.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
		$objects = OpPoliticalChargePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpPoliticalChargePeer::populateObjects(OpPoliticalChargePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpPoliticalChargePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpPoliticalChargePeer::getOMClass();
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpenContentPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
										$temp_obj2->addOpPoliticalCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1); 			}
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpChargeTypePeer::addSelectColumns($c);

		$c->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
										$temp_obj2->addOpPoliticalCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1); 			}
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
										$temp_obj2->addOpPoliticalCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpLocationPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpLocationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpPoliticalCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1); 			}
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPartyPeer::addSelectColumns($c);

		$c->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
										$temp_obj2->addOpPoliticalCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol2 = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpChargeTypePeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpPoliticianPeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpLocationPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();


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
					$temp_obj2->addOpPoliticalCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1);
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
					$temp_obj3->addOpPoliticalCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticalCharges();
				$obj3->addOpPoliticalCharge($obj1);
			}


					
			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpPolitician(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticalCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticalCharges();
				$obj4->addOpPoliticalCharge($obj1);
			}


					
			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpLocation(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticalCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticalCharges();
				$obj5->addOpPoliticalCharge($obj1);
			}


					
			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpParty(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpPoliticalCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initOpPoliticalCharges();
				$obj6->addOpPoliticalCharge($obj1);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPoliticalChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpPoliticalChargePeer::doSelectRS($criteria, $con);
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol2 = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpChargeTypePeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpLocationPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
					$temp_obj2->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1);
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
					$temp_obj3->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticalCharges();
				$obj3->addOpPoliticalCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpLocation(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticalCharges();
				$obj4->addOpPoliticalCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpParty(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticalCharges();
				$obj5->addOpPoliticalCharge($obj1);
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol2 = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpLocationPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
					$temp_obj2->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1);
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
					$temp_obj3->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticalCharges();
				$obj3->addOpPoliticalCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpLocation(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticalCharges();
				$obj4->addOpPoliticalCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpParty(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticalCharges();
				$obj5->addOpPoliticalCharge($obj1);
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol2 = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpLocationPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
					$temp_obj2->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpChargeType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticalCharges();
				$obj3->addOpPoliticalCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpLocation(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticalCharges();
				$obj4->addOpPoliticalCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpParty(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticalCharges();
				$obj5->addOpPoliticalCharge($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol2 = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpChargeTypePeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpPoliticianPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
					$temp_obj2->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpChargeType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticalCharges();
				$obj3->addOpPoliticalCharge($obj1);
			}

			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpPolitician(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticalCharges();
				$obj4->addOpPoliticalCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpParty(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticalCharges();
				$obj5->addOpPoliticalCharge($obj1);
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

		OpPoliticalChargePeer::addSelectColumns($c);
		$startcol2 = (OpPoliticalChargePeer::NUM_COLUMNS - OpPoliticalChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpChargeTypePeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpPoliticianPeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpLocationPeer::NUM_COLUMNS;

		$c->addJoin(OpPoliticalChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpPoliticalChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpPoliticalChargePeer::LOCATION_ID, OpLocationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpPoliticalChargePeer::getOMClass();

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
					$temp_obj2->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpPoliticalCharges();
				$obj2->addOpPoliticalCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpChargeType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpPoliticalCharges();
				$obj3->addOpPoliticalCharge($obj1);
			}

			$omClass = OpPoliticianPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpPolitician(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpPoliticalCharges();
				$obj4->addOpPoliticalCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpLocation(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpPoliticalCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpPoliticalCharges();
				$obj5->addOpPoliticalCharge($obj1);
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
		return OpPoliticalChargePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpPoliticalChargePeer::CONTENT_ID);
			$selectCriteria->add(OpPoliticalChargePeer::CONTENT_ID, $criteria->remove(OpPoliticalChargePeer::CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpPoliticalChargePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpPoliticalChargePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpPoliticalCharge) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpPoliticalChargePeer::CONTENT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpPoliticalCharge $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpPoliticalChargePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpPoliticalChargePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpPoliticalChargePeer::DATABASE_NAME, OpPoliticalChargePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpPoliticalChargePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpPoliticalChargePeer::DATABASE_NAME);

		$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $pk);


		$v = OpPoliticalChargePeer::doSelect($criteria, $con);

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
			$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $pks, Criteria::IN);
			$objs = OpPoliticalChargePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpPoliticalChargePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpPoliticalChargeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpPoliticalChargeMapBuilder');
}
