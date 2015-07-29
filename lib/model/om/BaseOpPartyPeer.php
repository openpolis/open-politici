<?php


abstract class BaseOpPartyPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_party';

	
	const CLASS_DEFAULT = 'lib.model.OpParty';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ISTAT_CODE = 'op_party.ISTAT_CODE';

	
	const NAME = 'op_party.NAME';

	
	const ACRONYM = 'op_party.ACRONYM';

	
	const PARTY = 'op_party.PARTY';

	
	const MAIN = 'op_party.MAIN';

	
	const ELECTORAL = 'op_party.ELECTORAL';

	
	const OID = 'op_party.OID';

	
	const ONAME = 'op_party.ONAME';

	
	const LOGO = 'op_party.LOGO';

	
	const ID = 'op_party.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IstatCode', 'Name', 'Acronym', 'Party', 'Main', 'Electoral', 'Oid', 'Oname', 'Logo', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpPartyPeer::ISTAT_CODE, OpPartyPeer::NAME, OpPartyPeer::ACRONYM, OpPartyPeer::PARTY, OpPartyPeer::MAIN, OpPartyPeer::ELECTORAL, OpPartyPeer::OID, OpPartyPeer::ONAME, OpPartyPeer::LOGO, OpPartyPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('istat_code', 'name', 'acronym', 'party', 'main', 'electoral', 'oid', 'oname', 'logo', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IstatCode' => 0, 'Name' => 1, 'Acronym' => 2, 'Party' => 3, 'Main' => 4, 'Electoral' => 5, 'Oid' => 6, 'Oname' => 7, 'Logo' => 8, 'Id' => 9, ),
		BasePeer::TYPE_COLNAME => array (OpPartyPeer::ISTAT_CODE => 0, OpPartyPeer::NAME => 1, OpPartyPeer::ACRONYM => 2, OpPartyPeer::PARTY => 3, OpPartyPeer::MAIN => 4, OpPartyPeer::ELECTORAL => 5, OpPartyPeer::OID => 6, OpPartyPeer::ONAME => 7, OpPartyPeer::LOGO => 8, OpPartyPeer::ID => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('istat_code' => 0, 'name' => 1, 'acronym' => 2, 'party' => 3, 'main' => 4, 'electoral' => 5, 'oid' => 6, 'oname' => 7, 'logo' => 8, 'id' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpPartyMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpPartyMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpPartyPeer::getTableMap();
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
		return str_replace(OpPartyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpPartyPeer::ISTAT_CODE);

		$criteria->addSelectColumn(OpPartyPeer::NAME);

		$criteria->addSelectColumn(OpPartyPeer::ACRONYM);

		$criteria->addSelectColumn(OpPartyPeer::PARTY);

		$criteria->addSelectColumn(OpPartyPeer::MAIN);

		$criteria->addSelectColumn(OpPartyPeer::ELECTORAL);

		$criteria->addSelectColumn(OpPartyPeer::OID);

		$criteria->addSelectColumn(OpPartyPeer::ONAME);

		$criteria->addSelectColumn(OpPartyPeer::LOGO);

		$criteria->addSelectColumn(OpPartyPeer::ID);

	}

	const COUNT = 'COUNT(op_party.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_party.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpPartyPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpPartyPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpPartyPeer::doSelectRS($criteria, $con);
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
		$objects = OpPartyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpPartyPeer::populateObjects(OpPartyPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpPartyPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpPartyPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return OpPartyPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpPartyPeer::ID); 

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
			$comparison = $criteria->getComparison(OpPartyPeer::ID);
			$selectCriteria->add(OpPartyPeer::ID, $criteria->remove(OpPartyPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpPartyPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpPartyPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpParty) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpPartyPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpParty $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpPartyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpPartyPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpPartyPeer::DATABASE_NAME, OpPartyPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpPartyPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpPartyPeer::DATABASE_NAME);

		$criteria->add(OpPartyPeer::ID, $pk);


		$v = OpPartyPeer::doSelect($criteria, $con);

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
			$criteria->add(OpPartyPeer::ID, $pks, Criteria::IN);
			$objs = OpPartyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpPartyPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpPartyMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpPartyMapBuilder');
}
