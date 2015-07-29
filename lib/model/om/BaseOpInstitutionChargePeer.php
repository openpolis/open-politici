<?php


abstract class BaseOpInstitutionChargePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_institution_charge';

	
	const CLASS_DEFAULT = 'lib.model.OpInstitutionCharge';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_institution_charge.CONTENT_ID';

	
	const POLITICIAN_ID = 'op_institution_charge.POLITICIAN_ID';

	
	const INSTITUTION_ID = 'op_institution_charge.INSTITUTION_ID';

	
	const CHARGE_TYPE_ID = 'op_institution_charge.CHARGE_TYPE_ID';

	
	const LOCATION_ID = 'op_institution_charge.LOCATION_ID';

	
	const CONSTITUENCY_ID = 'op_institution_charge.CONSTITUENCY_ID';

	
	const PARTY_ID = 'op_institution_charge.PARTY_ID';

	
	const GROUP_ID = 'op_institution_charge.GROUP_ID';

	
	const DATE_START = 'op_institution_charge.DATE_START';

	
	const DATE_END = 'op_institution_charge.DATE_END';

	
	const DESCRIPTION = 'op_institution_charge.DESCRIPTION';

	
	const MININT_VERIFIED_AT = 'op_institution_charge.MININT_VERIFIED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'PoliticianId', 'InstitutionId', 'ChargeTypeId', 'LocationId', 'ConstituencyId', 'PartyId', 'GroupId', 'DateStart', 'DateEnd', 'Description', 'MinintVerifiedAt', ),
		BasePeer::TYPE_COLNAME => array (OpInstitutionChargePeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID, OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionChargePeer::CHARGE_TYPE_ID, OpInstitutionChargePeer::LOCATION_ID, OpInstitutionChargePeer::CONSTITUENCY_ID, OpInstitutionChargePeer::PARTY_ID, OpInstitutionChargePeer::GROUP_ID, OpInstitutionChargePeer::DATE_START, OpInstitutionChargePeer::DATE_END, OpInstitutionChargePeer::DESCRIPTION, OpInstitutionChargePeer::MININT_VERIFIED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'politician_id', 'institution_id', 'charge_type_id', 'location_id', 'constituency_id', 'party_id', 'group_id', 'date_start', 'date_end', 'description', 'minint_verified_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'PoliticianId' => 1, 'InstitutionId' => 2, 'ChargeTypeId' => 3, 'LocationId' => 4, 'ConstituencyId' => 5, 'PartyId' => 6, 'GroupId' => 7, 'DateStart' => 8, 'DateEnd' => 9, 'Description' => 10, 'MinintVerifiedAt' => 11, ),
		BasePeer::TYPE_COLNAME => array (OpInstitutionChargePeer::CONTENT_ID => 0, OpInstitutionChargePeer::POLITICIAN_ID => 1, OpInstitutionChargePeer::INSTITUTION_ID => 2, OpInstitutionChargePeer::CHARGE_TYPE_ID => 3, OpInstitutionChargePeer::LOCATION_ID => 4, OpInstitutionChargePeer::CONSTITUENCY_ID => 5, OpInstitutionChargePeer::PARTY_ID => 6, OpInstitutionChargePeer::GROUP_ID => 7, OpInstitutionChargePeer::DATE_START => 8, OpInstitutionChargePeer::DATE_END => 9, OpInstitutionChargePeer::DESCRIPTION => 10, OpInstitutionChargePeer::MININT_VERIFIED_AT => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'politician_id' => 1, 'institution_id' => 2, 'charge_type_id' => 3, 'location_id' => 4, 'constituency_id' => 5, 'party_id' => 6, 'group_id' => 7, 'date_start' => 8, 'date_end' => 9, 'description' => 10, 'minint_verified_at' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpInstitutionChargeMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpInstitutionChargeMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpInstitutionChargePeer::getTableMap();
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
		return str_replace(OpInstitutionChargePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpInstitutionChargePeer::CONTENT_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::POLITICIAN_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::INSTITUTION_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::CHARGE_TYPE_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::LOCATION_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::CONSTITUENCY_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::PARTY_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::GROUP_ID);

		$criteria->addSelectColumn(OpInstitutionChargePeer::DATE_START);

		$criteria->addSelectColumn(OpInstitutionChargePeer::DATE_END);

		$criteria->addSelectColumn(OpInstitutionChargePeer::DESCRIPTION);

		$criteria->addSelectColumn(OpInstitutionChargePeer::MININT_VERIFIED_AT);

	}

	const COUNT = 'COUNT(op_institution_charge.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_institution_charge.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
		$objects = OpInstitutionChargePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpInstitutionChargePeer::populateObjects(OpInstitutionChargePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpInstitutionChargePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpInstitutionChargePeer::getOMClass();
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpInstitution(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpConstituency(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpenContentPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpInstitution(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpInstitutionPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpChargeTypePeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpLocationPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpConstituency(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpConstituencyPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpConstituencyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpConstituency(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPartyPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpGroupPeer::addSelectColumns($c);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpGroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol10 = $startcol9 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();


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
					$temp_obj2->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}


					
			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpInstitution(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
			}


					
			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpChargeType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}


					
			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpLocation(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}


					
			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpConstituency(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}


					
			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpParty(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
			}


					
			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj9 = new $cls();
			$obj9->hydrate($rs, $startcol9);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj9 = $temp_obj1->getOpGroup(); 				if ($temp_obj9->getPrimaryKey() === $obj9->getPrimaryKey()) {
					$newObject = false;
					$temp_obj9->addOpInstitutionCharge($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj9->initOpInstitutionCharges();
				$obj9->addOpInstitutionCharge($obj1);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpInstitution(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpConstituency(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpInstitutionChargePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$criteria->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$criteria->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$rs = OpInstitutionChargePeer::doSelectRS($criteria, $con);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpInstitution(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpChargeType(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
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
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpConstituency(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpParty(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpInstitution(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpChargeType(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
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
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpConstituency(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpParty(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpInstitution(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpChargeType(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
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
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpConstituency(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpParty(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpInstitutionPeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpInstitution(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
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
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpConstituency(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpParty(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpChargeTypePeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpInstitution(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpChargeType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpConstituency(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpParty(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpConstituency(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpLocationPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpPartyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpInstitution(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpChargeType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpLocation(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpParty(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
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

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpConstituencyPeer::NUM_COLUMNS;

		OpGroupPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpGroupPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpInstitution(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpChargeType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpLocation(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpConstituency(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpGroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpGroup(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpenContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpenContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		OpInstitutionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpInstitutionPeer::NUM_COLUMNS;

		OpChargeTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + OpChargeTypePeer::NUM_COLUMNS;

		OpLocationPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + OpLocationPeer::NUM_COLUMNS;

		OpConstituencyPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + OpConstituencyPeer::NUM_COLUMNS;

		OpPartyPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + OpPartyPeer::NUM_COLUMNS;

		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);

		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID);

		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpInstitutionChargePeer::getOMClass();

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
					$temp_obj2->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpInstitutionCharges();
				$obj2->addOpInstitutionCharge($obj1);
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
					$temp_obj3->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpInstitutionCharges();
				$obj3->addOpInstitutionCharge($obj1);
			}

			$omClass = OpInstitutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpInstitution(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initOpInstitutionCharges();
				$obj4->addOpInstitutionCharge($obj1);
			}

			$omClass = OpChargeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getOpChargeType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initOpInstitutionCharges();
				$obj5->addOpInstitutionCharge($obj1);
			}

			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getOpLocation(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initOpInstitutionCharges();
				$obj6->addOpInstitutionCharge($obj1);
			}

			$omClass = OpConstituencyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getOpConstituency(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initOpInstitutionCharges();
				$obj7->addOpInstitutionCharge($obj1);
			}

			$omClass = OpPartyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8  = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getOpParty(); 				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addOpInstitutionCharge($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj8->initOpInstitutionCharges();
				$obj8->addOpInstitutionCharge($obj1);
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
		return OpInstitutionChargePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpInstitutionChargePeer::CONTENT_ID);
			$selectCriteria->add(OpInstitutionChargePeer::CONTENT_ID, $criteria->remove(OpInstitutionChargePeer::CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpInstitutionChargePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpInstitutionChargePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpInstitutionCharge) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpInstitutionCharge $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpInstitutionChargePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpInstitutionChargePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpInstitutionChargePeer::DATABASE_NAME, OpInstitutionChargePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpInstitutionChargePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpInstitutionChargePeer::DATABASE_NAME);

		$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $pk);


		$v = OpInstitutionChargePeer::doSelect($criteria, $con);

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
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $pks, Criteria::IN);
			$objs = OpInstitutionChargePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpInstitutionChargePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpInstitutionChargeMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpInstitutionChargeMapBuilder');
}
