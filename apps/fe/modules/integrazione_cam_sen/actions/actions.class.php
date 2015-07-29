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
 * integrazione_cam_sen actions.
 *
 * @package    openpolis
 * @subpackage integrazione_cam_sen
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */


class integrazione_cam_senActions extends sfActions
{
	/**
   * Executes index action
   *
   */
	public function executeIndex()
	{
		/*if ($this->getRequestParameter('content_id')) {
		$this->forward('integrazione_cam_sen', 'ListaVoti');
		}else $this->xmlout="Nessun dato ancora caricato per questo politico";
		*/
	}

	public function executeListaVoti()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';

		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/voti/'.$requested)) {
				$docurl = 'http://sandbox.openpolis.it/parse_camera/xml/voti/'.$requested;
				$xslt_url='parse_camera/xml/voti/voti.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/voti/'.$requested)) {
				$docurl = 'http://sandbox.openpolis.it/parse_senato/xml/voti/'.$requested;
				$xslt_url='parse_senato/xml/voti/voti.xslt';
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
				$proc = new XsltProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'source-uri', $docurl);
				$newdom = $proc->transformToDoc($inputdom);
				$this->xmlout= $newdom->saveXML();
			}

		}
	}


	public function executeListaIndice()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';

		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
				$xslt_url='parse_camera/xml/indice/indice.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
				$xslt_url='parse_senato/xml/indice/presenze.xslt';
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
				$proc = new XsltProcessor();
				$proc->importStylesheet($xsl);
				$proc->setParameter('', 'source-uri', $docurl);
				$newdom = $proc->transformToDoc($inputdom);
				$this->xmlout= $newdom->saveXML();
			}

		}








	}

	public function executeListaTotalePresenzeSenato()
	{
      $this->response->setTitle("indice di presenze dei Senatori | openpolis"); 
	}

	public function executeListaTotalePresenzeCamera()
	{
      $this->response->setTitle("indice di presenze dei Deputati | openpolis"); 
	}

	public function executeListaTotaleIndiceSenato()
	{
      $this->response->setTitle("indice di attivita' dei Senatori | openpolis"); 
	}

	public function executeListaTotaleIndiceCamera()
	{
      $this->response->setTitle("indice di attivita' dei Deputati | openpolis");
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

	public function executeRssPresenze()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		//echo "param:".$this->getRequestParameter('content_id');
		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/presenze/'.$requested;
				$xslt_url='parse_camera/xml/presenze/presenze_rss.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/presenze/'.$requested;
				$xslt_url='parse_senato/xml/presenze/presenze_rss.xslt';
			}

			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = str_replace('<br>','<br/>',curl_exec($ch));
				curl_close($ch);
			} else {
				$file_contents= str_replace('<br>','<br/>',file_get_contents($docurl));
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XsltProcessor();
				$proc->importStylesheet($xsl);

				$newdom = $proc->transformToDoc($inputdom);
				$this->xmlout= $newdom->saveXML();
				echo $this->xmlout;
			}


		}
	}

	public function executeRssIndice()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		//echo "param:".$this->getRequestParameter('content_id');
		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
				$xslt_url='parse_camera/xml/indice/indice_rss.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
				$xslt_url='parse_senato/xml/indice/indice_rss.xslt';
			}

			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = str_replace('<br>','<br/>',curl_exec($ch));
				curl_close($ch);
			} else {
				$file_contents= str_replace('<br>','<br/>',file_get_contents($docurl));
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XsltProcessor();
				$proc->importStylesheet($xsl);

				$newdom = $proc->transformToDoc($inputdom);
				$this->xmlout= $newdom->saveXML();
				echo $this->xmlout;
			}


		}
	}

	public function executeRssVoti()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		//echo "param:".$this->getRequestParameter('content_id');
		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/voti/'.$requested;
				$xslt_url='parse_camera/xml/voti/voti_rss.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/voti/'.$requested;
				$xslt_url='parse_senato/xml/voti/voti_rss.xslt';
			}

			// prendo il contenuto

			if (function_exists('curl_init')){
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $docurl);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
				$file_contents = str_replace('<br>','<br/>',curl_exec($ch));
				curl_close($ch);
			} else {
				$file_contents= str_replace('<br>','<br/>',file_get_contents($docurl));
			}

			//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

			$xsl = new DomDocument();
			$xsl->load($xslt_url);
			$inputdom = new DomDocument();
			if ($inputdom->loadXML($file_contents)) {
				$proc = new XsltProcessor();
				$proc->importStylesheet($xsl);

				$newdom = $proc->transformToDoc($inputdom);
				$this->xmlout= $newdom->saveXML();
				echo $this->xmlout;
			}


		}
	}

	public function executeRssTotaleIndiceSenato()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_indice.xml";
		if ($this->url_exists($repository.'/parse_senato/xml/indice/'.$requested)) {
			$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
			$xslt_url='parse_senato/xml/indice/totale_indice_rss_senato.xslt';
		}


		//$this->xmlout=$docurl;
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

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);

			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
			echo $this->xmlout;
		}

	}

	public function executeRssTotaleIndiceCamera()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_indice.xml";
		if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
			$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
			$xslt_url='parse_camera/xml/indice/totale_indice_rss_camera.xslt';
		}


		//$this->xmlout=$docurl;
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

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);

			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
			echo $this->xmlout;
		}
	}

	public function executeRssTotalePresenzeSenato()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_presenze.xml";
		if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
			$docurl = $repository.'/parse_senato/xml/presenze/'.$requested;
			$xslt_url='parse_senato/xml/presenze/totale_presenze_rss_senato.xslt';
		}
		//$this->xmlout=$docurl;
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

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);

			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
			echo $this->xmlout;
		}



	}

	public function executeRssTotalePresenzeCamera()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_presenze.xml";
		if ($this->url_exists($repository.'/parse_camera/xml/presenze/'.$requested)) {
			$docurl = $repository.'/parse_camera/xml/presenze/'.$requested;
			$xslt_url='parse_camera/xml/presenze/totale_presenze_rss_camera.xslt';
		}
		//$this->xmlout=$docurl;
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

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);

			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
			echo $this->xmlout;
		}

	}



}


?>