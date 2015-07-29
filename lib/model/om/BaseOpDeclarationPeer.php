<?php


abstract class BaseOpDeclarationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_declaration';

	
	const CLASS_DEFAULT = 'lib.model.OpDeclaration';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONTENT_ID = 'op_declaration.CONTENT_ID';

	
	const POLITICIAN_ID = 'op_declaration.POLITICIAN_ID';

	
	const DATE = 'op_declaration.DATE';

	
	const TITLE = 'op_declaration.TITLE';

	
	const TEXT = 'op_declaration.TEXT';

	
	const RELEVANCY_SCORE = 'op_declaration.RELEVANCY_SCORE';

	
	const SOURCE_NAME = 'op_declaration.SOURCE_NAME';

	
	const SOURCE_URL = 'op_declaration.SOURCE_URL';

	
	const SOURCE_FILE = 'op_declaration.SOURCE_FILE';

	
	const SOURCE_MIME = 'op_declaration.SOURCE_MIME';

	
	const SOURCE_SIZE = 'op_declaration.SOURCE_SIZE';

	
	const SLUG = 'op_declaration.SLUG';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId', 'PoliticianId', 'Date', 'Title', 'Text', 'RelevancyScore', 'SourceName', 'SourceUrl', 'SourceFile', 'SourceMime', 'SourceSize', 'Slug', ),
		BasePeer::TYPE_COLNAME => array (OpDeclarationPeer::CONTENT_ID, OpDeclarationPeer::POLITICIAN_ID, OpDeclarationPeer::DATE, OpDeclarationPeer::TITLE, OpDeclarationPeer::TEXT, OpDeclarationPeer::RELEVANCY_SCORE, OpDeclarationPeer::SOURCE_NAME, OpDeclarationPeer::SOURCE_URL, OpDeclarationPeer::SOURCE_FILE, OpDeclarationPeer::SOURCE_MIME, OpDeclarationPeer::SOURCE_SIZE, OpDeclarationPeer::SLUG, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id', 'politician_id', 'date', 'title', 'text', 'relevancy_score', 'source_name', 'source_url', 'source_file', 'source_mime', 'source_size', 'slug', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ContentId' => 0, 'PoliticianId' => 1, 'Date' => 2, 'Title' => 3, 'Text' => 4, 'RelevancyScore' => 5, 'SourceName' => 6, 'SourceUrl' => 7, 'SourceFile' => 8, 'SourceMime' => 9, 'SourceSize' => 10, 'Slug' => 11, ),
		BasePeer::TYPE_COLNAME => array (OpDeclarationPeer::CONTENT_ID => 0, OpDeclarationPeer::POLITICIAN_ID => 1, OpDeclarationPeer::DATE => 2, OpDeclarationPeer::TITLE => 3, OpDeclarationPeer::TEXT => 4, OpDeclarationPeer::RELEVANCY_SCORE => 5, OpDeclarationPeer::SOURCE_NAME => 6, OpDeclarationPeer::SOURCE_URL => 7, OpDeclarationPeer::SOURCE_FILE => 8, OpDeclarationPeer::SOURCE_MIME => 9, OpDeclarationPeer::SOURCE_SIZE => 10, OpDeclarationPeer::SLUG => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('content_id' => 0, 'politician_id' => 1, 'date' => 2, 'title' => 3, 'text' => 4, 'relevancy_score' => 5, 'source_name' => 6, 'source_url' => 7, 'source_file' => 8, 'source_mime' => 9, 'source_size' => 10, 'slug' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpDeclarationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpDeclarationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpDeclarationPeer::getTableMap();
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
		return str_replace(OpDeclarationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpDeclarationPeer::CONTENT_ID);

		$criteria->addSelectColumn(OpDeclarationPeer::POLITICIAN_ID);

		$criteria->addSelectColumn(OpDeclarationPeer::DATE);

		$criteria->addSelectColumn(OpDeclarationPeer::TITLE);

		$criteria->addSelectColumn(OpDeclarationPeer::TEXT);

		$criteria->addSelectColumn(OpDeclarationPeer::RELEVANCY_SCORE);

		$criteria->addSelectColumn(OpDeclarationPeer::SOURCE_NAME);

		$criteria->addSelectColumn(OpDeclarationPeer::SOURCE_URL);

		$criteria->addSelectColumn(OpDeclarationPeer::SOURCE_FILE);

		$criteria->addSelectColumn(OpDeclarationPeer::SOURCE_MIME);

		$criteria->addSelectColumn(OpDeclarationPeer::SOURCE_SIZE);

		$criteria->addSelectColumn(OpDeclarationPeer::SLUG);

	}

	const COUNT = 'COUNT(op_declaration.CONTENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_declaration.CONTENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpDeclarationPeer::doSelectRS($criteria, $con);
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
		$objects = OpDeclarationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpDeclarationPeer::populateObjects(OpDeclarationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpDeclarationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpDeclarationPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpDeclarationPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpDeclarationPeer::addSelectColumns($c);
		$startcol = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpOpinableContentPeer::addSelectColumns($c);

		$c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpDeclarationPeer::getOMClass();

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
										$temp_obj2->addOpDeclaration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpDeclarations();
				$obj2->addOpDeclaration($obj1); 			}
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

		OpDeclarationPeer::addSelectColumns($c);
		$startcol = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPoliticianPeer::addSelectColumns($c);

		$c->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpDeclarationPeer::getOMClass();

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
										$temp_obj2->addOpDeclaration($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpDeclarations();
				$obj2->addOpDeclaration($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$criteria->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpDeclarationPeer::doSelectRS($criteria, $con);
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

		OpDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpinableContentPeer::NUM_COLUMNS;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$c->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpDeclarationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpOpinableContentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpOpinableContent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpDeclaration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpDeclarations();
				$obj2->addOpDeclaration($obj1);
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
					$temp_obj3->addOpDeclaration($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpDeclarations();
				$obj3->addOpDeclaration($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpOpinableContent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);

		$rs = OpDeclarationPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpDeclarationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);

		$rs = OpDeclarationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpOpinableContent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS;

		$c->addJoin(OpDeclarationPeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpDeclarationPeer::getOMClass();

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
					$temp_obj2->addOpDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpDeclarations();
				$obj2->addOpDeclaration($obj1);
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

		OpDeclarationPeer::addSelectColumns($c);
		$startcol2 = (OpDeclarationPeer::NUM_COLUMNS - OpDeclarationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpOpinableContentPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpOpinableContentPeer::NUM_COLUMNS;

		$c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpDeclarationPeer::getOMClass();

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
					$temp_obj2->addOpDeclaration($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpDeclarations();
				$obj2->addOpDeclaration($obj1);
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
		return OpDeclarationPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpDeclarationPeer::CONTENT_ID);
			$selectCriteria->add(OpDeclarationPeer::CONTENT_ID, $criteria->remove(OpDeclarationPeer::CONTENT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpDeclarationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpDeclarationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpDeclaration) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpDeclarationPeer::CONTENT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpDeclaration $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpDeclarationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpDeclarationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpDeclarationPeer::DATABASE_NAME, OpDeclarationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpDeclarationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpDeclarationPeer::DATABASE_NAME);

		$criteria->add(OpDeclarationPeer::CONTENT_ID, $pk);


		$v = OpDeclarationPeer::doSelect($criteria, $con);

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
			$criteria->add(OpDeclarationPeer::CONTENT_ID, $pks, Criteria::IN);
			$objs = OpDeclarationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpDeclarationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpDeclarationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpDeclarationMapBuilder');
}
