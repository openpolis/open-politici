<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'op_user' table to 'propel' DatabaseMap object.
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
class OpUserMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.OpUserMapBuilder';

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

		$tMap = $this->dbMap->addTable('op_user');
		$tMap->setPhpName('OpUser');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, 'op_location', 'ID', false, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('NICKNAME', 'Nickname', 'string', CreoleTypes::VARCHAR, false, 16);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('SHA1_PASSWORD', 'Sha1Password', 'string', CreoleTypes::VARCHAR, false, 40);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('WANT_TO_BE_MODERATOR', 'WantToBeModerator', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_MODERATOR', 'IsModerator', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_ADMINISTRATOR', 'IsAdministrator', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_AGGIUNGITOR', 'IsAggiungitor', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_PREMIUM', 'IsPremium', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_ADHOC', 'IsAdhoc', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETIONS', 'Deletions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('PICTURE', 'Picture', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('URL_PERSONAL_WEBSITE', 'UrlPersonalWebsite', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NOTES', 'Notes', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('HAS_PAYPAL', 'HasPaypal', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('REMEMBER_KEY', 'RememberKey', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('WANTS_NEWSLETTER', 'WantsNewsletter', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('PUBLIC_NAME', 'PublicName', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('CHARGES', 'Charges', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RESOURCES', 'Resources', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DECLARATIONS', 'Declarations', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('POL_INSERTIONS', 'PolInsertions', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('THEMES', 'Themes', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAST_CONTRIBUTION', 'LastContribution', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // OpUserMapBuilder
