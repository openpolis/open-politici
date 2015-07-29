<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_proc_phase' table to 'propel' DatabaseMap object.
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
class OpProcPhaseMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpProcPhaseMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_proc_phase');
		$tMap->setPhpName('OpProcPhase');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('STATUS_TYPE_ID', 'StatusTypeId', 'int', CreoleTypes::INTEGER, 'op_status_type', 'ID', true, null);

		$tMap->addForeignKey('PHASE_TYPE_ID', 'PhaseTypeId', 'int', CreoleTypes::INTEGER, 'op_phase_type', 'ID', true, null);

		$tMap->addForeignKey('PROCEDIMENTO_ID', 'ProcedimentoId', 'int', CreoleTypes::INTEGER, 'op_procedimento', 'CONTENT_ID', true, null);

		$tMap->addColumn('SENTENCE', 'Sentence', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('MOTIVATION', 'Motivation', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SOURCE_NAME', 'SourceName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SOURCE_URL', 'SourceUrl', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SOURCE_ATTACH', 'SourceAttach', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('PHASE_YEAR', 'PhaseYear', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRIBUNAL_LOCATION', 'TribunalLocation', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // OpProcPhaseMapBuilder
