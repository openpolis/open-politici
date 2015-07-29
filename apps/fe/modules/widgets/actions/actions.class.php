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

/**
 * widgets actions.
 *
 * @package    openpolis
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class widgetsActions extends sfActions
{
	/**
   * Executes index action
   *
   */
	public function executeIndex()
	{
		//$this->forward('default', 'module');
	}

	public function executeWdgPresenze()
	{
		//$this->forward('default', 'module');
		$this->id_politico=$this->getRequestParameter('politician_id');
		$this->hasLayout = $this->getRequestParameter('has_layout');
		$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
		$this->forward404Unless($this->politician);
	}

	public function executePresenze()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		$this->dimensione=$this->getRequestParameter('dim');
		$this->tipo=$this->getRequestParameter('tipo');
		$this->id_politico=$this->getRequestParameter('politician_id');
		if ($this->getRequestParameter('politician_id')) {
			$requested=$this->getRequestParameter('politician_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/presenze/'.$requested;
				$xslt_url='wdgt/widget-presenze-dep-cod'.$this->tipo.'.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/presenze/'.$requested;
				$xslt_url='wdgt/widget-presenze-sen-cod'.$this->tipo.'.xslt';
			}
			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			} else {
				$file_contents= file_get_contents($docurl);
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XSLTProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'dimensione', $this->dimensione);
				$newdom = $proc->transformToDoc($inputdom);
				$lines= explode(chr(10),$newdom->saveXML());
				foreach ($lines as $line) {
    				$this->js.= "document.write('". ($line) ."');";
				}
				$this->xmlout= str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>','',$this->xmlout);
				$this->xmlout= str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">','',$this->xmlout);
				$this->xmlout= $this->js;
			}

		}
	}

	public function executePresenzeP()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		$this->dimensione=$this->getRequestParameter('dim');
		$this->tipo=$this->getRequestParameter('tipo');
		if ($this->getRequestParameter('politician_id')) {
			$requested=$this->getRequestParameter('politician_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/presenze/'.$requested;
				$xslt_url='wdgt/widget-presenze-dep-cod'.$this->tipo.'.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/presenze/'.$requested;
				$xslt_url='wdgt/widget-presenze-sen-cod'.$this->tipo.'.xslt';
			}

			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			} else {
				$file_contents= file_get_contents($docurl);
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XSLTProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'dimensione', $this->dimensione);
				$newdom = $proc->transformToDoc($inputdom);
				$lines= explode(chr(10),$newdom->saveXML());
				foreach ($lines as $line) {
    				$this->js.= ($line);
				}
				$this->xmlout= str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>','',$this->xmlout);
				$this->xmlout= str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">','',$this->xmlout);
				$this->xmlout= $this->js;
			}

		}
	}

	public function executeWdgVoti()
	{
		//$this->forward('default', 'module');
		$this->id_politico=$this->getRequestParameter('politician_id');
		$this->hasLayout = $this->getRequestParameter('has_layout');
		$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
		$this->forward404Unless($this->politician);
	}

	public function executeVoti()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		$this->dimensione=$this->getRequestParameter('dim');
		$this->tipo=$this->getRequestParameter('tipo');
		$this->id_politico=$this->getRequestParameter('politician_id');
		if ($this->getRequestParameter('politician_id')) {
			$requested=$this->getRequestParameter('politician_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/voti/'.$requested;
				$xslt_url='wdgt/widget-voti-dep-cod'.$this->tipo.'.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/voti/'.$requested;
				$xslt_url='wdgt/widget-voti-sen-cod'.$this->tipo.'.xslt';
			}
			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			} else {
				$file_contents= file_get_contents($docurl);
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XSLTProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'dimensione', $this->dimensione);
				$newdom = $proc->transformToDoc($inputdom);
				$lines= explode(chr(10),$newdom->saveXML());
				foreach ($lines as $line) {
    				$this->js.= "document.write('". ($line) ."');";
				}
				$this->xmlout= str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>','',$this->xmlout);
				$this->xmlout= str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">','',$this->xmlout);
				$this->xmlout= $this->js;
			}

		}
	}

	public function executeVotiV()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		$this->dimensione=$this->getRequestParameter('dim');
		$this->tipo=$this->getRequestParameter('tipo');
		if ($this->getRequestParameter('politician_id')) {
			$requested=$this->getRequestParameter('politician_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/voti/'.$requested;
				$xslt_url='wdgt/widget-voti-dep-cod'.$this->tipo.'.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/voti/'.$requested;
				$xslt_url='wdgt/widget-voti-sen-cod'.$this->tipo.'.xslt';
			}

			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			} else {
				$file_contents= file_get_contents($docurl);
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XSLTProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'dimensione', $this->dimensione);
				$newdom = $proc->transformToDoc($inputdom);
				$lines= explode(chr(10),$newdom->saveXML());
				foreach ($lines as $line) {
    				$this->js.= ($line);
				}
				$this->xmlout= str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>','',$this->xmlout);
				$this->xmlout= str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">','',$this->xmlout);
				$this->xmlout= $this->js;
			}

		}
	}

	public function executeWdgIndice()
	{
		//$this->forward('default', 'module');
		$this->id_politico=$this->getRequestParameter('politician_id');
		$this->hasLayout = $this->getRequestParameter('has_layout');
		$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
		$this->forward404Unless($this->politician);
	}

	public function executeIndice()
	{
		$docurl='';
		$totale_senatori=OpInstitutionChargePeer::getChargesGroupByPolitician(5);
		$totale_deputati=OpInstitutionChargePeer::getChargesGroupByPolitician(4)-OpInstitutionChargePeer::getChargesGroupByPolitician(3);
		$repository='http://sandbox.openpolis.it';
		$this->dimensione=$this->getRequestParameter('dim');
		$this->tipo=$this->getRequestParameter('tipo');
		$this->id_politico=$this->getRequestParameter('politician_id');
		if ($this->getRequestParameter('politician_id')) {
			$requested=$this->getRequestParameter('politician_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
				$xslt_url='wdgt/widget-indice-dep-cod'.$this->tipo.'.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
				$xslt_url='wdgt/widget-indice-sen-cod'.$this->tipo.'.xslt';
			}
			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			} else {
				$file_contents= file_get_contents($docurl);
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XSLTProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'dimensione', $this->dimensione);
				$proc->setParameter('', 'totale_senatori', $totale_senatori);
				$proc->setParameter('', 'totale_deputati', $totale_deputati);
				$newdom = $proc->transformToDoc($inputdom);
				$lines= explode(chr(10),$newdom->saveXML());
				foreach ($lines as $line) {
    				$this->js.= "document.write('". ($line) ."');";
				}
				$this->xmlout= str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>','',$this->xmlout);
				$this->xmlout= str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">','',$this->xmlout);
				$this->xmlout= $this->js;
			}

		}
	}

	public function executeIndiceI()
	{
		$docurl='';
		$totale_senatori=OpInstitutionChargePeer::getChargesGroupByPolitician(5);
		$totale_deputati=OpInstitutionChargePeer::getChargesGroupByPolitician(4)-OpInstitutionChargePeer::getChargesGroupByPolitician(3);
		$repository='http://sandbox.openpolis.it';
		$this->dimensione=$this->getRequestParameter('dim');
		$this->tipo=$this->getRequestParameter('tipo');
		if ($this->getRequestParameter('politician_id')) {
			$requested=$this->getRequestParameter('politician_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
				$xslt_url='wdgt/widget-indice-dep-cod'.$this->tipo.'.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
				$xslt_url='wdgt/widget-indice-sen-cod'.$this->tipo.'.xslt';
			}

			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			} else {
				$file_contents= file_get_contents($docurl);
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XSLTProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'dimensione', $this->dimensione);
				$proc->setParameter('', 'totale_senatori', $totale_senatori);
				$proc->setParameter('', 'totale_deputati', $totale_deputati);
				$newdom = $proc->transformToDoc($inputdom);
				$lines= explode(chr(10),$newdom->saveXML());
				foreach ($lines as $line) {
    				$this->js.= ($line);
				}
				$this->xmlout= str_replace('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>','',$this->xmlout);
				$this->xmlout= str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">','',$this->xmlout);
				$this->xmlout= $this->js;
			}

		}
	}

	public function url_exists($url) {
		$handle   = curl_init($url);
		if (false === $handle)
		{
			return false;
		}
		curl_setopt($handle, CURLOPT_HEADER, false);
		curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
		curl_setopt($handle, CURLOPT_NOBODY, true);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
		$connectable = curl_exec($handle);
		curl_close($handle);
		return $connectable;
	}
}
