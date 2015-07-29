<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_import_similar' table to 'propel' DatabaseMap object.
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
class OpImportSimilarMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpImportSimilarMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_import_similar');
		$tMap->setPhpName('OpImportSimilar');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NEW_CSV_REC', 'NewCsvRec', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('OLD_CSV_REC', 'OldCsvRec', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CONTEXT', 'Context', 'string', CreoleTypes::VARCHAR, true, 10);

		$tMap->addForeignKey('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, 'op_location', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('DELETING_USER_ID', 'DeletingUserId', 'int', CreoleTypes::INTEGER, 'op_user', 'ID', false, null);

		$tMap->addColumn('N_DIFFS', 'NDiffs', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CHARGES_DIFFER', 'ChargesDiffer', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('NAMES_DIFFER', 'NamesDiffer', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('BIRTH_DATES_DIFFER', 'BirthDatesDiffer', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addColumn('BIRTH_PLACES_DIFFER', 'BirthPlacesDiffer', 'int', CreoleTypes::TINYINT, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // OpImportSimilarMapBuilder
