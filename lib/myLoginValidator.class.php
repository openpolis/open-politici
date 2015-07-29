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

class myLoginValidator extends sfValidator
{

   public function initialize($context, $parameters = null)
   {
     // initialize parent
     parent::initialize($context);

     // set defaults
     $this->setParameter('login_error', 'Invalid input');
     $this->getParameterHolder()->add($parameters);

     return true;
   }

   public function execute(&$value, &$error)
   {
     $password_param = $this->getParameter('password');
     $password = $this->getContext()->getRequest()->getParameter($password_param);
     $email = $value;

     if ($user = OpUserPeer::getAuthenticatedUserByEmail($email, $password))
     {
  	   //add for remember me procedure
  	   $remember = $this->getContext()->getRequest()->getParameter('remember_me');
       
  	   $this->getContext()->getUser()->signIn($user, $remember);
       return true;
     }

     $error = $this->getParameter('login_error');
     return false;
  }
}
?>
