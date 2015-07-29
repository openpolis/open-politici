<?php

/**
 * Admin generator with proper function handling batch options
 *
 * This class extends the sfAdminGenerator
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfAdminGenerator.class.php 9861 2008-06-25 12:07:06Z fabien $
 */
abstract class sfBatchableAdminGenerator extends sfAdminGenerator
{
  /**
   * Returns HTML code for an action option in a select tag.
   *
   * @param string  The action name
   * @param array   The parameters
   *
   * @return string HTML code
   */
  public function getOptionToAction($actionName, $params)
  {
    $options = isset($params['params']) ? sfToolkit::stringToArray($params['params']) : array();

    // default values
    if ($actionName[0] == '_')
    {
      $actionName = substr($actionName, 1);
      if ($actionName == 'deleteSelected')
      {
        $params['name'] = 'Delete Selected';
      }
    }
    $name = isset($params['name']) ? $params['name'] : $actionName;
    
    $options['value'] = $actionName;
    
    $phpOptions = var_export($options, true);
    
    return '[?php echo content_tag(\'option\', __(\''.$name.'\')'.($options ? ', '.$phpOptions : '').') ?]';
  }  
}

