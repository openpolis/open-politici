<?php
/*
 * This file is part of the deppOpTasks package.
 *
 * (c) 2008 Guglielmo Celata <guglielmo.celata@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
<?php

pake_desc("create a list of URLs to pre-fetch, in order to populate the cache");
pake_task('op-urls-to-cache', 'project_exists');

pake_desc("costruisce consiglio del trentino alto adige, a partire dai consigli delle due province");
pake_task('op-build-taa-consiglio', 'project_exists');

pake_desc("chiusura incarichi per enti");
pake_task('op-chiusura-incarichi-locations', 'project_exists');

pake_desc("chiusura incarichi per comuni non più validi");
pake_task('op-close-incarichi-old-comuni', 'project_exists');

pake_desc("verifica e chiusura politici doppi");
pake_task('op-politico-cellho', 'project_exists');

pake_desc("aggiunta record elezioni");
pake_task('op-aggiungi-election-records', 'project_exists');

pake_desc("aggiorna cache utenti");
pake_task('op-update-users-cache', 'project_exists');


/**
 * add election records to op_election table
 * data are read from a csv file
 * usage: ./symfony op-aggiungi-election-records [--dry-run] --file=data/elezioni.csv
 *
 * @param string $task 
 * @param string $args 
 * @param string $options 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_aggiungi_election_records($task, $args, $options)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  // autenticazione come user admin (id = 1)
  $user = OpUserPeer::retrieveByPK(1);
  sfContext::getInstance()->getUser()->signIn($user);
  
  $dry_run = array_key_exists('dry-run', $options);


  // il file è specificato a partire dalla root di symfony: data/elezioni.csv
  if (array_key_exists('file', $options)) {
    $csv_file = $options['file'];
  } else {
    throw new Exception("Il path completo del file csv, relativo alla root dir del progetto è obbligatorio");
  }
    
  # lettura file csv
  $handle = @fopen($csv_file, "r");
  if ($handle) {
    while (($data = fgetcsv($handle)) !== FALSE) {
      $date = $data[0];
      $type = $data[1];
      $reg_locations = $data[2];
      $prov_locations =$data[3];
      #$com_locations =$data[4];

      /*
      TODO
      if ($type == 'Comunali')
      {
        $extended_location_type = 'comune';
        $locations = explode(",", $com_locations);        
      }
      */
      if ($type == 'Provinciali')
      {
        $extended_location_type = 'provincia';
        $locations = explode(",", $prov_locations);        
      }
      if ($type == 'Regionali')
      {
        $extended_location_type = 'regione';
        $locations = explode(",", $reg_locations);
      }

      if (in_array($type, array('Comunali', 'Provinciali', 'Regionali')))
      {
        $el_type = OpElectionTypePeer::retrieveByName($extended_location_type);
        foreach ($locations as $cnt => $loc) {
          $loc = trim($loc);
          $op_loc = OpLocationPeer::retrieveByNameType($loc, $extended_location_type);
          $election_date = OpImportModificationsPeer::getDBDate($date);
          if (!$dry_run) {
            $election = new OpElection();
            $election->setElectionDate($election_date);
            $election->setOpElectionType($el_type);
            $election->setOpLocation($op_loc);
            $election->save();
          }
          printf("%d => %s, %s, %s\n", $cnt+1, $election_date, $el_type, $op_loc);
        }        
      }
      
    }

    fclose($handle);
  }
  unset($handle);
}

/**
 * chiude gli incarichi per comuni indicati negli argomenti
 *
 * @param string $task 
 * @param string $args 
 * @param string $options 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_chiusura_incarichi_locations($task, $args, $options)
{
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  // autenticazione come user admin (id = 1)
  $user = OpUserPeer::retrieveByPK(1);
  sfContext::getInstance()->getUser()->signIn($user);
  
  $dry_run = array_key_exists('dry-run', $options);
  
  $closing_date = date('Y-m-d');
  if (array_key_exists('date', $options)) {
    $closing_date = $options['date'];
  }
  
  // eventuali incarichi da escludere
  $exclude_ids = array();
  if (array_key_exists('exclude', $options)){
    $exclude_ids = explode(",", $options['exclude']);
  }
  
  if (count($args) == 0) {
    throw new Exception("E' necessario specificare gli ID (location_id) degli enti da chiudere");
  }

  
  $incarichi_aperti = OpInstitutionChargePeer::getActiveInLocations($args);
  foreach($incarichi_aperti as $incarico)
  {
    printf ("%s - %s (%s [%d])", $incarico->getOpLocation(), $incarico->getOpPolitician(), 
                                 $incarico->getOpChargeType(), $incarico->getContentId());

    if (in_array($incarico->getContentId(), $exclude_ids))
    {
      echo " -> escluso\n";
      continue;
    }
    
    if (!$dry_run)
    {
      $incarico->setDateEnd($closing_date);
      $incarico->save();
      echo " -> incarico chiuso ($closing_date)";
    } else {
      echo " -> incarico da chiudere ($closing_date)";
    }
    echo "\n";
  }

}


/**
 * extracts a list of URLs to pre-fetch, in order to pre-fetch them (wget, curl, jmeter, ...)
 * and generate the cache on the server (memcache, filecache) and avoid cpu boost after system restart
 *
 * @param string $task 
 * @param string $args 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_urls_to_cache($task, $args)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    define('SF_ROOT_DIR', sfConfig::get('sf_root_dir'));
    define('SF_APP', 'fe');
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
  
  $site_url = sfConfig::get('sf_site_url', 'op_openpolis');
  
  $urls = array(
    "/",
    "/politici",
    "/argomenti",
    "/attiDecretiLegislativi",
    "/chisiamo",
    "/prossimipassi",
    "/contatti",
    "/contribuisci",
    "/blog",
    "/feed",
    "/software",
    "/regolamento",
    "/condizioni",
    "/informativa",
  );
  
  foreach ($urls as $url)
    echo "http://".$site_url.$url."\n";
    
  // TO BE CONTINUED ...
}

/**
 * costruisce consiglio regionale del trentino alto adige, unendo i consigli delle due province
 * i consiglieri in carica sono 'chiusi' preventivamente
 *
 * @param string $task 
 * @param string $args 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_build_taa_consiglio($task, $args, $options)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    define('SF_ROOT_DIR', sfConfig::get('sf_root_dir'));
    define('SF_APP', 'fe');
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
  
  $site_url = sfConfig::get('sf_site_url', 'op_openpolis');
  
  // autenticazione come user admin (id = 1)
  $user = OpUserPeer::retrieveByPK(1);
  sfContext::getInstance()->getUser()->signIn($user);
  
  
  $run_dry = array_key_exists('dry-run', $options);
  
  // estrazione consiglieri regionali trento e chiusura incarichi
  $c = new Criteria();
  $c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);
  $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
  $c->add(OpLocationPeer::LOCATION_TYPE_ID, 4);
  $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, 13);
  $c->add(OpInstitutionChargePeer::INSTITUTION_ID, 7);
  $c->add(OpLocationPeer::NAME, 'Trent%', Criteria::LIKE);
  $c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
  $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  
  echo "Consiglieri regionali\n";
  $consiglieri_regionali = OpInstitutionChargePeer::doSelect($c);
  foreach($consiglieri_regionali as $consigliere)
  {
    echo $consigliere->getOpPolitician() . " (" .$consigliere->getContentId().")";
    if (!$run_dry)
    {
      $consigliere->setDateEnd('2008-11-10');
      $consigliere->save();
      echo " -> incarico chiuso";
    }
    echo "\n";
  }


  // estrazione consiglieri province trento e bolzano e merge nel consiglio regionale
  $c = new Criteria();
  $c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);
  $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
  $c->add(OpLocationPeer::LOCATION_TYPE_ID, 5);
  $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, 13);
  $c->add(OpInstitutionChargePeer::INSTITUTION_ID, 9);
  $c->add(OpLocationPeer::NAME, array('Trento', 'Bolzano - Bozen'), Criteria::IN);
  $c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
  $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  
  echo "\nConsiglieri provinciali\n";
  $consiglieri_provinciali = OpInstitutionChargePeer::doSelect($c);
  foreach($consiglieri_provinciali as $consigliere)
  {
    echo $consigliere->getOpPolitician() . " (" .$consigliere->getContentId().")";
    if (!$run_dry)
    {
      $incarico_reg = new OpInstitutionCharge();
      $incarico_reg->setContentId($consigliere->getContentId());
      $incarico_reg->setPoliticianId($consigliere->getPoliticianId());
      $incarico_reg->setInstitutionId(7);
      $incarico_reg->setChargeTypeId($consigliere->getChargeTypeId());
      $incarico_reg->setLocationId(6);
      $incarico_reg->setPartyId($consigliere->getPartyId());
      $incarico_reg->setGroupId($consigliere->getGroupId());
      $incarico_reg->setDateStart($consigliere->getLocationId()==44?'2008-12-02':'2008-11-18');
      $incarico_reg->save();
      echo " -> aggiunto";
    }
    echo "\n";
  }
  
  
}

/**
 * chiude tutti gli incarichi che si riferiscono a comuni che hanno cessato la loro validità
 *
 * @param string $task 
 * @param string $args 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_close_incarichi_old_comuni($task, $args, $options)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }
  
  $site_url = sfConfig::get('sf_site_url', 'op_openpolis');
  
  // autenticazione come user admin (id = 1)
  $user = OpUserPeer::retrieveByPK(1);
  sfContext::getInstance()->getUser()->signIn($user);
  
  $run_dry = array_key_exists('dry-run', $options);
  
  $closing_date = date('Y-m-d');
  if (array_key_exists('date', $options)) {
    $closing_date = $options['date'];
  }

  
  // estrazione incarichi per comuni chiusi
  $c = new Criteria();
  $c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);
  $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
  if (count($args))
    $c->add(OpLocationPeer::ID, $args, Criteria::IN);
  else
    $c->add(OpLocationPeer::DATE_END, null, Criteria::ISNOTNULL);
  $c->add(OpLocationPeer::LOCATION_TYPE_ID, 6);
  $c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
  $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  
  echo "Chiusura incarichi\n";
  $incarichi = OpInstitutionChargePeer::doSelect($c);
  foreach($incarichi as $incarico)
  {
    echo $incarico->getOpPolitician() . " - " . $incarico->getOpLocation()->getName() . " (" .$incarico->getContentId().")";
    if (!$run_dry)
    {
      $incarico->setDateEnd($closing_date);
      $incarico->save();
      echo " -> incarico chiuso ($closing_date)";
    } else {
      echo " -> incarico da chiudere ($closing_date)";
    }
    echo "\n";
  }
  
}

/**
 * verifica i politici doppioni e li elimina (dopo aver trasferito gli incarichi)
 * si considera valido l'ID vecchio
 *
 * @param string $task 
 * @param array $args 
 * @param array $options 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_politico_cellho($task, $args, $options)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    define('SF_ROOT_DIR', sfConfig::get('sf_root_dir'));
    define('SF_APP', 'fe');
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
  
  $site_url = sfConfig::get('sf_site_url', 'op_openpolis');
  
  // autenticazione come user admin (id = 1)
  $user = OpUserPeer::retrieveByPK(1);
  sfContext::getInstance()->getUser()->signIn($user);
  
  $run_dry = array_key_exists('dry-run', $options);
  
  // estrazione politici doppioni
  echo "Estrazione elenco politici doppi ...";
  $double_pols = OpPoliticianPeer::getDoublePoliticians();
  
  echo "\n";
  foreach($double_pols as $politician)
  {
    printf("%s %s - %s (%d)\n", $politician['first_name'], $politician['last_name'], 
                              date('d/m/Y', strtotime($politician['birth_date'])), $politician['n']);
                              
    # skip il caso dei molti dovuti alla data di nascita null
    if ($politician['n'] > 10) continue;
    
    # determina i content_id del politico
    $pol_records = OpPoliticianPeer::retrieveAllByAnagrafica($politician['first_name'], $politician['last_name'], $politician['birth_date']);
    
    $original_politician = $pol_records[0];
    $original_politician_id = $original_politician->getContentId();
    
    # verifica e trasferisci o rimuovi tutte le *dipendenze*
    foreach ($pol_records as $cnt => $rec) {
      printf( " %d: %d\n", $cnt, $rec->getContentId());
      
      # incarichi istituzionali
      $inst_charges[$cnt] = $rec->getPublicInstitutionCharges();
      if (count($inst_charges[$cnt]))
        echo "  Incarichi istituzionali\n";
                
      foreach($inst_charges[$cnt] as $c)
      {
        printf("   %d: %s, %s, %s, da %s a %s ", 
                $c->getContentId(), 
                $c->getOpChargeType() ? $c->getOpChargeType()->getName() : 'ns', 
                $c->getOpInstitution() ? $c->getOpInstitution()->getName() : 'ns',
                $c->getOpLocation() ? $c->getOpLocation()->getName() : 'ns',
                $c->getDateStart('d/m/Y'),
                $c->getDateEnd('d/m/Y') ? $c->getDateEnd('d/m/Y') : ' in attività'
                );
        
        # controlla che l'incarico sia valido (tutti i dati necessari ci sono)
        $is_valid = true;
        if (!$c->getOpLocation() || !$c->getOpChargeType() || !$c->getOpInstitution())
          $is_valid = false;
        
        # verifica esistenza in record originale, trasferimento o rimozione
        if ($cnt > 0)
          checkTransferOrRemove('OpInstitutionCharge', $inst_charges[0], $c, $original_politician_id, $is_valid, $run_dry);
        else 
          printf("\n");        
        

      }
      
      
      # incarichi politici
      $pol_charges[$cnt] = $rec->getPublicPoliticalCharges();
      if (count($pol_charges[$cnt]))
        echo "  Incarichi politici\n";
        
      foreach($pol_charges[$cnt] as $c)
      {
        printf("   %d: %s, %s, %s, da %s a %s ", 
                $c->getContentId(), 
                $c->getOpChargeType() ? $c->getOpChargeType()->getName() : 'ns', 
                $c->getOpLocation() ? $c->getOpLocation()->getName() : 'ns',
                $c->getOpParty() ? $c->getOpParty()->getName() : 'ns',
                $c->getDateStart('d/m/Y'),
                $c->getDateEnd('d/m/Y') ? $c->getDateEnd('d/m/Y') : ' in attività'
                );
        
        # controlla che l'incarico sia valido (tutti i dati necessari ci sono)
        $is_valid = true;
        if (!$c->getOpLocation() || !$c->getOpChargeType() || !$c->getOpParty())
          $is_valid = false;
        

        # verifica esistenza in record originale, trasferimento o rimozione
        if ($cnt > 0)
          checkTransferOrRemove('OpPoliticalCharge', $pol_charges[0], $c, $original_politician_id, $is_valid, $run_dry);
        else 
          printf("\n");        



      }
      

      # incarichi organizzativi
      $org_charges[$cnt] = $rec->getPublicOrganizationCharges();
      if (count($org_charges[$cnt]))
        echo "  Incarichi organizzativi\n";
        
      foreach($org_charges[$cnt] as $c)
      {
        printf("   %d: %s, %s, da %s a %s ", 
                $c->getContentId(), 
                $c->getOpOrganization() ? $c->getOpOrganization()->getName() : 'ns', 
                $c->getChargeName() ? $c->getChargeName() : 'ns',
                $c->getDateStart('d/m/Y'),
                $c->getDateEnd('d/m/Y') ? $c->getDateEnd('d/m/Y') : ' in attività'
                );
        
        # controlla che l'incarico sia valido (tutti i dati necessari ci sono)
        $is_valid = true;
        if (!$c->getOpOrganization() || !$c->getChargeName()) {
          $is_valid = false;
        }

        # verifica esistenza in record originale, trasferimento o rimozione
        if ($cnt > 0)
        {
          checkTransferOrRemove('OpOrganizationCharge', $org_charges[0], $c, $original_politician_id, $is_valid, $run_dry);
        } else 
          printf("\n");        

      }
      
      
      # risorse
      $resources[$cnt] = $rec->getPublicResources();
      if (count($resources[$cnt]))
        echo "  Risorse\n";
      foreach($resources[$cnt] as $r)
      {
        printf("   %d: %s, %s", 
                $r->getContentId(), 
                $r->getOpResourcesType() ? $r->getOpResourcesType()->getResourceType() : 'ns', 
                $r->getValore() ? $r->getValore() : 'ns'
                );
        
        # controlla che l'incarico sia valido (tutti i dati necessari ci sono)
        $is_valid = true;
        if (!$r->getOpResourcesType() || !$r->getValore()) {
          $is_valid = false;
        }

        # verifica esistenza in record originale, trasferimento o rimozione
        if ($cnt > 0)
        {
          checkTransferOrRemove('OpResources', $resources[0], $r, $original_politician_id, $is_valid, $run_dry);
        } else 
          printf("\n");        

      }

      
      # dichiarazioni
      $declarations[$cnt] = $rec->getOpDeclarations();
      if (count($declarations[$cnt]))
        echo "  Dichiarazioni\n";
      foreach($declarations[$cnt] as $r)
      {
        printf("   %d: %s - %s (%s, %s)", 
                $r->getContentId(),
                $r->getDate('d/m/Y'),
                $r->getTitle(),
                $r->getSourceName(),
                $r->getSourceUrl()
                );
        
        # controlla che l'incarico sia valido (tutti i dati necessari ci sono)
        $is_valid = true;
        if (!$r->getDate() || !$r->getTitle() || !$r->getSourceName() || !$r->getSourceUrl()) {
          $is_valid = false;
        }
        
        # verifica esistenza in record originale, trasferimento o rimozione
        if ($cnt > 0)
        {
          checkTransferOrRemove('OpDeclaration', $declarations[0], $r, $original_politician_id, $is_valid, $run_dry);
        } else 
          printf("\n");        

      }
     
      # adozioni
      $adoptions[$cnt] = $rec->getOpPolAdoptions();
      if (count($adoptions[$cnt]))
        echo "  Adozioni\n";
      foreach($adoptions[$cnt] as $r)
      {
        printf("   %s", 
                $r->getOpUser() ? $r->getOpUser() : 'ns'
                );
        
        # verifica esistenza in record originale, trasferimento o rimozione
        # controlla che l'incarico sia valido (tutti i dati necessari ci sono)
        $is_valid = true;
        if (!$r->getOpUser()) {
          $is_valid = false;
        }
        
        # verifica esistenza in record originale, trasferimento o rimozione
        if ($cnt > 0)
        {
          checkTransferOrRemove('OpPolAdoption', $adoptions[0], $r, $original_politician_id, $is_valid, $run_dry);
        } else 
          printf("\n");        
      }
 
      
      # rimozione del content
      if ($cnt > 0)
      {
        if (!$run_dry) {
          $rec->delete();
          printf("  record rimosso\n");
        } else {
          printf("  record da rimuovere\n");        
        }
      }

    }
    unset($inst_charges);
    
    echo "OK\n\n";
  }
  
}



/**
 * update all users' caches
 * inserted contributions numbers are re-counted and saved, for every users
 * usage: ./symfony op-update-users-cache [--dry-run] 
 *
 * @param string $task 
 * @param string $args 
 * @param string $options 
 * @return void
 * @author Guglielmo Celata
 */
function run_op_update_users_cache($task, $args, $options)
{
  
  static $loaded;

  // load application context
  if (!$loaded)
  {
    _loader();
  }

  $dry_run = array_key_exists('dry-run', $options);

  # loop on all active users
  $users = OpUserPeer::getRegisteredUsers();
  $n_users = count($users);
	
  foreach ($users as $cnt => $user) {
    $msg = sprintf("%d/%d - %s (%d)", $cnt+1, $n_users, $user, $user->getId());
    echo pakeColor::colorize($msg, array('fg' => 'cyan', 'bold' => false));
    
    $n_declarations = $user->countDeclarations();
    $n_resources = $user->countResources();
    $n_charges = $user->countCharges();
    $n_comments = $user->countOpComments();
    $n_pols = $user->countPolInsertions();
    $user->setDeclarations($n_declarations);
    $user->setResources($n_resources);
    $user->setCharges($n_charges);
    $user->setComments($n_comments);
    $user->setPolInsertions($n_pols);
    $msg = sprintf(" - decl: %d, res: %d, ch: %d, com: %d, pol: %d", $n_declarations, $n_resources, $n_charges, $n_comments, $n_pols);
    echo pakeColor::colorize($msg, array('fg' => 'yellow', 'bold' => true));
    if (!$dry_run)
    {
      $user->save();
      $msg = sprintf(" OK ");
      echo pakeColor::colorize($msg, array('fg' => 'green', 'bold' => true));
    }

    echo "\n";
  }
  
}


/**
 * controlla un item dipendente (incarico, risorsa, dichiarazione, adozione)
 * in un record di politico duplicato e decide il trasferimento della dipendenza
 * al politico originale (swap del politician_id) o la semplice rimozione
 * trasferimento, se l'item non esiste già tra quelli originali,
 * rimozione in caso contrario
 *
 * @param string $item_type - modello degli item (OpInstitutionCharge, OpResources, ...)
 * @param array $original_items - dipendenze originali, che rimarranno
 * @param PropelObject $item - la dipendenza che deve essere controllata
 * @param id $original_politician_id - id da mantenere del politico duplicato
 * @param boolean $is_valid - se l'item nuovo ha tutti i dati necessari 
 * @param boolean $run_dry 
 * @return void
 * @author Guglielmo Celata
 */
function checkTransferOrRemove($item_type, $original_items, $item, $original_politician_id, $is_valid, $run_dry)
{
  # controllo se incarico esiste in record precedente
  $has_c = false;
  foreach($original_items as $original_item)
  {
    if (call_user_func_array($item_type.'Peer::compare', array($item, $original_item)))
    {
      $has_c = true;
      break;
    }
  }

  # se necessario (e se non in dry-run)
  # merge dell'incarico nel record precedente
  # attraverso il cambio di politician_id
  # altrimenti, rimozione dell'incarico
  if (!$has_c)
  {
    if (!$is_valid) {
      printf(" Warning! Manca qualche dato. Trasferimento impossibile.\n");
    } else {
      if (!$run_dry)
      {
        $item->setPoliticianId($original_politician_id);
        $item->save();              
        printf(" trasferito al %d\n", $original_politician_id);
      } else {
        printf(" da trasferire al %d\n", $original_politician_id);
      }      
    }
  } else {
    if (!$run_dry)
    {
      $item->delete();
      printf(" rimosso\n");
    } else {
      printf(" da rimuovere\n");
    }
  }

}
