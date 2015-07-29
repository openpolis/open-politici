<?php


abstract class BaseOpImportLogPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_import_log';

	
	const CLASS_DEFAULT = 'lib.model.OpImportLog';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const IMPORT_ID = 'op_import_log.IMPORT_ID';

	
	const COUNTER = 'op_import_log.COUNTER';

	
	const TYPE = 'op_import_log.TYPE';

	
	const CREATED_AT = 'op_import_log.CREATED_AT';

	
	const IMPORTING_DATA = 'op_import_log.IMPORTING_DATA';

	
	const STATUS = 'op_import_log.STATUS';

	
	const MESSAGE = 'op_import_log.MESSAGE';

	
	const ID = 'op_import_log.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ImportId', 'Counter', 'Type', 'CreatedAt', 'ImportingData', 'Status', 'Message', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpImportLogPeer::IMPORT_ID, OpImportLogPeer::COUNTER, OpImportLogPeer::TYPE, OpImportLogPeer::CREATED_AT, OpImportLogPeer::IMPORTING_DATA, OpImportLogPeer::STATUS, OpImportLogPeer::MESSAGE, OpImportLogPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('import_id', 'counter', 'type', 'created_at', 'importing_data', 'status', 'message', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ImportId' => 0, 'Counter' => 1, 'Type' => 2, 'CreatedAt' => 3, 'ImportingData' => 4, 'Status' => 5, 'Message' => 6, 'Id' => 7, ),
		BasePeer::TYPE_COLNAME => array (OpImportLogPeer::IMPORT_ID => 0, OpImportLogPeer::COUNTER => 1, OpImportLogPeer::TYPE => 2, OpImportLogPeer::CREATED_AT => 3, OpImportLogPeer::IMPORTING_DATA => 4, OpImportLogPeer::STATUS => 5, OpImportLogPeer::MESSAGE => 6, OpImportLogPeer::ID => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('import_id' => 0, 'counter' => 1, 'type' => 2, 'created_at' => 3, 'importing_data' => 4, 'status' => 5, 'message' => 6, 'id' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpImportLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpImportLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpImportLogPeer::getTableMap();
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
		return str_replace(OpImportLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpImportLogPeer::IMPORT_ID);

		$criteria->addSelectColumn(OpImportLogPeer::COUNTER);

		$criteria->addSelectColumn(OpImportLogPeer::TYPE);

		$criteria->addSelectColumn(OpImportLogPeer::CREATED_AT);

		$criteria->addSelectColumn(OpImportLogPeer::IMPORTING_DATA);

		$criteria->addSelectColumn(OpImportLogPeer::STATUS);

		$criteria->addSelectColumn(OpImportLogPeer::MESSAGE);

		$criteria->addSelectColumn(OpImportLogPeer::ID);

	}

	const COUNT = 'COUNT(op_import_log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_import_log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpImportLogPeer::doSelectRS($criteria, $con);
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
		$objects = OpImportLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpImportLogPeer::populateObjects(OpImportLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpImportLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpImportLogPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpImport(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportLogPeer::IMPORT_ID, OpImportPeer::ID);

		$rs = OpImportLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpImport(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpImportLogPeer::addSelectColumns($c);
		$startcol = (OpImportLogPeer::NUM_COLUMNS - OpImportLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpImportPeer::addSelectColumns($c);

		$c->addJoin(OpImportLogPeer::IMPORT_ID, OpImportPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpImportPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpImport(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpImportLog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpImportLogs();
				$obj2->addOpImportLog($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpImportLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpImportLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpImportLogPeer::IMPORT_ID, OpImportPeer::ID);

		$rs = OpImportLogPeer::doSelectRS($criteria, $con);
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

		OpImportLogPeer::addSelectColumns($c);
		$startcol2 = (OpImportLogPeer::NUM_COLUMNS - OpImportLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpImportPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpImportPeer::NUM_COLUMNS;

		$c->addJoin(OpImportLogPeer::IMPORT_ID, OpImportPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpImportLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpImportPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpImport(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpImportLog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpImportLogs();
				$obj2->addOpImportLog($obj1);
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
		return OpImportLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpImportLogPeer::ID); 

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
			$comparison = $criteria->getComparison(OpImportLogPeer::ID);
			$selectCriteria->add(OpImportLogPeer::ID, $criteria->remove(OpImportLogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpImportLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpImportLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpImportLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpImportLogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpImportLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpImportLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpImportLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpImportLogPeer::DATABASE_NAME, OpImportLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpImportLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpImportLogPeer::DATABASE_NAME);

		$criteria->add(OpImportLogPeer::ID, $pk);


		$v = OpImportLogPeer::doSelect($criteria, $con);

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
			$criteria->add(OpImportLogPeer::ID, $pks, Criteria::IN);
			$objs = OpImportLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpImportLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpImportLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpImportLogMapBuilder');
}
