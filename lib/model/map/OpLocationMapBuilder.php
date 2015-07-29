<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_location' table to 'propel' DatabaseMap object.
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
class OpLocationMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpLocationMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_location');
		$tMap->setPhpName('OpLocation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('LOCATION_TYPE_ID', 'LocationTypeId', 'int', CreoleTypes::INTEGER, 'op_location_type', 'ID', true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MACROREGIONAL_ID', 'MacroregionalId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('REGIONAL_ID', 'RegionalId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PROVINCIAL_ID', 'ProvincialId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CITY_ID', 'CityId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PROV', 'Prov', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('INHABITANTS', 'Inhabitants', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_CHARGE_UPDATE', 'LastChargeUpdate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ALTERNATIVE_NAME', 'AlternativeName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MININT_REGIONAL_CODE', 'MinintRegionalCode', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MININT_PROVINCIAL_CODE', 'MinintProvincialCode', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MININT_CITY_CODE', 'MinintCityCode', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DATE_END', 'DateEnd', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('DATE_START', 'DateStart', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('NEW_LOCATION_ID', 'NewLocationId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('GPS_LAT', 'GpsLat', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('GPS_LON', 'GpsLon', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SLUG', 'Slug', 'string', CreoleTypes::VARCHAR, false, 300);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // OpLocationMapBuilder
