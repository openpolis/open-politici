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

function link_to_rss($name, $uri)
{
  	return link_to(image_tag('/images/symbols/rss.png', array('alt' => 'rss', 'title' => 'Esporta RSS', 'width'=>'23', 'height'=>'12', 'border'=>'0', 'target' => '_blank', 'hreflang'=>'it', 'lang'=>'it')), $uri);
}

function link_to_login($name, $uri = null)
{
	  use_helper('Javascript');
	
	  if ($uri && sfContext::getInstance()->getUser()->isAuthenticated())
	  {
			return link_to($name, $uri);
	  }
	  else
	  {
			return link_to_function($name, visual_effect('blind_down', 'login', array('duration' => 0.5)));
	  }
}




function pager_navigation($pager, $uri)
{
	$navigation = '';
 
  	if ($pager->haveToPaginate())
  	{  
    	$uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';

    	// First and previous page
    	if ($pager->getPage() != 1)
    	{
      		$navigation .= link_to(image_tag('first.gif', 'align=absmiddle'), $uri.'1');
      		$navigation .= link_to(image_tag('previous.gif', 'align=absmiddle'), $uri.$pager->getPreviousPage()).'&nbsp;';
    	}
    
    	// Pages one by one
    	$links = array();
    	foreach ($pager->getLinks() as $page)
    	{
      		$links[] = link_to_unless($page == $pager->getPage(), $page, $uri.$page);
    	}
    	$navigation .= join('&nbsp;&nbsp;', $links);

    	// Next and last page
    	if ($pager->getPage() != $pager->getCurrentMaxLink())
    	{
      		$navigation .= '&nbsp;'.link_to(image_tag('next.gif', 'align=absmiddle'), $uri.$pager->getNextPage());
      		$navigation .= link_to(image_tag('last.gif', 'align=absmiddle'), $uri.$pager->getLastPage());
    	}

  	}

  	return $navigation;
}
?>