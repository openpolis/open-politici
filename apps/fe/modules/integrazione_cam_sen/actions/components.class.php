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
 * argument components.
 *
 * @package    openpolis
 * @subpackage argument
 * @author     Gianluca Canale
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class integrazione_cam_senComponents extends sfComponents
{
	public function executeListaPresenze()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';

		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/presenze/'.$requested;
				$xslt_url='parse_camera/xml/presenze/presenze.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/presenze/'.$requested;
				$xslt_url='parse_senato/xml/presenze/presenze.xslt';
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
				$proc->setParameter('', 'source-uri', $docurl);
				$proc->setParameter('', 'widget-uri', url_for('/widgets/WdgPresenze?politician_id='.$this->getRequestParameter('content_id'), 'Vedi tutti'));
				$proc->setParameter('', 'faq', '/faq/index#faq_11');
				$proc->setParameter('', 'script_camera', url_for('integrazione_cam_sen/ListaTotalePresenzeCamera', 'Vedi tutti'));
				$proc->setParameter('', 'script_senato', url_for('integrazione_cam_sen/ListaTotalePresenzeSenato', 'Vedi tutti'));
				$proc->setParameter('', 'rss_script_camera', url_for('RssPresenze/'.$this->getRequestParameter('content_id'), 'Vedi tutti'));
				$proc->setParameter('', 'rss_script_senato', url_for('RssPresenze/'.$this->getRequestParameter('content_id'), 'Vedi tutti'));
				$newdom = $proc->transformToDoc($inputdom);
				$this->xmlout= $newdom->saveXML();
			}

		}

	}



	public function executeListaVoti()
	{
		$docurl='';
		$repository='http://sandbox.openpolis.it';
		

		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/voti/'.$requested;
				$xslt_url='parse_camera/xml/voti/voti.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/voti/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/voti/'.$requested;
				$xslt_url='parse_senato/xml/voti/voti.xslt';
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
				$proc->setParameter('', 'source-uri', $docurl);
				$proc->setParameter('', 'widget-uri', url_for('widgets/WdgVoti?politician_id='.$this->getRequestParameter('content_id'), 'Vedi tutti'));
				$proc->setParameter('', 'faq', '/faq/index#faq_13');
				$proc->setParameter('', 'source-uri', $docurl);
				$proc->setParameter('', 'source-uri', $docurl);
				$proc->setParameter('', 'script_camera', url_for('integrazione_cam_sen/ListaTotalePresenzeCamera', 'Vedi tutti'));
				$proc->setParameter('', 'script_senato', url_for('integrazione_cam_sen/ListaTotalePresenzeSenato', 'Vedi tutti'));
				$proc->setParameter('', 'rss_script_camera', url_for('RssVoti/'.$this->getRequestParameter('content_id'), 'Vedi tutti'));
				$proc->setParameter('', 'rss_script_senato', url_for('RssVoti/'.$this->getRequestParameter('content_id'), 'Vedi tutti'));        
  			$this->xmlout = $proc->transformToXML($inputdom);          
			}


		}








	}

	public function executeListaIndice()
	{
		$docurl='';
		$xslt_url='';
		$repository='http://sandbox.openpolis.it';
		$totale_senatori=OpInstitutionChargePeer::getChargesGroupByPolitician(5);
		$totale_deputati=OpInstitutionChargePeer::getChargesGroupByPoliticianNotInst(4,3);

		if ($this->getRequestParameter('content_id')) {
			$requested=$this->getRequestParameter('content_id').".xml";
			if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
				$xslt_url='parse_camera/xml/indice/indice.xslt';
			}
			if ($this->url_exists($repository.'/parse_senato/xml/indice/'.$requested)) {
				$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
				$xslt_url='parse_senato/xml/indice/indice.xslt';
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
			if ($xslt_url) {


				$xsl = new DomDocument();
				$xsl->load($xslt_url);
				$inputdom = new DomDocument();
				if ($inputdom->loadXML($file_contents)) {
					$proc = new XsltProcessor();
					$proc->importStylesheet($xsl);
					$proc->setParameter('', 'source-uri', $docurl);
					$proc->setParameter('', 'widget-uri', url_for('widgets/WdgIndice?politician_id='.$this->getRequestParameter('content_id'), 'Vedi tutti'));
					$proc->setParameter('', 'faq', '/faq/index#faq_12');
					$proc->setParameter('', 'totale_senatori', $totale_senatori);
					$proc->setParameter('', 'totale_deputati', $totale_deputati);
					$proc->setParameter('', 'faq', '/faq/index#faq_12');
					$proc->setParameter('', 'script_camera', url_for('integrazione_cam_sen/ListaTotaleIndiceCamera', 'Vedi tutti'));
					$proc->setParameter('', 'script_senato', url_for('integrazione_cam_sen/ListaTotaleIndiceSenato', 'Vedi tutti'));
					$proc->setParameter('', 'rss_script_camera', url_for('RssIndice/'.$this->getRequestParameter('content_id'), 'Vedi tutti'));
					$proc->setParameter('', 'rss_script_senato', url_for('RssIndice/'.$this->getRequestParameter('content_id'), 'Vedi tutti'));
					$newdom = $proc->transformToDoc($inputdom);
					$this->xmlout= $newdom->saveXML();
				}
			}else $this->xmlout='';

		}


	}

	public function executeListaTotalePresenzeSenato()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_presenze.xml";
		if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
			$docurl = $repository.'/parse_senato/xml/presenze/'.$requested;
			$xslt_url='parse_senato/xml/presenze/totale_presenze_senato.xslt';
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
		//$this->xmlout.=$file_contents;
		//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$sort="@nome";
			$order='descending';
			$this->neworder='ascending';
			if ($this->getRequestParameter('sort')) $sort=$this->getRequestParameter('sort');
			if ($this->getRequestParameter('order')) $order=$this->getRequestParameter('order');
			if ($order=='ascending') {
				$this->neworder='descending';
			}

			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);
			$proc->setParameter('', 'source-uri', $docurl);
			$proc->setParameter('', 'widget-uri', url_for('widgets/wdgPresenze', 'Vedi tutti'));
			$proc->setParameter('', 'SORTBY', $sort);
			$proc->setParameter('', 'sortOrder', $this->neworder);
			$proc->setParameter('', 'assente', url_for('integrazione_cam_sen/ListaTotalePresenzeSenato?sort=ASSENTE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'presente', url_for('integrazione_cam_sen/ListaTotalePresenzeSenato?sort=PRESENTE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'in_missione', url_for('integrazione_cam_sen/ListaTotalePresenzeSenato?sort=IN_MISSIONE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'nome', url_for('integrazione_cam_sen/ListaTotalePresenzeSenato?sort=@nome&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'rss_script_senato', url_for('RssTotalePresenzeSenato', 'Vedi tutti'));


			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
		}

	}

	public function executeListaTotalePresenzeCamera()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_presenze.xml";
		if ($this->url_exists($repository.'/parse_senato/xml/presenze/'.$requested)) {
			$docurl = $repository.'/parse_camera/xml/presenze/'.$requested;
			$xslt_url='parse_camera/xml/presenze/totale_presenze_camera.xslt';
		}
		// prendo il contenuto
		$this->xmlout=$docurl;

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
		//$this->xmlout.=$file_contents;
		//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$sort="@nome";
			$order='descending';
			$this->neworder='ascending';
			if ($this->getRequestParameter('sort')) $sort=$this->getRequestParameter('sort');
			if ($this->getRequestParameter('order')) $order=$this->getRequestParameter('order');
			if ($order=='ascending') {
				$this->neworder='descending';
			}

			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);
			$proc->setParameter('', 'source-uri', $docurl);
			$proc->setParameter('', 'widget-uri', url_for('widgets/wdgPresenze', 'Vedi tutti'));
			$proc->setParameter('', 'SORTBY', $sort);
			$proc->setParameter('', 'sortOrder', $this->neworder);
			$proc->setParameter('', 'assente', url_for('integrazione_cam_sen/ListaTotalePresenzeCamera?sort=ASSENTE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'presente', url_for('integrazione_cam_sen/ListaTotalePresenzeCamera?sort=PRESENTE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'in_missione', url_for('integrazione_cam_sen/ListaTotalePresenzeCamera?sort=IN_MISSIONE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'nome', url_for('integrazione_cam_sen/ListaTotalePresenzeCamera?sort=@nome&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'rss_script_camera', url_for('RssTotalePresenzeCamera', 'Vedi tutti'));


			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
		}

	}

	public function executeListaTotaleIndiceSenato()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_indice.xml";
		if ($this->url_exists($repository.'/parse_senato/xml/indice/'.$requested)) {
			$docurl = $repository.'/parse_senato/xml/indice/'.$requested;
			$xslt_url='parse_senato/xml/indice/totale_indice_senato.xslt';
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
		//$this->xmlout.=$file_contents;
		//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$sort="@nome";
			$order='descending';
			$this->neworder='ascending';
			if ($this->getRequestParameter('sort')) $sort=$this->getRequestParameter('sort');
			if ($this->getRequestParameter('order')) $order=$this->getRequestParameter('order');
			if ($order=='ascending') {
				$this->neworder='descending';
			}

			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);
			$proc->setParameter('', 'source-uri', $docurl);
			$proc->setParameter('', 'SORTBY', $sort);
			$proc->setParameter('', 'widget-uri', url_for('widgets/wdgPresenze', 'Vedi tutti'));
			$proc->setParameter('', 'sortOrder', $this->neworder);
			$proc->setParameter('', 'indice', url_for('integrazione_cam_sen/ListaTotaleIndiceSenato?sort=INDICE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'scaglione', url_for('integrazione_cam_sen/ListaTotaleIndiceSenato?sort=SCAGLIONE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'posizione', url_for('integrazione_cam_sen/ListaTotaleIndiceSenato?sort=POSIZIONE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'nome', url_for('integrazione_cam_sen/ListaTotaleIndiceSenato?sort=@nome&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'rss_script_senato', url_for('RssTotaleIndiceSenato', 'Vedi tutti'));


			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
		}

	}

	public function executeListaTotaleIndiceCamera()
	{
		$docurl='';
		$this->xmlout='';
		$repository='http://sandbox.openpolis.it';
		$this->last = OpPolitician::getLastChargeUpdate();
		$requested="totale_indice.xml";
		if ($this->url_exists($repository.'/parse_camera/xml/indice/'.$requested)) {
			$docurl = $repository.'/parse_camera/xml/indice/'.$requested;
			$xslt_url='parse_camera/xml/indice/totale_indice_camera.xslt';
		}
		// prendo il contenuto
		$this->xmlout=$docurl;

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
		//$this->xmlout.=$file_contents;
		//passo il contenuto al dom e converto output tramite xslt, solo se riesco a catchare l'id del politico. altrimento azzero il blocco e nascondo tutto.

		$xsl = new DomDocument();
		$xsl->load($xslt_url);
		$inputdom = new DomDocument();
		if ($inputdom->loadXML($file_contents)) {
			$sort="@nome";
			$order='descending';
			$this->neworder='ascending';
			if ($this->getRequestParameter('sort')) $sort=$this->getRequestParameter('sort');
			if ($this->getRequestParameter('order')) $order=$this->getRequestParameter('order');
			if ($order=='ascending') {
				$this->neworder='descending';
			}

			$proc = new XsltProcessor();
			$proc->importStylesheet($xsl);
			$proc->setParameter('', 'source-uri', $docurl);
			$proc->setParameter('', 'widget-uri', url_for('widgets/wdgPresenze', 'Vedi tutti'));
			$proc->setParameter('', 'SORTBY', $sort);
			$proc->setParameter('', 'sortOrder', $this->neworder);
			$proc->setParameter('', 'indice', url_for('integrazione_cam_sen/ListaTotaleIndiceCamera?sort=INDICE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'scaglione', url_for('integrazione_cam_sen/ListaTotaleIndiceCamera?sort=SCAGLIONE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'posizione', url_for('integrazione_cam_sen/ListaTotaleIndiceCamera?sort=POSIZIONE&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'nome', url_for('integrazione_cam_sen/ListaTotaleIndiceCamera?sort=@nome&order='.$this->neworder, 'Vedi tutti'));
			$proc->setParameter('', 'rss_script_camera', url_for('RssTotaleIndiceCamera', 'Vedi tutti'));


			$newdom = $proc->transformToDoc($inputdom);
			$this->xmlout= $newdom->saveXML();
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

?>
