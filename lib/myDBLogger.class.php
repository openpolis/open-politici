<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>

<?php
/**
 * class that handles the logging of messages into a db table
 *
 * @return void
 * @author Guglielmo Celata
 **/
class myDBLogger
{
  protected $log_table = null;
  
  /**
   * constructor
   * create an instance of the logger class, specifying the model classes to use as storage
   *
   * @param log_table - propel class referring to the table that will contain the log records
   * @return void
   * @author Guglielmo Celata
   **/
  function __construct($log_class)
  {
    $this->logClass = $log_class;
  }
  
  /**
   * log messager regarding an importing record, using the class specified in the constructor
   *
   * @param import_id - foreign key to the id of the import
   * @param counter - integer - the counter of the analyzed record
   * @param import_type - char - the type of record analyzed or imported (R, P, C)
   * @param importing_data - string - the record that will be imported
   * @param status - string (S,V,I,P,PI) - the outcome of the import
   * @param message - single message - an optional message
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function log($import_id, $counter, $import_type, $importing_data, $status, $message)
  {
    if ($status == 'DS') {
      print "logging it\n";
    }
    $class = new $this->logClass();
    $class->setOpImport(OpImportPeer::retrieveByPK($import_id));
    $class->setCounter($counter);
    $class->setType($import_type);
    $class->setImportingData($importing_data);
    $class->setStatus($status);
    $class->setMessage($message);   
    $class->save();
  }
  
}
?>