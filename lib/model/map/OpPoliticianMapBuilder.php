<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_politician' table to 'propel' DatabaseMap object.
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
class OpPoliticianMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpPoliticianMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_politician');
		$tMap->setPhpName('OpPolitician');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CONTENT_ID', 'ContentId', 'int' , CreoleTypes::INTEGER, 'op_content', 'ID', true, null);

		$tMap->addForeignKey('PROFESSION_ID', 'ProfessionId', 'int', CreoleTypes::INTEGER, 'op_profession', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'op_user', 'ID', false, null);

		$tMap->addForeignKey('CREATOR_ID', 'CreatorId', 'int', CreoleTypes::INTEGER, 'op_user', 'ID', false, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('SEX', 'Sex', 'string', CreoleTypes::VARCHAR, false, 1);

		$tMap->addColumn('PICTURE', 'Picture', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('BIRTH_DATE', 'BirthDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('BIRTH_LOCATION', 'BirthLocation', 'string', CreoleTypes::VARCHAR, false, 128);

		$tMap->addColumn('DEATH_DATE', 'DeathDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('LAST_CHARGE_UPDATE', 'LastChargeUpdate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IS_INDEXED', 'IsIndexed', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('MININT_AKA', 'MinintAka', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SLUG', 'Slug', 'string', CreoleTypes::VARCHAR, false, 300);

	} // doBuild()

} // OpPoliticianMapBuilder
