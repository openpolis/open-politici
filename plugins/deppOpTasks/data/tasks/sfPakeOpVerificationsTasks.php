<?php
/*
 * This file is part of the deppOpTasks package.
 *
 * (c) 2010 Guglielmo Celata <guglielmo.celata@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
<?php

pake_desc("sets the status of a group of institution charges, by specifying the location and type");
pake_task('op-verify-institution-charges', 'project_exists');

pake_desc("generates the list of similar politicians");
pake_task('op-check-similar-politicians', 'project_exists');

pake_desc("verifica e chiusura incarichi vecchi");
pake_task('op-verify-close-old-charges', 'project_exists');

pake_desc("inserisci slug per i politici che non lo hanno");
pake_task('op-slugify', 'project_exists');

pake_desc("inserisci slug per i contenuti");
pake_task('op-content-slugify', 'project_exists');


/* 

./symfony op-slugify --items=100000
./symfony op-content-slugify --field=title --table=op_declaration --id=content_id --items=20000
./symfony op-content-slugify --field=name --table=op_location --items=10000
./symfony op-content-slugify --field=short_name --table=op_institution --optional=name --items=50

*/
function run_op_content_slugify($task, $args, $options )
{
	static $loaded;

	// load application context
	$loaded OR _loader();

	$options = array_merge( array(
		'items' => 10,
		'field' => '',
		//'model' => '',
		'table' => '',
		'optional' => '',
		'id' => 'id'
	), $options);

	if (array_key_exists('help', $options) OR ($options['field'] == '') OR ($options['table'] == '') OR ($options['id'] == '') ) 
	  {
	    print "op-content-slugify --help\n";
	    print "\n";
	    print "Opzioni:\n";
	    print " --help stampa questa schermata\n";
	    print " --items[=10] numero di righe da aggiornare\n";
		print " --id[=id] nome del campo id\n";
		print " --table=nome della tabella da aggiornare\n";
	    print " --field=nome del campo di cui fare lo slug\n";
	    //print " --model=modello contenete il field\n";
	    print " --optional=secondo campo opzionale se il field è vuoto\n";
	    print "\n\n";

	    exit;
	  }
	// carico lo slugify
	sfLoader::loadHelpers(array('HeaderLinks'));
	// autenticazione come user admin (id = 1) per evitare l'indexing
	$user = OpUserPeer::retrieveByPK(1);
	sfContext::getInstance()->getUser()->signIn($user);
	
	// take connection 
	$con = Propel::getConnection();
	
	try
	{	
		$con->begin();
		
		$fields = array($options['id'],$options['field']);
		if ( $options['optional'] !== '' )
		{
			array_push($fields, $options['optional']);
		}
		//empty($options['optional']) OR array_push($fields, $options['id']);
		
		// preparo lo statement per la query 
		$rs = $con->createStatement()->executeQuery(sprintf(
			"SELECT ". implode(',',$fields)." FROM {$options['table']} WHERE slug = '' LIMIT %d", 
			$options['items']
		), ResultSet::FETCHMODE_ASSOC );
		
		// controllo se c'e' lavoro da fare
		if ( $rs->getRecordCount() == 0 )
		{
			echo "\nTutti i {$options['table']} hanno uno slug";
			return;
		}
		echo "\nInserimento dello slug in corso... ";

		$count = 0;
		$unconvertibles = array();
		// loop 
		while( $rs->next() )
		{
			
			$textToSlugify = $rs->getString($options['field']);
			//echo "\n text : $textToSlugify";
			if ( ($textToSlugify == '') AND $options['optional'] )
			{
				$textToSlugify = $rs->getString($options['optional']);
			}
			if ( trim($textToSlugify) == '' )
			{
				//throw new Exception('Elemento non convertibile : '. $rs->getInt($options['id']));
				$unconvertibles[] = $rs->getString($options['id']);
				continue;
			}
			
			$count++;

			$con->prepareStatement(sprintf(
				"UPDATE {$options['table']} SET slug=\"%s\" WHERE {$options['id']}=%d",
				// creo lo slug
				slugify( $textToSlugify ) ,
				// imposto il politico corretto
				$rs->getInt($options['id']) 
			// eseguo
			))->executeQuery();
			//echo " - ok\n";
		}
		
		//$con->rollback();
		$con->commit();
		
		echo "\n\n$count updates committed";
		
		if ( count($unconvertibles))
		{
			echo "\n\nCi sono elementi che non hanno un field valido :". implode(',', $unconvertibles);
		}
		
		if ( $options['items'] <= $rs->getRecordCount()  )
		{
			echo "\n\n\t Aggiornati {$count} su {$options['items']} senza slug, probabilmente ce ne sono altri ... \n";
		}
		else
		{
			echo "\n\n\t Aggiornati gli ultimi ".( $rs->getRecordCount() - count($unconvertibles)). ", task completato \n";
		}
		print "\n";
	}
	catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
}

function run_op_slugify($task, $args, $options)
{
  	static $loaded;

	// load application context
	if (!$loaded)
	{
	  _loader();
	}
	
	$options = array_merge( array(
		'items' => 10
	), $options);
	
	//sfContext::getInstance();
	sfLoader::loadHelpers(array('HeaderLinks'));
	
	// autenticazione come user admin (id = 1) per evitare l'indexing
	$user = OpUserPeer::retrieveByPK(1);
	sfContext::getInstance()->getUser()->signIn($user);
	
	try
	{	// take connection 
		$con = Propel::getConnection( OpPoliticianPeer::DATABASE_NAME );

		$con->begin();
	
		// preparo lo statement per la query dei politici
		$stmt = $con->createStatement();
		$rs = $stmt->executeQuery(sprintf(
			"SELECT content_id, first_name, last_name FROM op_politician WHERE slug = '' LIMIT %d", 
			$options['items']
		), ResultSet::FETCHMODE_ASSOC );
		
		// controllo se c'e' lavoro da fare
		if ( $rs->getRecordCount() == 0 )
		{
			echo "\nTutti i politici hanno uno slug";
			return;
		}
		echo "\nInserimento dello slug in corso... ";

		$count = 0;
		// loop dei politici
		while( $rs->next() )
		{
			$count++;
			$con->prepareStatement(sprintf(
				"UPDATE op_politician SET slug=\"%s\" WHERE content_id=%d",
				// creo lo slug
				slugify($rs->getString('first_name') .' '. $rs->getString('last_name')) ,
				// imposto il politico corretto
				$rs->getInt('content_id') 
			// eseguo
			))->executeQuery();
		}
		
		//$con->rollback();
		$con->commit();
		
		echo "\n\n$count updates committed";
		
		if ( $options['items'] >= $rs->getRecordCount()  )
		{
			echo "\n\n\t Aggiornati {$count} su {$options['items']} politici senza slug, probabilmente ce ne sono altri ... \n";
		}
		else
		{
			echo "\n\n\t Aggiornati gli ultimi ". $rs->getRecordCount(). " politici, task completato \n";
		}
	}
	catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
}


function run_op_verify_close_old_charges($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  if (count($options) == 0 || array_key_exists('help', $options))
  {
    print "op-verify-close-old-charges --help --context=CONT --location=ID1,ID2,... --exclude=ID1,ID2,... \n";
    print "                            --close[=DATE] --adjust[=DATE] --send-mail=ADDR1,ADDR2,... --time-interval=N\n";
    print "\n";
    print "Opzioni:\n";
    print " --help stampa questa schermata\n";
    print " --context=CONT cerca cariche vecchie in CONT (reg | prov | com.XXX)\n";
    print " --location=ID1,ID2,... cerca nelle location specificate (op_location.id)\n";
    print " --exclude=ID1,ID2,... non cercare nelle location specificate\n";
    print " --close[=DATE] chiude gli incarichi nel DB, usando data elezioni o inizio incarichi o quella indicata\n";
    print " --adjust[=DATE] sposta la data di inizio degli incarichi vecchi alla data di nomina sindaci/pres.giunta o a quella indicata\n";
    print " --send-mail=ADDR1,ADDR2 invia una mail di notifica agli indirizzi, se ci sono incarichi da chiudere\n";
    print " --time-interval=N intervallo in giorni per il quale le cariche sono considerate vecchie (N=0 default)\n";
    print "\n";
    print "Note:\n";
    print " .è necessario specificare un contesto, o almeno una location_id\n";
    print " .l'email viene inviata agli indirizzi specificati\n";
    print "\n\n";
    
    exit;
  }
  // autenticazione come user admin (id = 1)
  $user = OpUserPeer::retrieveByPK(1);
  sfContext::getInstance()->getUser()->signIn($user);

  $close = array_key_exists('close', $options);
  if ($close) {
    $close_date = $options['close'];
    if ($close_date != 1) {
      list($year, $month, $day) = explode('-', $close_date);
      if (!checkdate($month, $day, $year)) {
        $close_date = null;
      }
    } else $close_date = null;
  }

  $adjust = array_key_exists('adjust', $options);
  if ($adjust) {
    $adjust_date = $options['adjust'];
    if ($adjust_date != 1) {
      list($year, $month, $day) = explode('-', $adjust_date);
      if (!checkdate($month, $day, $year)) {
        $adjust_date = null;
      }
    } else $adjust_date = null;
  }

  $send_mail = null;
  if (array_key_exists('send-mail', $options)) {
    $send_mail = $options['send-mail'];
    $mail_addresses = explode(",", $send_mail);
  }

  // reg, prov, com.XXX
  $context = null;
  if (array_key_exists('context', $options)) {
    $context = $options['context'];
  }

  // ulteriore specifica, per test rapidi o in casi puntuali
  $locations = '';
  if (array_key_exists('location', $options)) {
    $locations = $options['location'];
  }

  if ($locations != '') {
    $location_ids = explode(",", $locations);
    $op_locations = OpLocationPeer::getByIds($location_ids);
  } else {
    $op_locations = OpLocationPeer::getByContext($context);
  }

  // eventuali location da escludere
  $excludes = '';
  $exclude_ids = array();
  if (array_key_exists('exclude', $options)){
    $excludes = $options['exclude'];
    $exclude_ids = explode(",", $excludes);
  }

  // specifica un time interval (in giorni) per il confronto
  $time_interval = 0;
  if (array_key_exists('time-interval', $options)){
    $time_interval = (int)$options['time-interval'];
  }

  $output = '';
  $n_differences = 0;
  foreach ($op_locations as $cnt => $location) {
    $loc_output = sprintf("location: %s", $location);

    if (in_array($location->getId(), $exclude_ids))
    {
      $loc_output .= " -> esclusa\n";
      continue;
    }

    if ($location->getLocationTypeId() == 6)
      $loc_output .= sprintf(" (%s)", $location->getProv());

    $loc_output .= sprintf(" [%s]", $location->getId());

    $latest_election = $location->getLastElection();
    $incarichi_aperti = OpInstitutionChargePeer::getActiveInLocations($location->getId());
    $main_charge = OpInstitutionChargePeer::getMainCharge($location);

    if (is_null($latest_election))
    {
      if (is_null($main_charge)) {
        printf("$loc_output\n  ATT!: questa località non ha elezioni associate, né sindaco/pres. giunta!\n");
        continue;
      } else {      
        $election_or_main_charge_start_date = $main_charge->getDateStart('Y-m-d');
        $election_or_main_charge_start_date_u = $main_charge->getDateStart('U');
        $loc_output .= sprintf("  nomina sindaco/pres. giunta: %s\n", $election_or_main_charge_start_date);
      }
    } else {
      $election_or_main_charge_start_date = $latest_election->getElectionDate('Y-m-d');
      $election_or_main_charge_start_date_u = $latest_election->getElectionDate('U');
      $loc_output .= sprintf("  ultime elezioni: %s", $election_or_main_charge_start_date);
      if (!is_null($main_charge)) {
        $loc_output .= sprintf("  nomina sindaco/pres. giunta: %s\n", $main_charge->getDateStart());
      }
    }


    foreach($incarichi_aperti as $incarico)
    {
      if ($election_or_main_charge_start_date_u - $incarico->getDateStart('U')  > $time_interval*86400) {
        $n_differences += 1;

        $loc_output .= sprintf ("  %s (%s dal %s)", 
                        $incarico->getOpPolitician(), $incarico->getOpChargeType(), $incarico->getDateStart());

        if ($close)
        {
          if (is_null($close_date))
            $incarico->close($election_or_main_charge_start_date);
          else
            $incarico->close($close_date);
          
          $loc_output .= " [CHIUSO] " . $incarico->getDateEnd('Y-m-d');
        }
        
        if ($adjust) {
          if (is_null($adjust_date))
            $incarico->setDateStart($main_charge->getDateStart('Y-m-d'));
          else
            $incarico->setDateStart($adjust_date);  

          $incarico->save();
          $loc_output .= " [CORRETTO] " . $incarico->getDateStart('Y-m-d');
        }

        $loc_output .= "\n";
      }
    }

    print $loc_output;
    $output .= $loc_output;
    
  }

  if ($n_differences) {
    print "\n n incarichi da chiudere/chiusi: $n_differences\n";
  }

  if ($send_mail && $n_differences && count($mail_addresses)) {
    print "would send an email\n";

    // class initialization
    $mail = new sfMail();
    $mail->initialize();
    $mail->setMailer('sendmail');
    $mail->setCharset('utf-8');

    // definition of the required parameters
    $mail->setSender('guglielmo@openpolis.it', 'Guglielmo at Openpolis');
    $mail->setFrom('noreply@openpolis.it', 'Openpolis');

    foreach ($mail_addresses as $address) {
      $mail->addAddress($address);
    }
    
    $mail->setSubject('Notifica task rimozione incarichi vecchi');
    $mail->setBody("Ci sono $n_differences incarichi che risultano vecchi rispetto a elezioni o a date di insediamento di sindaci o presidenti di giunta.
    
    Parametri
    =========
    context:       $context
    location:      $locations
    exclude:       $excludes
    time_interval: $time_interval
    
    ");
    $mail->addStringAttachment($output, 'incarichi_vecchi.txt');

    // send the email
    $mail->send();
  }    


}

/**
 * sets the status of a group of institution charges, by specifying the location and type
 *
 * @param string $task 
 * @param string $args
 * @param string $options 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_verify_institution_charges($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }
  
  echo pakeColor::colorize('Starting ', array('fg' => 'green', 'bold' => true)) . "\n";

  $usage = 'Uso: opp-verify-institution-charges tipo [nome-loc] [organo]';
  $n_args = count($args);
  if (!$n_args) {
    throw new Exception($usage);
  }
  if ($n_args > 3) {
    throw new Exception($usage);        
  }

  $tipo = $args[0];
  
  if (!in_array(strtolower($tipo), array('regione', 'provincia', 'comune', 'senato', 'camera', 'parlamento', 'europarlamento'))) {
    throw new Exception('Il tipo di istituzione da controllare può essere: regione, provincia, comune, senato, camera, parlamento, europarlamento');    
  }
  
  $c = new Criteria();
  $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
  
  switch ($tipo) {
    case 'regione':
      if ($n_args < 2) {
        throw new Exception('Specificare il nome della regione');
      }
      $name = $args[1];
      $region = OpLocationPeer::retrieveByNameType($name, 'regione');
      if (!$region) {
        throw new Exception("Regione $name sconosciuta");
      }
      $location_id = $region->getId();
      $c->add(OpInstitutionChargePeer::LOCATION_ID, $location_id);
            
      if ($n_args == 3) {
        $organo = $args[2];
        switch (strtolower($organo)) {
          case 'giunta':
            $c->add(OpInstitutionChargePeer::INSTITUTION_ID, 6);
            break;
          case 'consiglio':
            $c->add(OpInstitutionChargePeer::INSTITUTION_ID, 7);
            break;
          
          default:
            throw new Exception('Specificare se giunta o consiglio');
            break;
        }
        
        $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
        
      }
      
      break;
    default:
      # code...
      break;
  }
  
  $charges = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeType($c);
  echo "trovati " . count($charges) . " incarichi\n";
  foreach ($charges as $cnt => $charge) {
    printf("%10d: %30s %15s %10s %10s\n", 
            $charge->getContentId(), 
            $charge->getOpPolitician(), 
            $charge->getOpChargeType()->getName(),
            $charge->getDateStart('Y-m-d'),
            $charge->getDateEnd('Y-m-d'));
  }

  echo pakeColor::colorize('All done! ', array('fg' => 'green', 'bold' => true)) . "\n";
}


/**
 * loop over all op_politician record and generates the list of all similar politicians
 * in op_similar_politician
 *
 * @param string $task 
 * @param string $args
 * @param string $options 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_check_similar_politicians($task, $args, $options)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    define('SF_ROOT_DIR', sfConfig::get('sf_root_dir'));
    define('SF_APP', 'be');
    define('SF_ENVIRONMENT', 'task');
    define('SF_DEBUG', false);

    require_once (SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.
                  DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.
                  DIRECTORY_SEPARATOR.'config.php');


    sfContext::getInstance();
    sfConfig::set('pake', true);
    
    error_reporting(E_ALL);

    $loaded = true;
  }
  
  echo pakeColor::colorize('Starting ', array('fg' => 'green', 'bold' => true)) . "\n";
  echo "memory usage: " . memory_get_usage( ) . "\n";

  $usage = 'Uso: opp-check-similar-politicians --offset=M --limit=N --compares-birth_locations';

  
  // OpSimilarPoliticianPeer::doDeleteAll();
  // echo "rimossi tutti i record in op_similar_politician\n";

  $limit = null; $offset = null;
  
  if (array_key_exists('limit', $options))
    $limit = $options['limit'];
  if (array_key_exists('offset', $options))
    $offset = $options['offset'];
  
  $politicians = OpPoliticianPeer::getPoliticiansAnagraficaHash($limit, $offset);
  echo "trovati " . count($politicians) . " politici\n";
  
  $n_similar = 0;
  
  foreach ($politicians as $cnt => $politician) {
    printf("%06d/%d (%04d): %16s %20s %10s %30s (%9d bytes)\n", 
            $cnt+1, count($politicians), $n_similar, 
            $politician['first_name'], 
            $politician['last_name'], 
            date('d/m/Y', strtotime($politician['birth_date'])),
            $politician['birth_location'], 
            memory_get_usage( ));
    $similars = OpPoliticianPeer::getSimilarPoliticians($politician['first_name'], $politician['last_name'], $politician['birth_date'], array_key_exists('compares-birth-locations', $options)?$politician['birth_location']:null, $politician['content_id']);
    if (count($similars) > 0)
    {
      foreach ($similars as $similar) {
        // check che il record (o il reciproco) non siano già nella tabella
        if (OpSimilarPoliticianPeer::exists($politician['content_id'], $similar->getContentId())) continue;
        if (OpSimilarPoliticianPeer::exists($similar->getContentId(), $politician['content_id'])) continue;
        
        $sim_pol = new OpSimilarPolitician();
        $sim_pol->setOriginalId($politician['content_id']);
        $sim_pol->setSimilarId($similar->getContentId());
        $sim_pol->setComparesBirthLocations(array_key_exists('compares-birth-locations', $options));
        $sim_pol->setUserId(1); // tasks act as admin user
        $sim_pol->save();
        
        printf("    %7d: %20s %20s %10s\n",
               $similar->getContentId(),
               $similar->getFirstName(),
               $similar->getLastName(),
               $similar->getBirthDate('d/m/Y'));
        $n_similar ++;
      }
    }
  }
  echo pakeColor::colorize('All done! ', array('fg' => 'green', 'bold' => true)) . "\n";
}
