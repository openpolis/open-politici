<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_import' table to 'propel' DatabaseMap object.
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
class OpImportMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpImportMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_import');
		$tMap->setPhpName('OpImport');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('IMPORT_TYPE_ID', 'ImportTypeId', 'int', CreoleTypes::INTEGER, 'op_import_type', 'ID', true, null);

		$tMap->addForeignKey('IMPORT_MININT_ID', 'ImportMinintId', 'int', CreoleTypes::INTEGER, 'op_import_minint', 'ID', true, null);

		$tMap->addColumn('IMPORT_FILE', 'ImportFile', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IMPORT_LOCATION', 'ImportLocation', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('STARTED_AT', 'StartedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FINISHED_AT', 'FinishedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('RUN_TYPE', 'RunType', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addColumn('TOTAL', 'Total', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ERRORS', 'Errors', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WARNINGS', 'Warnings', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INSERTED', 'Inserted', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // OpImportMapBuilder
