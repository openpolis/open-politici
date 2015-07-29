<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_import_modifications' table to 'propel' DatabaseMap object.
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
class OpImportModificationsMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpImportModificationsMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_import_modifications');
		$tMap->setPhpName('OpImportModifications');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('REC_TYPE', 'RecType', 'string', CreoleTypes::VARCHAR, true, 3);

		$tMap->addColumn('CONTEXT', 'Context', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addColumn('CSV_REC', 'CsvRec', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('ACTION_TYPE', 'ActionType', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('BLOCKED_AT', 'BlockedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CONCRETISED_AT', 'ConcretisedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('IMPORT_ID', 'ImportId', 'int', CreoleTypes::INTEGER, 'op_import_minint', 'ID', false, null);

		$tMap->addForeignKey('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, 'op_location', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // OpImportModificationsMapBuilder
