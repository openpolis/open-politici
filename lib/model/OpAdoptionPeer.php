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


class OpAdoptionPeer {
  
  /**
   * funzione di comparazione che confronta i tempi di richiesta
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public static function req_compare($a,$b)
  {
    $req_a = $a->getRequestedAt();
    $req_b = $b->getRequestedAt();
    
    if ($req_a == $req_b ||
        $req_a == NULL && $req_b == NULL)
        return 0;
    if ($req_a == NULL && $req_b !== NULL) return -1;
    if ($req_a !== NULL && $req_b == NULL) return 1;

    return $req_a > $req_b ? -1 : 1;
    
  }

  /**
   * funzione di comparazione che confronta i tempi di grant
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public static function gra_compare($a,$b)
  {
    $gra_a = $a->getGrantedAt();
    $gra_b = $b->getGrantedAt();
    
    if ($gra_a == $gra_b ||
        $gra_a == NULL && $gra_b == NULL)
        return 0;
    if ($gra_a == NULL && $gra_b !== NULL) return -1;
    if ($gra_a !== NULL && $gra_b == NULL) return 1;

    return $gra_a > $gra_b ? -1 : 1;
    
  }


  /**
   * ritorna la lista di tutte le richieste nelle tabelle op_pol_adoption e op_loc_adoption
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public static function getRequests($con = NULL)
  {
		if ($con === null) {
			$con = Propel::getConnection(OpPolAdoptionPeer::DATABASE_NAME);
		}
		$pol_c = new Criteria();
		$pol_c->add(OpPolAdoptionPeer::GRANTED_AT, NULL);
		$pol_c->add(OpPolAdoptionPeer::REFUSED_AT, NULL);		
		$pol_ads = OpPolAdoptionPeer::doSelect($pol_c);

		$loc_c = new Criteria();
		$loc_c->add(OpLocAdoptionPeer::GRANTED_AT, NULL);
		$loc_c->add(OpLocAdoptionPeer::REFUSED_AT, NULL);
		$loc_ads = OpLocAdoptionPeer::doSelect($loc_c);

    // merge e sort dell'array risultante
		$ads = array_merge($pol_ads, $loc_ads);
		usort($ads, array("OpAdoptionPeer", "req_compare"));

		return $ads;
		
  }

  /**
   * ritorna la lista di tutti i record nelle tabelle op_pol_adoption e op_loc_adoption
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public static function getAll($con = NULL)
  {
		if ($con === null) {
			$con = Propel::getConnection(OpPolAdoptionPeer::DATABASE_NAME);
		}
		$pol_c = new Criteria();
		$pol_ads = OpPolAdoptionPeer::doSelect($pol_c);

		$loc_c = new Criteria();
		$loc_ads = OpLocAdoptionPeer::doSelect($loc_c);

    // merge e sort dell'array risultante
		$ads = array_merge($pol_ads, $loc_ads);
		usort($ads, array("OpAdoptionPeer", "req_compare"));
		
		return $ads;
		
  }
  


  /**
   * torna se l'utente user_id ha adottato il politico pol_id
   * il controllo è sia su un'adozione diretta, sia sul territorio
   * (il politico risulta adottato se l'utente ha adottato una località
   *  nella quale il politico ha almeno un incarico attuale)
   *
   * @param ID user_id id dell'utente adopter
   * @param ID pol_id id del politico
   *
   * @return true/false
   * @author Guglielmo Celata
   **/
  public static function isAdopted($user_id, $pol_id)
  {
    // legge l'array di id degli adopters
    $adopters = self::getAdoptersForPolitician($pol_id);

    // torna vero o falso
    return in_array($user_id, $adopters);    
  }
  
  /**
   * torna se la località è adottata da un utente
   *
   * @param ID user_id id dell'utente adopter
   * @param ID loc_id id della località
   *
   * @return true/false
   * @author Guglielmo Celata
   **/
  public static function isLocationAdopted($user_id, $loc_id)
  {
    // legge l'array di id degli adopters
    $adopters = self::getAdoptersForLocation($loc_id);

    // torna vero o falso
    return in_array($user_id, $adopters);
    
  }


  
  /**
   * torna l'elenco di user_id che hanno adottato il politico
   *
   * @param ID pol_id id del politico per cui si cercano gli adopters
   * @return array of user_id
   * @author Guglielmo Celata
   **/
  public static function getAdoptersForPolitician($pol_id)
  {
    // elenco adopters diretti
    $adopter_ids = OpPolAdoptionPeer::getAdoptersForPolitician($pol_id);


    // estraggo lista incarichi attuali
    $pol = OpPoliticianPeer::retrieveByPK($pol_id);
    $actual_inst_charges = $pol->fetch_current_institution_charges();
    
    // ciclo di controllo sulle location degli incarichi attuali
    foreach ($actual_inst_charges as $charge)
      $adopter_ids = array_merge($adopter_ids, OpLocAdoptionPeer::getAdoptersForLocation($charge->getOpLocation()->getId()));

    return array_unique($adopter_ids);

  }


  /**
   * torna l'elenco di user_id che hanno adottato una località
   *
   * @param ID loc_id id della località per cui si cercano gli adopters
   * @return array of user_id
   * @author Guglielmo Celata
   **/
  public static function getAdoptersForLocation($loc_id)
  {
    // elenco adopters diretti
    $adopter_ids = OpLocAdoptionPeer::getAdoptersForLocation($loc_id);

    return $adopter_ids;
  }
  
  /**
   * torna l'elenco di adozioni per un utente
   *
   * @param ID user_id - l'id dell'utente
   * @return array of OpPolitician e OpLocation
   * @author Guglielmo Celata
   **/
  public function getAdoptees($user_id)
  {
    $adoptees = array();
    $adoptees = OpPolAdoptionPeer::getAdoptees($user_id);
    $adoptees = array_merge($adoptees, OpLocAdoptionPeer::getAdoptees($user_id));
    usort($adoptees, array("OpAdoptionPeer", "gra_compare"));
    return $adoptees;
  }

  
} // OpAdoptionPeer
