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

class OpSecurityUser extends sfRemoteGuardSecurityUser
{
	
	public function hasSubscriberId(){
		if ($this->getAttribute('subscriber_id', '', 'subscriber') !== null){
			return true;
		} else {
			return false;
		}
	}
	
	public function getSubscriberId()
	{
	  return $this->getAttribute('subscriber_id', '', 'subscriber');
	}

	public function getSubscriber()
	{
	  return OpUserPeer::retrieveByPk($this->getSubscriberId());
	}

	public function getName()
	{
	  return $this->getAttribute('name', '', 'subscriber');
	}

	public function getFirstname()
	{
	  return $this->getAttribute('firstname', '', 'subscriber');
	}

	public function getHash()
	{
	  return $this->getAttribute('hash', '', 'subscriber');
	}



  /**
   * se l'utente ha adozioni o meno
   *
   * @return true/false
   * @author Guglielmo Celata
   **/
  public function hasAdoptees()
  {
    return count(OpAdoptionPeer::getAdoptees($this->getSubscriberId())) > 0 ? true : false;
  }

	/**
	 * torna se l'utente è adopter di un politico
	 * il controllo è fatto sia sull'adozione diretta che sull'adozione dei territori
	 * ossia, se il politico ha incarichi istituzionali attuali in territori adottati dall'utente
	 *
	 * @param ID pol_id l'id del politico da controllare
	 * @return true/false
	 * @author Guglielmo Celata
	 **/
	public function isAdopter( $pol_id )
	{
	  return OpAdoptionPeer::isAdopted($this->getSubscriberId(), $pol_id);
	}
	
	/**
	 * torna se l'utente è adopter di una località
	 *
	 * @param ID loc_id id della località da controllare
	 * @return true/false
	 * @author Guglielmo Celata
	 **/
	public function isLocationAdopter( $loc_id )
	{
	  return OpAdoptionPeer::isLocationAdopted($this->getSubscriberId(), $loc_id);
	}

  private function old_signin($user)
  {
    $this->setAttribute('subscriber_id', $user->getId(), 'subscriber');
    $this->setAuthenticated(true);

    $this->addCredential('subscriber');

    $this->setAttribute('name', $user->__toString(), 'subscriber');
    $this->setAttribute('firstname', $user->getFirstName(), 'subscriber');
    
  }
  
  
  public function signIn($xml_user, $remember = false)
  {
    // gestisce il caso di login in locale (gli script batch)
    if ($xml_user instanceof OpUser)
    {
      $this->old_signin($xml_user);
      return;
    }
    
    parent::signIn($xml_user, $remember);

  }


}

?>