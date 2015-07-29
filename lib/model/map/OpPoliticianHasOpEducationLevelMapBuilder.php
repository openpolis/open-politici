<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_politician_has_op_education_level' table to 'propel' DatabaseMap object.
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
class OpPoliticianHasOpEducationLevelMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpPoliticianHasOpEducationLevelMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_politician_has_op_education_level');
		$tMap->setPhpName('OpPoliticianHasOpEducationLevel');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('POLITICIAN_ID', 'PoliticianId', 'int' , CreoleTypes::INTEGER, 'op_politician', 'CONTENT_ID', true, null);

		$tMap->addForeignPrimaryKey('EDUCATION_LEVEL_ID', 'EducationLevelId', 'int' , CreoleTypes::INTEGER, 'op_education_level', 'ID', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

	} // doBuild()

} // OpPoliticianHasOpEducationLevelMapBuilder
