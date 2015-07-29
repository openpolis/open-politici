<?php

/**
 * myUrlValidator extends the symfony built-in sfUrlValidator, by allowing underscores (_) to appear in the domains.
 *
 * @package    openpolis
 * @subpackage validator
 * @author     Guglielmo Celata <g.celata@deppit>
 * @version    SVN: $Id: sfUrlValidator.class.php 8720 2008-05-02 10:07:15Z FabianLange $
 */
class myUrlValidator extends sfUrlValidator
{
  /**
   * Executes this validator.
   *
   * @param mixed A file or parameter value/array
   * @param error An error message reference
   *
   * @return bool true, if this validator executes successfully, otherwise false
   */
  public function execute(&$value, &$error)
  {
    $re = '~^
      (https?|ftp)://                         # http or https or ftp
      (
        ([a-z0-9-_]+\.)+[a-z]{2,6}             # a domain name
          |                                   #  or
        \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}    # a IP address
      )
      (:[0-9]+)?                              # a port (optional)
      (/?|/\S+)                               # a /, nothing or a / with something
    $~ix';
    if (!preg_match($re, $value))
    {
      $error = $this->getParameterHolder()->get('url_error');
      return false;
    }

    return true;
  }

}
