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
class rememberFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    //execute the filter only once
	if ($this->isFirstCall())
	{
	  //remember me procedure
	  if($cookie = $this->getContext()->getRequest()->getCookie(sfConfig::get('app_remember_cookie_name', 'opRemember')))
	  {
		   $c = new Criteria();
		   $c->add(OpUserPeer::REMEMBER_KEY, $cookie);
		   $user = OpUserPeer::doSelectOne($c);
		   if ($user)
		   {
		  	 //sign in
			   $this->getContext()->getUser()->signIn($user);
		   }
	  } 
	}
	
	//execute next filter
	$filterChain->execute();
  }
}
?>