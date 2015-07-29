<?php


abstract class BaseOpProcPhasePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_proc_phase';

	
	const CLASS_DEFAULT = 'lib.model.OpProcPhase';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const STATUS_TYPE_ID = 'op_proc_phase.STATUS_TYPE_ID';

	
	const PHASE_TYPE_ID = 'op_proc_phase.PHASE_TYPE_ID';

	
	const PROCEDIMENTO_ID = 'op_proc_phase.PROCEDIMENTO_ID';

	
	const SENTENCE = 'op_proc_phase.SENTENCE';

	
	const MOTIVATION = 'op_proc_phase.MOTIVATION';

	
	const SOURCE_NAME = 'op_proc_phase.SOURCE_NAME';

	
	const SOURCE_URL = 'op_proc_phase.SOURCE_URL';

	
	const SOURCE_ATTACH = 'op_proc_phase.SOURCE_ATTACH';

	
	const PHASE_YEAR = 'op_proc_phase.PHASE_YEAR';

	
	const TRIBUNAL_LOCATION = 'op_proc_phase.TRIBUNAL_LOCATION';

	
	const ID = 'op_proc_phase.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('StatusTypeId', 'PhaseTypeId', 'ProcedimentoId', 'Sentence', 'Motivation', 'SourceName', 'SourceUrl', 'SourceAttach', 'PhaseYear', 'TribunalLocation', 'Id', ),
		BasePeer::TYPE_COLNAME => array (OpProcPhasePeer::STATUS_TYPE_ID, OpProcPhasePeer::PHASE_TYPE_ID, OpProcPhasePeer::PROCEDIMENTO_ID, OpProcPhasePeer::SENTENCE, OpProcPhasePeer::MOTIVATION, OpProcPhasePeer::SOURCE_NAME, OpProcPhasePeer::SOURCE_URL, OpProcPhasePeer::SOURCE_ATTACH, OpProcPhasePeer::PHASE_YEAR, OpProcPhasePeer::TRIBUNAL_LOCATION, OpProcPhasePeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('status_type_id', 'phase_type_id', 'procedimento_id', 'sentence', 'motivation', 'source_name', 'source_url', 'source_attach', 'phase_year', 'tribunal_location', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('StatusTypeId' => 0, 'PhaseTypeId' => 1, 'ProcedimentoId' => 2, 'Sentence' => 3, 'Motivation' => 4, 'SourceName' => 5, 'SourceUrl' => 6, 'SourceAttach' => 7, 'PhaseYear' => 8, 'TribunalLocation' => 9, 'Id' => 10, ),
		BasePeer::TYPE_COLNAME => array (OpProcPhasePeer::STATUS_TYPE_ID => 0, OpProcPhasePeer::PHASE_TYPE_ID => 1, OpProcPhasePeer::PROCEDIMENTO_ID => 2, OpProcPhasePeer::SENTENCE => 3, OpProcPhasePeer::MOTIVATION => 4, OpProcPhasePeer::SOURCE_NAME => 5, OpProcPhasePeer::SOURCE_URL => 6, OpProcPhasePeer::SOURCE_ATTACH => 7, OpProcPhasePeer::PHASE_YEAR => 8, OpProcPhasePeer::TRIBUNAL_LOCATION => 9, OpProcPhasePeer::ID => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('status_type_id' => 0, 'phase_type_id' => 1, 'procedimento_id' => 2, 'sentence' => 3, 'motivation' => 4, 'source_name' => 5, 'source_url' => 6, 'source_attach' => 7, 'phase_year' => 8, 'tribunal_location' => 9, 'id' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpProcPhaseMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpProcPhaseMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpProcPhasePeer::getTableMap();
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
		return str_replace(OpProcPhasePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpProcPhasePeer::STATUS_TYPE_ID);

		$criteria->addSelectColumn(OpProcPhasePeer::PHASE_TYPE_ID);

		$criteria->addSelectColumn(OpProcPhasePeer::PROCEDIMENTO_ID);

		$criteria->addSelectColumn(OpProcPhasePeer::SENTENCE);

		$criteria->addSelectColumn(OpProcPhasePeer::MOTIVATION);

		$criteria->addSelectColumn(OpProcPhasePeer::SOURCE_NAME);

		$criteria->addSelectColumn(OpProcPhasePeer::SOURCE_URL);

		$criteria->addSelectColumn(OpProcPhasePeer::SOURCE_ATTACH);

		$criteria->addSelectColumn(OpProcPhasePeer::PHASE_YEAR);

		$criteria->addSelectColumn(OpProcPhasePeer::TRIBUNAL_LOCATION);

		$criteria->addSelectColumn(OpProcPhasePeer::ID);

	}

	const COUNT = 'COUNT(op_proc_phase.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_proc_phase.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
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
		$objects = OpProcPhasePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpProcPhasePeer::populateObjects(OpProcPhasePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpProcPhasePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpProcPhasePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpStatusType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpPhaseType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinOpProcedimento(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpStatusType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpProcPhasePeer::addSelectColumns($c);
		$startcol = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpStatusTypePeer::addSelectColumns($c);

		$c->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpStatusTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpStatusType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpProcPhase($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpPhaseType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpProcPhasePeer::addSelectColumns($c);
		$startcol = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpPhaseTypePeer::addSelectColumns($c);

		$c->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPhaseTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpPhaseType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpProcPhase($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinOpProcedimento(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpProcPhasePeer::addSelectColumns($c);
		$startcol = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpProcedimentoPeer::addSelectColumns($c);

		$c->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpProcedimentoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getOpProcedimento(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addOpProcPhase($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$criteria->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);

		$criteria->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
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

		OpProcPhasePeer::addSelectColumns($c);
		$startcol2 = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpStatusTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpStatusTypePeer::NUM_COLUMNS;

		OpPhaseTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPhaseTypePeer::NUM_COLUMNS;

		OpProcedimentoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpProcedimentoPeer::NUM_COLUMNS;

		$c->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$c->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);

		$c->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpStatusTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpStatusType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpProcPhase($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1);
			}


					
			$omClass = OpPhaseTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpPhaseType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpProcPhase($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initOpProcPhases();
				$obj3->addOpProcPhase($obj1);
			}


					
			$omClass = OpProcedimentoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getOpProcedimento(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addOpProcPhase($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initOpProcPhases();
				$obj4->addOpProcPhase($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptOpStatusType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);

		$criteria->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpPhaseType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$criteria->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptOpProcedimento(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpProcPhasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$criteria->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);

		$rs = OpProcPhasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptOpStatusType(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpProcPhasePeer::addSelectColumns($c);
		$startcol2 = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpPhaseTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPhaseTypePeer::NUM_COLUMNS;

		OpProcedimentoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpProcedimentoPeer::NUM_COLUMNS;

		$c->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);

		$c->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpPhaseTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpPhaseType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpProcPhase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1);
			}

			$omClass = OpProcedimentoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpProcedimento(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpProcPhase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpProcPhases();
				$obj3->addOpProcPhase($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpPhaseType(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpProcPhasePeer::addSelectColumns($c);
		$startcol2 = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpStatusTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpStatusTypePeer::NUM_COLUMNS;

		OpProcedimentoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpProcedimentoPeer::NUM_COLUMNS;

		$c->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$c->addJoin(OpProcPhasePeer::PROCEDIMENTO_ID, OpProcedimentoPeer::CONTENT_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpStatusTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpStatusType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpProcPhase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1);
			}

			$omClass = OpProcedimentoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpProcedimento(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpProcPhase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpProcPhases();
				$obj3->addOpProcPhase($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptOpProcedimento(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpProcPhasePeer::addSelectColumns($c);
		$startcol2 = (OpProcPhasePeer::NUM_COLUMNS - OpProcPhasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpStatusTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpStatusTypePeer::NUM_COLUMNS;

		OpPhaseTypePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpPhaseTypePeer::NUM_COLUMNS;

		$c->addJoin(OpProcPhasePeer::STATUS_TYPE_ID, OpStatusTypePeer::ID);

		$c->addJoin(OpProcPhasePeer::PHASE_TYPE_ID, OpPhaseTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpProcPhasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = OpStatusTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpStatusType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpProcPhase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initOpProcPhases();
				$obj2->addOpProcPhase($obj1);
			}

			$omClass = OpPhaseTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getOpPhaseType(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addOpProcPhase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initOpProcPhases();
				$obj3->addOpProcPhase($obj1);
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
		return OpProcPhasePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(OpProcPhasePeer::ID); 

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
			$comparison = $criteria->getComparison(OpProcPhasePeer::ID);
			$selectCriteria->add(OpProcPhasePeer::ID, $criteria->remove(OpProcPhasePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpProcPhasePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpProcPhasePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpProcPhase) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpProcPhasePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpProcPhase $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpProcPhasePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpProcPhasePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpProcPhasePeer::DATABASE_NAME, OpProcPhasePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpProcPhasePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpProcPhasePeer::DATABASE_NAME);

		$criteria->add(OpProcPhasePeer::ID, $pk);


		$v = OpProcPhasePeer::doSelect($criteria, $con);

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
			$criteria->add(OpProcPhasePeer::ID, $pks, Criteria::IN);
			$objs = OpProcPhasePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpProcPhasePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpProcPhaseMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpProcPhaseMapBuilder');
}
