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

  // include base peer class
  require_once 'lib/model/om/BaseOpPoliticianPeer.php';
  
  // include object class
  include_once 'lib/model/OpPolitician.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_politician' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpPoliticianPeer extends BaseOpPoliticianPeer {

  const NO_RECORD = 0;
  const DUPLICATE_RECORD = -1;


  /**
   * legge l'istanza di un politico, identificato dai suoi dati anagrafici in un record CSV
   * 
   * @param  context - reg, prov, com.XXX
   * @param  csv_rec - il record csv, nel formato del ministero dell'interno
   *
   * @return OpPolitician object, 0 (no record) or -1 (duplicate record)
   * @author Guglielmo Celata
   **/
  public static function retrieveFromCSV($context, $csv_rec, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    $values = OpImportModificationsPeer::getHashFromCSV($context, $csv_rec);
    $first_name = $values['first_name'];
    $last_name = $values['last_name'];
    $birth_date = $values['birth_date'];
    $birth_location = $values['birth_place'];
    
    $c = new Criteria();
    $c->add(self::FIRST_NAME, $first_name);
    $c->add(self::LAST_NAME, $last_name);
    if ($birth_date != '')
      $c->add(self::BIRTH_DATE, $birth_date);
    else
      $c->add(self::BIRTH_DATE, null, Criteria::ISNULL);

    $c->add(self::BIRTH_LOCATION, $birth_location);
      
    $res = self::doSelect($c, $con);
    unset($c);
    
    if (count($res) > 1) return self::DUPLICATE_RECORD;
    if (count($res) == 1) return $res[0];
    
    // tentativo con minint_aka
    else 
    {
      $c = new Criteria();

      if ($birth_date != '')
        $c->add(self::MININT_AKA, "$first_name+$last_name+$birth_date");
      else
        $c->add(self::MININT_AKA, "$first_name+$last_name");
      
      $res = self::doSelect($c, $con);
      unset($c);

      // minint_aka è unique index per questa tabella (1 solo risultato)
      if (count($res) == 1) return $res[0];
      else return self::NO_RECORD;
    }
  }



  /**
   * trasferisci incarichi, dichiarazioni e risorse da un politico a un altro
   *
   * @param OpPolitician      $from
   * @param OpPolitician      $to 
   * @param PropelConnection  $con connection object (transactions)
   * @return void
   * @author Guglielmo Celata
   */
  public static function transferResources($from, $to, $con = null)
  {
    if (is_null($con))
  		$con = Propel::getConnection(self::DATABASE_NAME);

  	self::transfer('OpInstitutionChargePeer', $from, $to, $con);
  	self::transfer('OpPoliticalChargePeer', $from, $to, $con);
  	self::transfer('OpOrganizationChargePeer', $from, $to, $con);
  	self::transfer('OpResourcesPeer', $from, $to, $con);
  	self::transfer('OpDeclarationPeer', $from, $to, $con);
  }
  
  
  /**
   * update di tutte le risorse (incarichi, contatti, dichiarazioni) di un politico ad un altro
   *
   * @param String       $peerClass the class used to form the select and update criteria
   * @param OpPolitician $from 
   * @param OpPolitician $to 
   * @param PropelConnection $con 
   * @return void
   * @author Guglielmo Celata
   */
  public static function transfer($peerClass, $from, $to, $con)
  {
    if (is_null($con))
  		$con = Propel::getConnection(self::DATABASE_NAME);
  		
  	$politician_field = call_user_func("$peerClass::translateFieldName", 
  	                                   'politician_id', 
  	                                   BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);	

    // set the select condition criteria
    $c = new Criteria();
    $c->add($politician_field, $from->getContentId());

    // set the update criteria
    $update = new Criteria();
    $update->add($politician_field, $to->getContentId());

    // finally, do the update
    BasePeer::doUpdate($c, $update, $con);
  }


  public static function getPoliticiansAnagraficaHash($limit = null, $offset = null)
  {
		$con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select content_id, first_name, last_name, birth_date, birth_location from op_politician");
    if (!is_null($limit) && is_null($offset))
      $sql .= sprintf(" limit %d", $limit);

    if (!is_null($limit) && !is_null($offset))
      $sql .= sprintf(" limit %d,%d", $offset, $limit);
      
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
    
    $hashes = array();
    while ($rs->next())
    {
      $row = $rs->getRow();
      $hashes []= $row;
    }
    
    return $hashes;
  }

  /**
   * torna le istanze di politici simili a quella data per l'anagrafica
   * la similarità è di diverso tipo
   *
   * *, cognome, data
   * nome, *, data
   * nome, cognome, *
   * 
   * @param  first_name - string
   * @param  last_name - string
   * @param  birth_date - date (YYYY/MM/DD)
   * @param  birth_location - location_name (prov) [not needed]
   *
   * @return array of OpPolitician
   * @author Guglielmo Celata
   **/
  public static function getSimilarPoliticians($first_name, $last_name, $birth_date, $birth_location = null, $id = null, $con = null)
  { 
    $aggregated_result = array();

    # identity is a form of similarity!
    # it is only checked if the id of the original politician is passed
    if (!is_null($id)) {
      $c = new Criteria();
      $c->add(self::CONTENT_ID, $id, Criteria::NOT_EQUAL);
      $c->add(self::FIRST_NAME, $first_name);
      $c->add(self::LAST_NAME, $last_name);
      $c->add(self::BIRTH_DATE, $birth_date);
      if (!is_null($birth_location))
        $c->add(self::BIRTH_LOCATION, $birth_location);
      $res = self::doSelect($c, $con);
      if (count($res)) $aggregated_result = array_merge($aggregated_result, $res);
      unset($c);
    }
    
    if ($birth_date != '')
    {

      $c = new Criteria();
      $c->add(self::FIRST_NAME, $first_name, Criteria::NOT_EQUAL);
      $c->add(self::LAST_NAME, $last_name);
      $c->add(self::BIRTH_DATE, $birth_date);
      if (!is_null($birth_location))
        $c->add(self::BIRTH_LOCATION, $birth_location);
      $res = self::doSelect($c, $con);
      if (count($res)) $aggregated_result = array_merge($aggregated_result, $res);
      unset($c);

      $c = new Criteria();
      $c->add(self::FIRST_NAME, $first_name);
      $c->add(self::LAST_NAME, $last_name, Criteria::NOT_EQUAL);
      $c->add(self::BIRTH_DATE, $birth_date);
      if (!is_null($birth_location))
        $c->add(self::BIRTH_LOCATION, $birth_location);
      $res = self::doSelect($c, $con);
      if (count($res)) $aggregated_result = array_merge($aggregated_result, $res);
      unset($c);

      $c = new Criteria();
      $c->add(self::FIRST_NAME, $first_name);
      $c->add(self::LAST_NAME, $last_name);
      $c->add(self::BIRTH_DATE, $birth_date, Criteria::NOT_EQUAL);
      if (!is_null($birth_location))
        $c->add(self::BIRTH_LOCATION, $birth_location);
      $res = self::doSelect($c, $con);
      if (count($res)) $aggregated_result = array_merge($aggregated_result, $res);
      unset($c);

      if (!is_null($birth_location) && $birth_location != '')
      {
        $c = new Criteria();
        $c->add(self::FIRST_NAME, $first_name);
        $c->add(self::LAST_NAME, $last_name);
        $c->add(self::BIRTH_DATE, $birth_date);
        $c->add(self::BIRTH_LOCATION, $birth_location, Criteria::NOT_EQUAL);
        $res = self::doSelect($c, $con);
        if (count($res)) $aggregated_result = array_merge($aggregated_result, $res);
        unset($c);        
      }
      
      
    } else {
      
      $c = new Criteria();
      $c->add(self::LAST_NAME, $last_name);
      $c->add(self::BIRTH_DATE, null, Criteria::ISNOTNULL);
      if (!is_null($birth_location)  && $birth_location != '')
        $c->add(self::BIRTH_LOCATION, $birth_location);
      $res = self::doSelect($c, $con);
      if (count($res)) $aggregated_result = array_merge($aggregated_result, $res);
      unset($c);
      
    }


    return $aggregated_result;
  }
  

  /**
   * torna l'elenco dei politici doppi in op_politician
   *
   * @return array di hash
   *         first_name, last_name, birth_date, n
   * @author Guglielmo Celata
   */
  public static function getDoublePoliticians()
  {
		$con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select first_name, last_name, birth_date, count(content_id) as n from op_politician group by lower(convert(concat(first_name, last_name, birth_date) using latin1)) having n>1");
    $stm = $con->createStatement(); 
    return $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);    
  }
  


  /**
   * legge l'istanza di un politico, identificato dai suoi dati anagrafici
   * non controlla il campo minint_aka
   *
   * @param  first_name - string
   * @param  last_name - string
   * @param  birth_date - date (YYYY/MM/DD)
   * @param  birth_location - city (PR)
   *
   * @return OpPolitician object, 0 (no record) or -1 (duplicate record)
   * @author Guglielmo Celata
   **/
  public static function retrieveByAnagraficaWithBirthLocation($first_name, $last_name, $birth_date, $birth_location, $con = null)
  {
    if (is_null($con))
      $con = Propel::getConnection(self::DATABASE_NAME);
		
    $c = new Criteria();
    $c->add(self::FIRST_NAME, $first_name);
    $c->add(self::LAST_NAME, $last_name);
    if ($birth_date != '')
      $c->add(self::BIRTH_DATE, $birth_date);
    else
      $c->add(self::BIRTH_DATE, null, Criteria::ISNULL);
    if ($birth_date != '')
      $c->add(self::BIRTH_LOCATION, $birth_location);
    else
      $c->add(self::BIRTH_LOCATION, null, Criteria::ISNULL);
      
    $res = self::doSelect($c, $con);
    unset($c);
    
    if (count($res) > 1) return self::DUPLICATE_RECORD;
    if (count($res) == 1) return $res[0];
    else return self::NO_RECORD;
  }

  /**
   * minint_aka is a unique index, so only one record exist for a given minint_aka string
   *
   * @param string $minint_aka 
   * @return OpPolitician object
   * @author Guglielmo Celata
   */
  public static function retrieveByMinintAka($minint_aka, $con = null)
  {
    if (is_null($con))
      $con = Propel::getConnection(self::DATABASE_NAME);
    
    $c = new Criteria();
    $c->add(self::MININT_AKA, $minint_aka);
    return self::doSelectOne($c, $con);
  }

  /**
   * legge l'istanza di un politico, identificato dai suoi dati anagrafici
   * controlla anche il campo minint_aka
   *
   * @param  first_name - string
   * @param  last_name - string
   * @param  birth_date - date (YYYY/MM/DD)
   * @param  use_minint_aka - check minint_aka
   *
   * @return OpPolitician object, 0 (no record) or -1 (duplicate record)
   * @author Guglielmo Celata
   **/
  public static function retrieveByAnagrafica($first_name, $last_name, $birth_date, $use_minint_aka = true, $con = null)
  {
    if (is_null($con))
      $con = Propel::getConnection(self::DATABASE_NAME);
    
    $c = new Criteria();
    $c->add(self::FIRST_NAME, $first_name);
    $c->add(self::LAST_NAME, $last_name);
    if ($birth_date != '')
      $c->add(self::BIRTH_DATE, $birth_date);
    else
      $c->add(self::BIRTH_DATE, null, Criteria::ISNULL);
      
    $res = self::doSelect($c, $con);
    unset($c);
    
    if (count($res) > 1) return self::DUPLICATE_RECORD;
    if (count($res) == 1) 
      return $res[0];    
    else 
    {
      if ($use_minint_aka) {
        // tentativo con minint_aka
        $c = new Criteria();

        if ($birth_date != '')
          $c->add(self::MININT_AKA, "$first_name+$last_name+$birth_date");
        else
          $c->add(self::MININT_AKA, "$first_name+$last_name");

        $res = self::doSelect($c, $con);
        unset($c);

        // minint_aka è unique index per questa tabella (1 solo risultato)
        if (count($res) == 1) return $res[0];
        else return self::NO_RECORD;
      } else {
        return self::NO_RECORD;
      }
    }
  }
  
  /**
   * legge l'istanza di un politico, identificato dai suoi dati anagrafici
   * controlla anche il campo minint_aka
   *
   * @param  first_name - string
   * @param  last_name - string
   * @param  birth_date - date (YYYY/MM/DD)
   *
   * @return array of OpPolitician objects
   * @author Guglielmo Celata
   **/
  public static function retrieveAllByAnagrafica($first_name, $last_name, $birth_date, $con = null)
  {
    $c = new Criteria();
    $c->add(self::FIRST_NAME, $first_name);
    $c->add(self::LAST_NAME, $last_name);
    if ($birth_date != '')
      $c->add(self::BIRTH_DATE, $birth_date);
    else
      $c->add(self::BIRTH_DATE, null, Criteria::ISNULL);
    $c->addAscendingOrderByColumn(self::CONTENT_ID);
    $res = self::doSelect($c, $con);
    unset($c);
    
    if (is_array($res)) return $res;
    // tentativo con minint_aka
    else 
    {
      $c = new Criteria();
      if ($birth_date != '')
        $c->add(self::MININT_AKA, urlencode("$first_name $last_name $birth_date"));
      else
        $c->add(self::MININT_AKA, urlencode("$first_name $last_name"));

      $res = self::doSelect($c, $con);
      unset($c);

      // minint_aka è unique index per questa tabella (1 solo risultato)
      if (count($res) == 1) return $res;
      else return self::NO_RECORD;
    }
  }
  
  
  
  /**
   * retrieve one of the OpImportModificationsPeer action types
   * starting from anagraphical data
   *
   * @param hash $v anagraphical data (first_name, last_name, birth_date)
   * @return hash (politician, action_type)
   * @author Guglielmo Celata
   */
  public static function computePoliticianAndActionTypeFromAnagraphicalData($v)
  {
    if ($p = OpPoliticianPeer::retrieveByAnagrafica($v['first_name'], $v['last_name'], $v['birth_date'], false))
    {
      // if one or more politician found
      if ($p instanceof OpPolitician)
      {
        // ONE politician found in the database
        // institution charge record could be inserted, if no overlapping charges are found (I)
        $action_type = OpImportModificationsPeer::CHARGE_ONLY;
      } else {
        $action_type =  OpImportModificationsPeer::DUPLICATE_POLITICIAN;
      }
    } else {
      // not directly found, check again, using minint_aka
      
      // define minint_aka string, based on values extracted from csv
      $minint_aka = sprintf("%s+%s", $v['first_name'], $v['last_name']);
      if ($v['birth_date'] != '')
        $minint_aka .= "+" . date('Y/m/d', strtotime($v['birth_date']));

      if ($p = OpPoliticianPeer::retrieveByMinintAka($minint_aka)) {
        // politician found in the database, using minint_aka
        // institution charge record could be inserted, if no overlapping charges are found (IA)
        $action_type =  OpImportModificationsPeer::CHARGE_BY_MININT_AKA;
      } else {
        // check if similar politicians exist
        $ps = OpPoliticianPeer::getSimilarPoliticians($v['first_name'], $v['last_name'], $v['birth_date']);
        if ($n_sim = count($ps)) {
          // at least one politician 'similar' to the one given by the csv record is found
          // mark this record with S and require action from the operator (S<N>) 
          // N is the number of similar politicians found
          // the record is virtually blocked
          $action_type = sprintf("%s%d", OpImportModificationsPeer::HAS_SIMILAR_POLITICIANS, $n_sim);
        } else {
          // no politician is found
          // both politician and charge records will be created anew (PI)
          $action_type = OpImportModificationsPeer::POLITICIAN_AND_CHARGE;
        }
      }
    }
    
    return array('politician' => $p, 'action_type' => $action_type);
  }

  public static function addFromCSV($context, $csv_rec, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    $values = OpImportModificationsPeer::getHashFromCSV($context, $csv_rec);
    
    # skip insertion if politician exists at this point (double check needed to avoid duplications in import)
    $p = OpPoliticianPeer::retrieveByAnagrafica($values['first_name'], $values['last_name'], $values['birth_date'], false);
    if (!$p instanceOf OpPolitician) {
      $p = self::addFromImport($values['first_name'], $values['last_name'], 
                               $values['birth_date'], $values['sex'], $values['birth_place'],
                               $values['education'], "", $values['profession'], $con);
    }
    return $p;
  }

  /**
   * aggiunge un'istanza di un politico, a partire dai dati di import
   * l'operazione verifica e aggiunge, in modo transazionale,
   * le informazioni su education_level e profession
   *
   * @param  first_name - string
   * @param  last_name - string
   * @param  birth_date - date
   * @param  sex - string
   * @param  birth_place - string
   * @param  education_level - string (lookup in op_education_level)
   * @param  profession - string (lookup in op_profession)
   *
   * @return the OpPolitician object just inserted
   * @author Guglielmo Celata
   **/
  public static function addFromImport($first_name, $last_name, $birth_date, $sex, $birth_place, 
                                       $education_level, $descr_education_level, $profession, $con = null)
  {
    if ($con === null) 
      $con = Propel::getConnection(self::DATABASE_NAME);

    /*
    $logger = sfContext::getInstance()->getLogger();
    $logger->info("{debug} calling OpPoliticianPeer::addFromImport");
    $logger->info("{debug}  first_name: $first_name");
    $logger->info("{debug}  last_name: $last_name");
    $logger->info("{debug}  birth_date: $birth_date");
    $logger->info("{debug}  sex: $sex");
    $logger->info("{debug}  birth_place: $birth_place");
    $logger->info("{debug}  education_level: $education_level");
    $logger->info("{debug}  descr_education_level: $descr_education_level");
    $logger->info("{debug}  profession: $profession");
    return null;
    */
    
    try {
      $p = new OpPolitician();
      $p->setFirstName($first_name);
      $p->setLastName($last_name);
      if ($birth_date != '')
        $p->setBirthDate($birth_date);
      $p->setSex($sex);
      $p->setBirthLocation($birth_place);
      $p->save($con);

      #education level
      $c = new Criteria();
      $c->add(OpEducationLevelPeer::DESCRIPTION, $education_level);
      $ed_lev = OpEducationLevelPeer::doSelectOne($c);
      if (!$ed_lev instanceof OpEducationLevel)
      {
        $ed_lev = new OpEducationLevel();
        $ed_lev->setDescription($education_level);
        $ed_lev->save($con);
      }

      $p_e = new OpPoliticianHasOpEducationLevel();
      $p_e->setOpPolitician($p);
      $p_e->setOpEducationLevel($ed_lev);
      if ($descr_education_level != "" && strtolower($descr_education_level) != strtolower($education_level))
        $p_e->setDescription(ucfirst($descr_education_level));
      $p_e->save($con);
      unset($c);
      
      # profession      
      $c = new Criteria();
      $c->add(OpProfessionPeer::DESCRIPTION, $profession);
      $pro = OpProfessionPeer::doSelectOne($c);
      if (!$pro instanceof OpProfession)
      {
        $pro = new OpProfession();
        $pro->setDescription($profession);
        $pro->save($con);
      }

      # normalizzazione della professione
      # (se esiste un campo oid, il record della professione è quello)
      if ($pro->getOid() !== null && $pro->getOid() != 0)
        $pro = OpProfessionPeer::retrieveByPK($pro->getOid(), $con);        

      $p->setOpProfession($pro);
      // il salvataggio è fatto passando la is_indexing a true
      // per bloccare l'indicizzazione
      $p->save(true, $con);

      $con->commit();
      
      unset($c); unset($ed_lev); unset($p_e); unset($pro);
      
      return $p;

    } catch (PropelException $e) {

      $con->rollback();
      unset($p); unset($c); unset($ed_lev); unset($p_e);
      print "\t errore in OpPoliticianPeer::addFromImport - " . $e->getMessage() . "\n";
      return null;
      
    }
    
    
  }
  
  public static function doSelectJoinOpInstitutionCharge(Criteria $c, $con = null)
  {
    $c = clone $c;
	
    // Set the correct dbName if it has not been overridden
    if ($c->getDbName() == Propel::getDefaultDB())
      $c->setDbName(self::DATABASE_NAME);
		
    // Add select columns for OpPolitician
    OpPoliticianPeer::addSelectColumns($c);
    $startcol2 = (OpPoliticianPeer::NUM_COLUMNS - OpPoliticianPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
	
    // Add select columns for OpInstitutionCharge
    OpInstitutionChargePeer::addSelectColumns($c);

    // Join methods (uso il criterio left_join so voglio il risultato anche se il campo join è vuoto
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next())
    {
      // Hydrate the OpPolitician object
      $omClass = OpPoliticianPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);

      // Hydrate the OpInstitutionCharge object
      $omClass = OpInstitutionChargePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol2);

      // [NOTE 2]
      //$obj1->setOpInstitutionCharge($obj2);
      $results[] = $obj1;
    }
    return $results;
  }

  public static function getPopulars($max = 30, $period = 'all')
  {
    $politicians = array();
    $con = Propel::getConnection();
    $query = 'SELECT COUNT('.OpPoliticianPeer::LAST_NAME.') AS cont,
	         '.OpDeclarationPeer::DATE.' AS date,
             '.OpPoliticianPeer::CONTENT_ID.' AS id, 
			 '.OpPoliticianPeer::SLUG.' AS slug, 
             '.OpPoliticianPeer::LAST_NAME.' AS name,
             '.OpOpenContentPeer::USER_ID.' AS user FROM 
			 '.OpDeclarationPeer::TABLE_NAME.' LEFT JOIN
             '.OpPoliticianPeer::TABLE_NAME.' ON
             '.OpPoliticianPeer::CONTENT_ID.'=
             '.OpDeclarationPeer::POLITICIAN_ID.' INNER JOIN
             '.OpOpenContentPeer::TABLE_NAME.' ON
             '.OpOpenContentPeer::CONTENT_ID.'=
             '.OpDeclarationPeer::CONTENT_ID.' WHERE 
			 '.OpOpenContentPeer::DELETED_AT.' IS NULL ';
    if ($period!='all')
      $query.=' AND '.OpDeclarationPeer::DATE.'>\''.$period.'\'';

    $query.= ' GROUP BY '.OpPoliticianPeer::LAST_NAME.
	         ' ORDER BY cont DESC';

    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;

    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $politicians[$rs->getString('name').'_'.$rs->getInt('id').'-'.$rs->getInt('cont').'*'.$rs->getString('date').'|'. $rs->getString('slug')] = floor(($rs->getInt('cont') / $max_popularity * 3) + 1);    
	}

    ksort($politicians);
    return $politicians;
  }

  public static function getPopularsForInstitution($institution_id, $max = 20, $period = 'all')
  {
    $politicians = array();
    $con = Propel::getConnection();
    $query = 'SELECT COUNT(DISTINCT ('.OpDeclarationPeer::CONTENT_ID.')) AS cont,
             '.OpDeclarationPeer::DATE.' AS date,  
			 '.OpPoliticianPeer::CONTENT_ID.' AS id, 
             '.OpPoliticianPeer::LAST_NAME.' AS name,
             '.OpOpenContentPeer::USER_ID.' AS user FROM 
             '.OpDeclarationPeer::TABLE_NAME.' LEFT JOIN
             '.OpPoliticianPeer::TABLE_NAME.' ON
             '.OpPoliticianPeer::CONTENT_ID.'=
             '.OpDeclarationPeer::POLITICIAN_ID.' LEFT JOIN
             '.OpOpenContentPeer::TABLE_NAME.' ON
             '.OpOpenContentPeer::CONTENT_ID.'=
             '.OpDeclarationPeer::CONTENT_ID.' LEFT JOIN 
             '.OpInstitutionChargePeer::TABLE_NAME.' ON
             '.OpInstitutionChargePeer::POLITICIAN_ID.'=
             '.OpPoliticianPeer::CONTENT_ID.' INNER JOIN 
			 '.OpOpenContentPeer::TABLE_NAME.' AS institutionContent ON institutionContent.CONTENT_ID =
			 '.OpInstitutionChargePeer::CONTENT_ID.
			 ' WHERE institutionContent.DELETED_AT IS NULL AND
             '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id.
             ' AND '.OpInstitutionChargePeer::DATE_END.' IS NULL '.
             ' AND '.OpOpenContentPeer::DELETED_AT.' IS NULL ';
    if ($period!='all')
      $query.=' AND '.OpDeclarationPeer::DATE.'>\''.$period.'\'';

    $query.= ' GROUP BY '.OpPoliticianPeer::LAST_NAME.
             ' ORDER BY cont DESC';

    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;

    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $politicians[$rs->getString('name').'_'.$rs->getInt('id').'§'.$rs->getInt('cont').'*'.$rs->getString('date')] = floor(($rs->getInt('cont') / $max_popularity * sfConfig::get('app_tag_popularity_degrees')) + 1);
    }

    ksort($politicians);
    return $politicians;
  }

  public static function getPopularsForLocation($location_id, $max = 20, $period = 'all')
  {
    $politicians = array();
    $con = Propel::getConnection();
    $query = 'SELECT COUNT(DISTINCT ('.OpDeclarationPeer::CONTENT_ID.')) AS cont,
	         '.OpDeclarationPeer::DATE.' AS date, 
             '.OpPoliticianPeer::CONTENT_ID.' AS id, 
             '.OpPoliticianPeer::LAST_NAME.' AS name FROM 
             '.OpDeclarationPeer::TABLE_NAME.' LEFT JOIN
             '.OpPoliticianPeer::TABLE_NAME.' ON
             '.OpPoliticianPeer::CONTENT_ID.'=
             '.OpDeclarationPeer::POLITICIAN_ID.' LEFT JOIN
             '.OpOpenContentPeer::TABLE_NAME.' ON
             '.OpOpenContentPeer::CONTENT_ID.'=
             '.OpDeclarationPeer::CONTENT_ID.' LEFT JOIN
             '.OpInstitutionChargePeer::TABLE_NAME.' ON
             '.OpInstitutionChargePeer::POLITICIAN_ID.'=
             '.OpDeclarationPeer::POLITICIAN_ID.' INNER JOIN 
			 '.OpOpenContentPeer::TABLE_NAME.' AS institutionContent ON institutionContent.CONTENT_ID =
			 '.OpInstitutionChargePeer::CONTENT_ID.
			 ' WHERE institutionContent.DELETED_AT IS NULL AND
			 '.OpOpenContentPeer::DELETED_AT.
             ' IS NULL AND '.OpInstitutionChargePeer::DATE_END.
             ' IS NULL AND '.OpInstitutionChargePeer::LOCATION_ID.
             '=	'.$location_id;

    if ($period!='all')
      $query.=' AND '.OpDeclarationPeer::DATE.'>\''.$period.'\'';
	  			 
    $query.=' GROUP BY '.OpPoliticianPeer::LAST_NAME.
            ' ORDER BY cont DESC';

    $stmt = $con->prepareStatement($query);
    $stmt->setLimit($max);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;

    while ($rs->next())
    {
       if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');
    	
      $politicians[$rs->getString('name').'_'.$rs->getInt('id').'§'.$rs->getInt('cont').'*'.$rs->getString('date')] = floor(($rs->getInt('cont') / $max_popularity * sfConfig::get('app_tag_popularity_degrees')) + 1);
    }
    ksort($politicians);
    return $politicians;
  }
  
  public static function doSelectForTag($tag_id, $period = 'all')
  {
    $politicians = array();
    $con = Propel::getConnection();
    $query = 'SELECT '.OpPoliticianPeer::LAST_NAME.
	         ' AS name, '.OpPoliticianPeer::CONTENT_ID.' as id, COUNT('.OpPoliticianPeer::LAST_NAME.
			 ') AS cont, '.OpDeclarationPeer::DATE.
			 ' AS date FROM '.OpPoliticianPeer::TABLE_NAME.
             ' LEFT JOIN '.OpDeclarationPeer::TABLE_NAME.
             ' ON '.OpDeclarationPeer::POLITICIAN_ID.'='.OpPoliticianPeer::CONTENT_ID.
             ' LEFT JOIN '.OpTagHasOpOpinableContentPeer::TABLE_NAME.
             ' ON '.OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID.'='.OpDeclarationPeer::CONTENT_ID.
             ' WHERE '.OpTagHasOpOpinableContentPeer::TAG_ID.'='.$tag_id;
    if ($period!='all')
      $query.=' AND '.OpDeclarationPeer::DATE.' >\''.$period.'\'';			 

    $query.= ' GROUP BY '.OpPoliticianPeer::LAST_NAME.
             ' ORDER BY cont DESC';
 
    $stmt = $con->prepareStatement($query);
    $rs = $stmt->executeQuery();
    $max_popularity = 0;
	$politicians[0] = '-- tutti i politici --';
    while ($rs->next())
    {
      if (!$max_popularity)
        $max_popularity = $rs->getInt('cont');

      $politicians[$rs->getInt('id')] = $rs->getString('name');
    }
    ksort($politicians);
    return $politicians;
  }	
  
  /**
   * torna i candidati per VSQ
   * un candidato vsq è un politico che ha un incarico di tipo CandidatoPolitiche2008
   *
   * @param integer $assegnati - 1 tutti, 0 solo quelli non assegnati a coalizioni elettorali
   * @return array di OpPolitician
   * @author Guglielmo Celata
   **/
  public static function getVsqCandidates($assegnati = 1)
  {
    $c = self::_build_vsqCandidates_criteria($assegnati);
    return self::doSelect($c);        
  }

  /**
   * torna il numero di candidati per VSQ
   * un candidato vsq è un politico che ha un incarico di tipo CandidatoPolitiche2008
   *
   * @param integer $assegnati - 1 tutti, 0 solo quelli non assegnati a coalizioni elettorali
   * @return integer
   * @author Guglielmo Celata
   **/
  public static function countVsqCandidates($assegnati = 1)
  {
    $c = self::_build_vsqCandidates_criteria($assegnati);
    return self::doCount($c);        
  }

  /**
   * usata per le select e il count del numero di candidati
   *
   * @param integer $assegnati - 1 tutti, 0 solo quelli non assegnati a coalizioni elettorali
   * @return void
   * @author Guglielmo Celata
   **/
  private static function _build_vsqCandidates_criteria($assegnati)
  {
    // estrai i politici che hanno dichiarazioni associate
    $c = new Criteria();
    $c->addJoin(self::CONTENT_ID, OpDeclarationPeer::POLITICIAN_ID);
    $c->addJoin(OpDeclarationPeer::CONTENT_ID, OpThemeHasDeclarationPeer::DECLARATION_ID);
    
    // selezione politici non assegnati
    if ($assegnati == 0)
    {
      // prima sono selezionati quelli assegnati
      $charge_type = OpChargeTypePeer::retrieveByShortName('CandidatoPolitiche2008');
      $ca = new Criteria();
      $ca->addJoin(self::CONTENT_ID, OpPoliticalChargePeer::POLITICIAN_ID);
      $ca->addJoin(OpPoliticalChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
      $ca->add(OpChargeTypePeer::ID, $charge_type->getId());
      $assigned_politicians = self::doSelect($ca);
      $assigned_politicians_ids = array();
      foreach ($assigned_politicians as $ap)
        $assigned_politicians_ids []= $ap->getContentId();

      // ora si aggiunge un criterio NOT_IN
      $c->add(self::CONTENT_ID, $assigned_politicians_ids, Criteria::NOT_IN);
    }
    
    $c->addDescendingOrderByColumn(OpThemeHasDeclarationPeer::CREATED_AT);    
    $c->setDistinct();
    return $c;
  }
  
	
} // OpPoliticianPeer
?>
