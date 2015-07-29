<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_pol_adoption' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class OpPolAdoptionMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpPolAdoptionMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('op_pol_adoption');
		$tMap->setPhpName('OpPolAdoption');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'int' , CreoleTypes::INTEGER, 'op_user', 'ID', true, null);

		$tMap->addForeignPrimaryKey('POLITICIAN_ID', 'PoliticianId', 'int' , CreoleTypes::INTEGER, 'op_politician', 'CONTENT_ID', true, null);

		$tMap->addColumn('REQUESTED_AT', 'RequestedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('GRANTED_AT', 'GrantedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('REVOKED_AT', 'RevokedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('REFUSED_AT', 'RefusedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // OpPolAdoptionMapBuilder
