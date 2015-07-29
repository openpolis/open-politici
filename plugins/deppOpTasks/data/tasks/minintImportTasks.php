<?php
/*
 * This file is part of the finosTasks package.
 *
 * (c) 2010 Guglielmo Celata <guglielmo.celata@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
?>
<?php
/**
 * @package    
 * @subpackage Task aggiungere blocchi alle aggiunte o rimozioni nel db per l'import da minint
 * @author     Guglielmo Celata <guglielmo.celata@depp.it>
 */
pake_desc("blocco automatico delle aggiunte");
pake_task('import-auto-block-new', 'project_exists');

pake_desc("blocco automatico delle rimozioni");
pake_task('import-auto-block-old', 'project_exists');

pake_desc("aggiunta campi n_diff e charges_differ ai record di op_import_similar");
pake_task('import-add-similar-fields', 'project_exists');



function run_import_add_similar_fields($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  $context = null;
  if (array_key_exists('context', $options)) {
    $context = $options['context'];
  }
  
  $location_id = null;
  if (array_key_exists('location_id', $options)) {
    $location_id = (int)$options['location_id'];
  }

  $sf_user = sfContext::getInstance()->getUser();
  $user = OpUserPeer::retrieveByPK(1);
  $sf_user->signIn($user);

  echo "memory usage: " . memory_get_usage( ) . "\n";
  $start_time = time();

  // fetch all new records (not already concretised), for given context and location
  $records = OpImportSimilarPeer::getByContextLocationId($context, $location_id);
  foreach ($records as $i => $rec) {

    // estrazione context da record
    $context = $rec->getContext();
    $msg = sprintf("id: %2d; context: %s\n\tnew: %s\n\told: %s\n", $i, $context, $rec->getNewCsvRec(), $rec->getOldCsvRec());
    echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));      
    
    
    // estrazione valori da csv
    $new_values = OpImportModificationsPeer::getHashFromReducedCSV($context, $rec->getNewCsvRec());
    $old_values = OpImportModificationsPeer::getHashFromReducedCSV($context, $rec->getOldCsvRec());
    
    // calcolo numero differenze, e se incarichi diversi
    $n_diff = 0;
    $charges_differ = false;
    $names_differ = false;
    $birth_dates_differ = false;
    $birth_places_differ = false;
    list($new_institution, $new_charge) = OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr(
                                            $context, $new_values['charge_desc']);
    list($old_institution, $old_charge) = OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr(
                                            $context, $old_values['charge_desc']);
                                            
    if ($new_institution != $old_institution ||
        $new_charge != $old_charge)
      $charges_differ = true;
      
    if ($new_values['last_name'] != $old_values['last_name'] ||
        $new_values['first_name'] != $old_values['first_name'])
      $names_differ = true;

    if ($new_values['birth_date'] != $old_values['birth_date'])
      $birth_dates_differ = true;

    if ($new_values['birth_place'] != $old_values['birth_place'])
      $birth_places_differ = true;


    foreach ($new_values as $key => $new_value)
      if ($new_value != $old_values[$key])
        $n_diff ++;


    $rec->setNDiffs($n_diff);
    $rec->setChargesDiffer($charges_differ);
    $rec->setNamesDiffer($names_differ);
    $rec->setBirthDatesDiffer($birth_dates_differ);
    $rec->setBirthPlacesDiffer($birth_places_differ);
    $rec->save();
    
    $msg = sprintf("\tn_diff: %d; charges_differ: %d; names_differ: %d\n", $n_diff, $charges_differ, $names_differ);
    echo pakeColor::colorize($msg, array('fg' => 'yellow', 'bold' => true));
    
  }

  $msg = sprintf("%4d record\n", count($records));
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));      

  $msg = sprintf(" [%4d sec] [%10d bytes]\n", time() - $start_time, memory_get_usage( ));
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));      
}



function run_import_auto_block_new($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  if(!array_key_exists('date', $options))
    throw new Exception("--date option is required");
  $date = $options['date'];

  $context = null;
  if (array_key_exists('context', $options)) {
    $context = $options['context'];
  }
  
  $location_id = null;
  if (array_key_exists('location_id', $options)) {
    $location_id = (int)$options['location_id'];
  }

  // standard error file handler
  $f_err_h = fopen('php://stderr','w');  

  $sf_user = sfContext::getInstance()->getUser();
  $user = OpUserPeer::retrieveByPK(1);
  $sf_user->signIn($user);

  echo "memory usage: " . memory_get_usage( ) . "\n";
  $start_time = time();

  // fetch all new records (not already concretised), for given context and location
  $records = OpImportModificationsPeer::getByRecTypeContextLocationIdDate('new', $date, $context, $location_id);
  foreach ($records as $i => $rec) {
    $context = $rec->getContext();
    
    // skip record with non null action type, if not starting with S
    // only non analyzed records, or records found similar can be analyzed
    // this is done in order to be able to launch the task more than once on the same recordset
    // it can be useful to refine blocking analysis
    if (!is_null($rec->getActionType()) && substr($rec->getActionType(), 0, 1) != 'S')
      continue;

    $msg = sprintf("%2d: %s ", $i, $rec->getCsvRec());
    echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));      

    // get values from processed (minint) csv
    $v = OpImportModificationsPeer::getHashFromReducedCSV($context, $rec->getCsvRec());
    
    // skip record whose date of charge start is before six years ago
    if (strtotime($v['charge_start_date']) - date('U') > 6 * 365 * 86400)
    {
      $rec->reject($sf_user);
      $rec->save();
      $msg = sprintf("\tcurrent charge started too long ago: %s - STOPPED\n", $v['charge_start_date']);
      echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false));
      continue;
    }
      
    // check which action is going to be performed on this new record
    // the action type is stored in the action_type field 
    $res = OpPoliticianPeer::computePoliticianAndActionTypeFromAnagraphicalData($v);
    $p = $res['politician'];
    $action_type = $res['action_type'];
    $rec->setActionType($action_type);
    $rec->save();

    // based on the action_type field value, actions are taken    
    switch ($action_type) {
      case OpImportModificationsPeer::CHARGE_ONLY:
      case OpImportModificationsPeer::CHARGE_BY_MININT_AKA:
        
        $msg = sprintf(":%s\n", $action_type);
        echo pakeColor::colorize($msg, array('fg' => 'white', 'bold' => false));                

        // check if the charge to import overlaps a charge in the openpolis db
        $overlap_res = OpInstitutionChargePeer::isChargeToImportOverlapping($v, $context, $p);
        $status = $overlap_res['status'];
        $existing_start_date = $overlap_res['existing_start_date'];
        $existing_end_date = $overlap_res['existing_end_date'];
        switch ($status) {
          case OpInstitutionChargePeer::OVERLAP_NO_EXISTING_CHARGES:
            $msg = sprintf("\tno previous analogue charge: - PASSED\n");
            echo pakeColor::colorize($msg, array('fg' => 'green', 'bold' => false));      
            break;
          case OpInstitutionChargePeer::OVERLAP_EXISTING_BUT_NOT_OVERLAPPING:
            $msg = sprintf("\tprevious closed:%s - %s - PASSED\n", $existing_start_date, $existing_end_date);
            echo pakeColor::colorize($msg, array('fg' => 'green', 'bold' => false));      
            break;
          case OpInstitutionChargePeer::OVERLAP_EXISTING_AND_OVERLAPPING:
          case OpInstitutionChargePeer::OVERLAP_EXISTING_CURRENT:
            $rec->reject($sf_user);
            $rec->save();
            $msg = sprintf("\tprevious overlapping or current charge: %s - %s - STOPPED\n", 
                           is_null($existing_start_date)?' NULL ':$existing_start_date, 
                           is_null($existing_end_date)?' NULL ':$existing_end_date);
            echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false)); 
            break;
          default:
            $msg = sprintf("\tunknown status: existing_start_date is null and existing_end_date is not null - ERROR\n" );
            echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false)); 
            break;
        }
        break;
        
      case OpImportModificationsPeer::DUPLICATE_POLITICIAN:
        $msg = sprintf("%s - ERRORE: politico duplicato\n", $action_type);
        echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => true));      
        break;
       
      case OpImportModificationsPeer::POLITICIAN_AND_CHARGE:
      case OpImportModificationsPeer::HAS_SIMILAR_POLITICIANS:
      default:
        $msg = sprintf(":%s\n", $action_type);
        echo pakeColor::colorize($msg, array('fg' => 'white', 'bold' => false));      
        break;
    }

  }

  $msg = sprintf(" [%4d sec] [%10d bytes]\n", time() - $start_time, memory_get_usage( ));
  echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));      
}


function run_import_auto_block_old($task, $args, $options)
{
  static $loaded;


  // load application context
  if (!$loaded)
  {
    _loader();
  }

  if(!array_key_exists('date', $options))
    throw new Exception("--date option is required");
  $date = $options['date'];
  
  $context = null;
  if (array_key_exists('context', $options)) {
    $context = $options['context'];
  }
  
  $location_id = null;
  if (array_key_exists('location_id', $options)) {
    $location_id = (int)$options['location_id'];
  }
  

  $sf_user = sfContext::getInstance()->getUser();
  $user = OpUserPeer::retrieveByPK(1);
  $sf_user->signIn($user);

  echo "memory usage: " . memory_get_usage( ) . "\n";
  $start_time = time();

  $records = OpImportModificationsPeer::getByRecTypeContextLocationId('old', $context, $location_id);
  foreach ($records as $i => $rec) {
    $context = $rec->getContext();
    
    $msg = sprintf("%2d: %s", $i, $rec->getCsvRec());
    echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));
    
    try
    {
      // get charge from processed csv
      $existing_ic = OpImportModificationsPeer::getInstitutionChargeFromReducedCSV($context, $rec->getCsvRec());      
    } catch (Exception $e) {
      $msg = sprintf(" %s\n", $e->getMessage());
      echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => true));      
      continue;
    }

    if ($existing_ic instanceof OpInstitutionCharge)
    {
      $user_id = $existing_ic->getOpOpenContent()->getUserId();
      if ($user_id != 1) {
        $rec->reject($sf_user);
        $msg = sprintf(" - user_id:%d BLOCKED\n", $user_id);
        echo pakeColor::colorize($msg, array('fg' => 'green', 'bold' => true));      
      } else {
        $msg = sprintf(" - admin\n");
        echo pakeColor::colorize($msg, array('fg' => 'yellow', 'bold' => true));                
      }
    } else {
      $msg = sprintf(" - charge or politician unknown - ERROR!\n");
      echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => true));      
    }
    
    
  }

  $msg = sprintf(" [%4d sec] [%10d bytes]\n", time() - $start_time, memory_get_usage( ));
  echo pakeColor::colorize($msg, array('fg' => 'red', 'bold' => false));      
}


