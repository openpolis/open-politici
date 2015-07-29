<?php

/**
 * extends Propel Admin generator, introducing batch actions
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelAdminGenerator.class.php 3302 2007-01-18 13:42:46Z fabien $
 */

class sfBatchablePropelAdminGenerator extends sfBatchablePropelCrudGenerator
{
  /**
   * Initializes the current sfGenerator instance.
   *
   * @param sfGeneratorManager A sfGeneratorManager instance
   */
  public function initialize($generatorManager)
  {
    parent::initialize($generatorManager);

    $this->setGeneratorClass('sfPropelAdmin');
  }

  public function getAllColumns()
  {
    $phpNames = array();
    foreach ($this->getTableMap()->getColumns() as $column)
    {
      $phpNames[] = new sfAdminColumn($column->getPhpName(), $column);
    }

    return $phpNames;
  }

  public function getAdminColumnForField($field, $flag = null)
  {
    $phpName = sfInflector::camelize($field);

    return new sfAdminColumn($phpName, $this->getColumnForPhpName($phpName), $flag);
  }

  // returns a column phpName or null if none was found
  public function getColumnForPhpName($phpName)
  {
    // search the matching column for this column name

    foreach ($this->getTableMap()->getColumns() as $column)
    {
      if ($column->getPhpName() == $phpName)
      {
        $found = true;

        return $column;
      }
    }

    // not a "real" column, so we will simulate one
    return null;
  }
}