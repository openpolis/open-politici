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
  require_once 'lib/model/om/BaseOpUserPeer.php';
  
  // include object class
  include_once 'lib/model/OpUser.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_user' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpUserPeer extends BaseOpUserPeer {

  public static $activities_filters = array(
    'all' => array('m' => 'Tutti', 'f' => 'Tutte'),
    'insert' => array('m' => 'Inseriti', 'f' => 'Inserite'),
    'update' => array('m' => 'Modificati', 'f' => 'Modificate')    
  );

  public static function registeredUsersCriteria()
  {
    $c = new Criteria();
  	$cnick1 = $c->getNewCriterion(OpUserPeer::NICKNAME, array('admin', 'importer'), Criteria::NOT_IN);
    $cnick2 = $c->getNewCriterion(OpUserPeer::NICKNAME, null, Criteria::ISNULL);
    $cnick1->addOr($cnick2);  
  	$c->add($cnick1);
    $c->add(self::IS_ACTIVE, 1);
    return $c;
  }

  /**
   * ritorna il numero di utenti registrati e attivati
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public static function countRegisteredUsers()
  {
    $c = self::registeredUsersCriteria();
    return self::doCount($c);
  }

  /**
   * torna tutti gli utenti registrati e attivati
   *
   * @return array of OpUser
   * @author Guglielmo Celata
   */
  public static function getRegisteredUsers()
  {
    $c = self::registeredUsersCriteria();
    return self::doSelect($c);
  }
  
  

  /**
   * ritorna il numero di moderatori o amministratori attivati
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public static function countModerators()
  {
    $c = new Criteria();
    $c->add(self::NICKNAME, array("admin", "importer"), Criteria::NOT_IN);
    $c->add(self::IS_ACTIVE, 1);

    $crit0 = $c->getNewCriterion(self::IS_MODERATOR, 1);
    $crit1 = $c->getNewCriterion(self::IS_ADMINISTRATOR, 1);
    $crit0->addOr($crit1);
    $c->add($crit0);    
    
    return self::doCount($c);
  }
  

  /**
   * ritorna il numero di utenti attivi nell'ultimo mese
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public static function countActiveUsersInLastMonth()
  {
    $c = new Criteria();
    $c->add(self::NICKNAME, array("admin", "importer"), Criteria::NOT_IN);
    $c->add(self::LAST_CONTRIBUTION, mktime() - 30*86400, ">=");
    return self::doCount($c);
  }

  /**
   * ritorna le locations con il maggior numero di utenti registrati
   * torna le prime app_statistics_locations_max_users (3), separate da virgola
   *
   * @param string - il tipo di location
   * @return stringa con le locations (e tra parentesi il num. di utenti?)
   * @author Guglielmo Celata
   **/
  public static function getLocationsWithMaxUsers( $location_type )
  {
    $connection = Propel::getConnection();
    

    switch ($location_type)
    {
      case "regione":
        $q_sel_group = "l.regional_id ";
        break;

      case "provincia":
        $q_sel_group = "l.provincial_id ";
        break;
    
      case "comune":
        $q_sel_group = "l.city_id ";
        break;
        
      // in caso di parametro errato, ritorna null
      default:
        return null;
    }
    // costruzione della query complessa per il fetch (count e group by)
    $q = "select count(l.id) as cu, $q_sel_group as id" .
         " from op_user u, op_location l " .  
         " where l.id=u.location_id and u.is_active = 1 and " .
         " (u.nickname not in ('admin', 'importer') or u.nickname is null) " . 
         " group by $q_sel_group " . 
         " order by cu desc limit " . sfConfig::get('app_statistics_locations_max_users') ;
    
    // fetch dei dati e costruzione delle stringhe
    $ids_ar = array();
    $statement = $connection->prepareStatement($q);
    $resultset = $statement->executeQuery();
    $locations = "";
    while ($resultset->next())
    {
      $cu = $resultset->getInt('cu');
      $id = $resultset->getInt('id');

      // fetch location di un tipo, con id relativo (city_id, provincial_id, regional_id)
      $loc = OpLocationPeer::getLocationFromIdAndLocationTypeField($id, $location_type);
      $locations .= $loc->__toString() . "(" . $cu . ")" . ", ";
    }
    
    // chomp ultima virgola
    $locations = substr($locations, 0, -2);

    unset($statement);
    unset($resultset);
    unset($connection);
    
    return $locations;
  }
  

  public static function getUserFromHash($hash)
  {
    $c = new Criteria();
    $c->add(self::SHA1_PASSWORD, $hash);

    return self::doSelectOne($c);
  }


  public static function getUserFromNickname($nickname)
  {
    $c = new Criteria();
    $c->add(self::NICKNAME, $nickname);

    return self::doSelectOne($c);
  }

  public static function getAuthenticatedUser($nickname, $password)
  {
    $user = self::getUserFromNickname($nickname);
	
	  //controllo se l'utente è attivato
	  if($user && $user->getIsActive() == 1)
	  {
		  // nickname exists?
		  if ($user)
		  {
		    // password is OK?
		    if (sha1($user->getSalt().$password) == $user->getSha1Password())
		    {
			    return $user;
		    }
		  }
    }
  
    return null;
  }

  public static function getUserFromEmail($email)
  {
    $c = new Criteria();
    $c->add(self::EMAIL, $email);
    return self::doSelectOne($c);
  }

  public static function getAuthenticatedUserByEmail($email, $password)
  {
    $user = self::getUserFromEmail($email);
	
	  //controllo se l'utente è attivato
	  if($user instanceof OpUser && $user->getIsActive() == 1 && sha1($user->getSalt().$password) == $user->getSha1Password())
	    return $user;
  
    return null;
  }


  public static function getModeratorCandidatesCount()
  {
    $c = new Criteria();
	  $c->add(self::IS_ACTIVE, 1);
    $c->add(self::WANT_TO_BE_MODERATOR, true);

    return self::doCount($c);
  }

  public static function getModeratorCandidates()
  {
    $c = new Criteria();
	  $c->add(self::IS_ACTIVE, 1);
    $c->add(self::WANT_TO_BE_MODERATOR, true);
    $c->addAscendingOrderByColumn(self::CREATED_AT);

    return self::doSelect($c);
  }

  public static function getModerators()
  {
    $c = new Criteria();
    $c->add(self::IS_MODERATOR, true);
    $c->addAscendingOrderByColumn(self::CREATED_AT);

    return self::doSelect($c);
  }

  public static function getAdministrators()
  {
    $c = new Criteria();
    $c->add(self::IS_ADMINISTRATOR, true);
    $c->addAscendingOrderByColumn(self::CREATED_AT);

    return self::doSelect($c);
  }

  public static function getProblematicUsersCount()
  {
    $c = new Criteria();
    $c->add(self::DELETIONS, 0, Criteria::GREATER_THAN);

    return self::doCount($c);
  }

  public static function getProblematicUsers()
  {
    $c = new Criteria();
    $c->add(self::DELETIONS, 0, Criteria::GREATER_THAN);
    $c->addDescendingOrderByColumn(self::DELETIONS);

    return self::doSelect($c);
  }
   
  
} // OpUserPeer
