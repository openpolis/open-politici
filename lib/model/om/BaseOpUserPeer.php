<?php


abstract class BaseOpUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'op_user';

	
	const CLASS_DEFAULT = 'lib.model.OpUser';

	
	const NUM_COLUMNS = 31;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'op_user.ID';

	
	const LOCATION_ID = 'op_user.LOCATION_ID';

	
	const FIRST_NAME = 'op_user.FIRST_NAME';

	
	const LAST_NAME = 'op_user.LAST_NAME';

	
	const NICKNAME = 'op_user.NICKNAME';

	
	const IS_ACTIVE = 'op_user.IS_ACTIVE';

	
	const EMAIL = 'op_user.EMAIL';

	
	const SHA1_PASSWORD = 'op_user.SHA1_PASSWORD';

	
	const SALT = 'op_user.SALT';

	
	const WANT_TO_BE_MODERATOR = 'op_user.WANT_TO_BE_MODERATOR';

	
	const IS_MODERATOR = 'op_user.IS_MODERATOR';

	
	const IS_ADMINISTRATOR = 'op_user.IS_ADMINISTRATOR';

	
	const IS_AGGIUNGITOR = 'op_user.IS_AGGIUNGITOR';

	
	const IS_PREMIUM = 'op_user.IS_PREMIUM';

	
	const IS_ADHOC = 'op_user.IS_ADHOC';

	
	const DELETIONS = 'op_user.DELETIONS';

	
	const CREATED_AT = 'op_user.CREATED_AT';

	
	const PICTURE = 'op_user.PICTURE';

	
	const URL_PERSONAL_WEBSITE = 'op_user.URL_PERSONAL_WEBSITE';

	
	const NOTES = 'op_user.NOTES';

	
	const HAS_PAYPAL = 'op_user.HAS_PAYPAL';

	
	const REMEMBER_KEY = 'op_user.REMEMBER_KEY';

	
	const WANTS_NEWSLETTER = 'op_user.WANTS_NEWSLETTER';

	
	const PUBLIC_NAME = 'op_user.PUBLIC_NAME';

	
	const CHARGES = 'op_user.CHARGES';

	
	const RESOURCES = 'op_user.RESOURCES';

	
	const DECLARATIONS = 'op_user.DECLARATIONS';

	
	const POL_INSERTIONS = 'op_user.POL_INSERTIONS';

	
	const THEMES = 'op_user.THEMES';

	
	const COMMENTS = 'op_user.COMMENTS';

	
	const LAST_CONTRIBUTION = 'op_user.LAST_CONTRIBUTION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'LocationId', 'FirstName', 'LastName', 'Nickname', 'IsActive', 'Email', 'Sha1Password', 'Salt', 'WantToBeModerator', 'IsModerator', 'IsAdministrator', 'IsAggiungitor', 'IsPremium', 'IsAdhoc', 'Deletions', 'CreatedAt', 'Picture', 'UrlPersonalWebsite', 'Notes', 'HasPaypal', 'RememberKey', 'WantsNewsletter', 'PublicName', 'Charges', 'Resources', 'Declarations', 'PolInsertions', 'Themes', 'Comments', 'LastContribution', ),
		BasePeer::TYPE_COLNAME => array (OpUserPeer::ID, OpUserPeer::LOCATION_ID, OpUserPeer::FIRST_NAME, OpUserPeer::LAST_NAME, OpUserPeer::NICKNAME, OpUserPeer::IS_ACTIVE, OpUserPeer::EMAIL, OpUserPeer::SHA1_PASSWORD, OpUserPeer::SALT, OpUserPeer::WANT_TO_BE_MODERATOR, OpUserPeer::IS_MODERATOR, OpUserPeer::IS_ADMINISTRATOR, OpUserPeer::IS_AGGIUNGITOR, OpUserPeer::IS_PREMIUM, OpUserPeer::IS_ADHOC, OpUserPeer::DELETIONS, OpUserPeer::CREATED_AT, OpUserPeer::PICTURE, OpUserPeer::URL_PERSONAL_WEBSITE, OpUserPeer::NOTES, OpUserPeer::HAS_PAYPAL, OpUserPeer::REMEMBER_KEY, OpUserPeer::WANTS_NEWSLETTER, OpUserPeer::PUBLIC_NAME, OpUserPeer::CHARGES, OpUserPeer::RESOURCES, OpUserPeer::DECLARATIONS, OpUserPeer::POL_INSERTIONS, OpUserPeer::THEMES, OpUserPeer::COMMENTS, OpUserPeer::LAST_CONTRIBUTION, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'location_id', 'first_name', 'last_name', 'nickname', 'is_active', 'email', 'sha1_password', 'salt', 'want_to_be_moderator', 'is_moderator', 'is_administrator', 'is_aggiungitor', 'is_premium', 'is_adhoc', 'deletions', 'created_at', 'picture', 'url_personal_website', 'notes', 'has_paypal', 'remember_key', 'wants_newsletter', 'public_name', 'charges', 'resources', 'declarations', 'pol_insertions', 'themes', 'comments', 'last_contribution', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'LocationId' => 1, 'FirstName' => 2, 'LastName' => 3, 'Nickname' => 4, 'IsActive' => 5, 'Email' => 6, 'Sha1Password' => 7, 'Salt' => 8, 'WantToBeModerator' => 9, 'IsModerator' => 10, 'IsAdministrator' => 11, 'IsAggiungitor' => 12, 'IsPremium' => 13, 'IsAdhoc' => 14, 'Deletions' => 15, 'CreatedAt' => 16, 'Picture' => 17, 'UrlPersonalWebsite' => 18, 'Notes' => 19, 'HasPaypal' => 20, 'RememberKey' => 21, 'WantsNewsletter' => 22, 'PublicName' => 23, 'Charges' => 24, 'Resources' => 25, 'Declarations' => 26, 'PolInsertions' => 27, 'Themes' => 28, 'Comments' => 29, 'LastContribution' => 30, ),
		BasePeer::TYPE_COLNAME => array (OpUserPeer::ID => 0, OpUserPeer::LOCATION_ID => 1, OpUserPeer::FIRST_NAME => 2, OpUserPeer::LAST_NAME => 3, OpUserPeer::NICKNAME => 4, OpUserPeer::IS_ACTIVE => 5, OpUserPeer::EMAIL => 6, OpUserPeer::SHA1_PASSWORD => 7, OpUserPeer::SALT => 8, OpUserPeer::WANT_TO_BE_MODERATOR => 9, OpUserPeer::IS_MODERATOR => 10, OpUserPeer::IS_ADMINISTRATOR => 11, OpUserPeer::IS_AGGIUNGITOR => 12, OpUserPeer::IS_PREMIUM => 13, OpUserPeer::IS_ADHOC => 14, OpUserPeer::DELETIONS => 15, OpUserPeer::CREATED_AT => 16, OpUserPeer::PICTURE => 17, OpUserPeer::URL_PERSONAL_WEBSITE => 18, OpUserPeer::NOTES => 19, OpUserPeer::HAS_PAYPAL => 20, OpUserPeer::REMEMBER_KEY => 21, OpUserPeer::WANTS_NEWSLETTER => 22, OpUserPeer::PUBLIC_NAME => 23, OpUserPeer::CHARGES => 24, OpUserPeer::RESOURCES => 25, OpUserPeer::DECLARATIONS => 26, OpUserPeer::POL_INSERTIONS => 27, OpUserPeer::THEMES => 28, OpUserPeer::COMMENTS => 29, OpUserPeer::LAST_CONTRIBUTION => 30, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'location_id' => 1, 'first_name' => 2, 'last_name' => 3, 'nickname' => 4, 'is_active' => 5, 'email' => 6, 'sha1_password' => 7, 'salt' => 8, 'want_to_be_moderator' => 9, 'is_moderator' => 10, 'is_administrator' => 11, 'is_aggiungitor' => 12, 'is_premium' => 13, 'is_adhoc' => 14, 'deletions' => 15, 'created_at' => 16, 'picture' => 17, 'url_personal_website' => 18, 'notes' => 19, 'has_paypal' => 20, 'remember_key' => 21, 'wants_newsletter' => 22, 'public_name' => 23, 'charges' => 24, 'resources' => 25, 'declarations' => 26, 'pol_insertions' => 27, 'themes' => 28, 'comments' => 29, 'last_contribution' => 30, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/OpUserMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.OpUserMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = OpUserPeer::getTableMap();
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
		return str_replace(OpUserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(OpUserPeer::ID);

		$criteria->addSelectColumn(OpUserPeer::LOCATION_ID);

		$criteria->addSelectColumn(OpUserPeer::FIRST_NAME);

		$criteria->addSelectColumn(OpUserPeer::LAST_NAME);

		$criteria->addSelectColumn(OpUserPeer::NICKNAME);

		$criteria->addSelectColumn(OpUserPeer::IS_ACTIVE);

		$criteria->addSelectColumn(OpUserPeer::EMAIL);

		$criteria->addSelectColumn(OpUserPeer::SHA1_PASSWORD);

		$criteria->addSelectColumn(OpUserPeer::SALT);

		$criteria->addSelectColumn(OpUserPeer::WANT_TO_BE_MODERATOR);

		$criteria->addSelectColumn(OpUserPeer::IS_MODERATOR);

		$criteria->addSelectColumn(OpUserPeer::IS_ADMINISTRATOR);

		$criteria->addSelectColumn(OpUserPeer::IS_AGGIUNGITOR);

		$criteria->addSelectColumn(OpUserPeer::IS_PREMIUM);

		$criteria->addSelectColumn(OpUserPeer::IS_ADHOC);

		$criteria->addSelectColumn(OpUserPeer::DELETIONS);

		$criteria->addSelectColumn(OpUserPeer::CREATED_AT);

		$criteria->addSelectColumn(OpUserPeer::PICTURE);

		$criteria->addSelectColumn(OpUserPeer::URL_PERSONAL_WEBSITE);

		$criteria->addSelectColumn(OpUserPeer::NOTES);

		$criteria->addSelectColumn(OpUserPeer::HAS_PAYPAL);

		$criteria->addSelectColumn(OpUserPeer::REMEMBER_KEY);

		$criteria->addSelectColumn(OpUserPeer::WANTS_NEWSLETTER);

		$criteria->addSelectColumn(OpUserPeer::PUBLIC_NAME);

		$criteria->addSelectColumn(OpUserPeer::CHARGES);

		$criteria->addSelectColumn(OpUserPeer::RESOURCES);

		$criteria->addSelectColumn(OpUserPeer::DECLARATIONS);

		$criteria->addSelectColumn(OpUserPeer::POL_INSERTIONS);

		$criteria->addSelectColumn(OpUserPeer::THEMES);

		$criteria->addSelectColumn(OpUserPeer::COMMENTS);

		$criteria->addSelectColumn(OpUserPeer::LAST_CONTRIBUTION);

	}

	const COUNT = 'COUNT(op_user.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT op_user.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpUserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = OpUserPeer::doSelectRS($criteria, $con);
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
		$objects = OpUserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return OpUserPeer::populateObjects(OpUserPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			OpUserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = OpUserPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinOpLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpUserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpUserPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpUserPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinOpLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		OpUserPeer::addSelectColumns($c);
		$startcol = (OpUserPeer::NUM_COLUMNS - OpUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		OpLocationPeer::addSelectColumns($c);

		$c->addJoin(OpUserPeer::LOCATION_ID, OpLocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpUserPeer::getOMClass();

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
										$temp_obj2->addOpUser($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initOpUsers();
				$obj2->addOpUser($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(OpUserPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(OpUserPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(OpUserPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = OpUserPeer::doSelectRS($criteria, $con);
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

		OpUserPeer::addSelectColumns($c);
		$startcol2 = (OpUserPeer::NUM_COLUMNS - OpUserPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		OpLocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpLocationPeer::NUM_COLUMNS;

		$c->addJoin(OpUserPeer::LOCATION_ID, OpLocationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = OpUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = OpLocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getOpLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addOpUser($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initOpUsers();
				$obj2->addOpUser($obj1);
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
		return OpUserPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(OpUserPeer::ID);
			$selectCriteria->add(OpUserPeer::ID, $criteria->remove(OpUserPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(OpUserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(OpUserPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof OpUser) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(OpUserPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(OpUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(OpUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(OpUserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(OpUserPeer::DATABASE_NAME, OpUserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = OpUserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(OpUserPeer::DATABASE_NAME);

		$criteria->add(OpUserPeer::ID, $pk);


		$v = OpUserPeer::doSelect($criteria, $con);

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
			$criteria->add(OpUserPeer::ID, $pks, Criteria::IN);
			$objs = OpUserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseOpUserPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/OpUserMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.OpUserMapBuilder');
}
