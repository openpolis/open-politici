<?php

/**
 * import actions.
 *
 * @package    openpolis
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class importActions extends autoimportActions
{
  public function executeRefresh()
  {
    $this->redirect('import/list');
  }
  
  public function executeDryReload()
  {
    /* TODO controllare perché non funziona
    $this->result = shell_exec($this->command . " > /dev/null &");
    ob_implicit_flush(true);
    sleep(2);
    $this->redirect('import/list');
    */
  }

  public function executeWetReload()
  {
  }
  
  public function executeLinkToLog()
  {
    $import_id = $this->getRequestParameter('id');
    $this->redirect('import_log/list?filters[import_id]='.$import_id."&filter=filter");
  }  
  
  
  public function executeDryRun()
  {
    $this->command = $this->run('--dry');
    $this->redirect('import/list');
    
  }

  public function executeWetRun()
  {
    $this->command = $this->run();
    $this->redirect('import/list');
  }
  

  private function run( $run_mode = '' )
  {
    $import = OpImportPeer::retrieveByPK($this->getRequestParameter('id'));
    $id = $import->getId();
    list($dummy, $type) = split("_", $import->getOpImportType()->getName());
    $file = $import->getImportFile();
    $match = preg_match("/^.*minint_(.*)\/.*$/", $file, $matches);
    $date = $matches[1];
    
    $runCommand  = sprintf("cd %s; ", SF_ROOT_DIR);
    
    $runCommand .= "php batch/import_clean_log.php " . $id . "; ";
    $runCommand .= "php batch/import_amm_locali_db_csv.php "  . $type . " \"" . $file . "\" " . $date . " " . $run_mode;
    $runCommand .= " --showskip ";
    $runCommand .= " --site=" . $this->getRequest()->getUriPrefix() . $this->getRequest()->getScriptName() . " ";
    
    sfContext::getInstance()->getLogger()->info('{command}'.$runCommand);
    $result = shell_exec($runCommand . " > /dev/null &");
    ob_implicit_flush(true);
    sleep(2);
  }
  
}
