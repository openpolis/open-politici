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
 * OpSolrIndexManager
 *
 * classe astratta (wrapper sulla Apache_Solr_Service)
 * per la gestione degli indici testuali in Openpolis
 *
 *
 * @package op
 * @author  Guglielmo Celata
 * 
 **/
abstract class OpSolrIndexManager
{
  

  private $_instance;

  /**
   * costruttore, vengono usati i parametri di configurazione per la connessione al server solr
   *
   * @return void
   * @author Guglielmo Celata
   **/
  function __construct( )
  {
    $host = sfConfig::get('search_solr_host');
    $port = sfConfig::get('search_solr_port');
    $path = sfConfig::get('search_solr_path');
    
    $this->_instance = new Apache_Solr_Service($host, $port, $path);
  }
  
  
  /**
   * torna un resultset per una query
   *
   * @return Apache_Solr_Response
   * @author Guglielmo Celata
   **/
  public function search($query, $offset, $limit, $options = array())
  {
    try {
      $response = $this->_instance->search($query, $offset, $limit, $options);
    } catch (Exception $e) {
      sfContext::getInstance()->getLogger()->info("{OpIndexManager::search}: errore: " . $e->getMessage());
      throw new Exception ($e->getMessage());                      
    }
    return $response;  
  }
  
  
  /**
   * rimuove un documento dall'indice
   *
   * @return void
   * @param  $doc - l'oggetto documento da rimuovere
   * @author Guglielmo Celata
   **/
  public function removeDocument( $doc )
  {
    try {
      if (!$doc instanceof Apache_Solr_Document) $doc = $this->intoDocument($doc);      
      $this->_instance->deleteById($doc->id);
      sfContext::getInstance()->getLogger()->info("{OpIndexManager::removeDocument} rimosso ".$doc->id);              
    } catch (Exception $e) {
      sfContext::getInstance()->getLogger()->info("{OpIndexManager::removeDocument}: errore: " . $e->getMessage());
      throw new Exception ($e);                      
    }
  }

  /**
   * resetta completamente gli indici, anche le meta-informazioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function resetIndexes()
  {
    $this->removeAllDocuments();
    $this->commit();
    $this->optimize();    
  }

  /**
   * rimuove tutti i documenti
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function removeAllDocuments()
  {
    $this->_instance->deleteByQuery('*:*'); 
  }
  
  /**
   * ottimizza l'indice
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function optimize()
  {
    $this->_instance->optimize();        
  }

  /**
   * commit delle modifiche
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function commit()
  {
    $this->_instance->commit();        
  }
  

  /**
   * la modifica di un documento è la somma delle operazioni
   * di rimozione e aggiunta
   *
   * @param $doc - un oggetto di tipo Apache_Solr_Document
   * @return void
   * @author Guglielmo Celata
   **/
  public function updateDocument($doc)
  {
    if (!$doc instanceof Apache_Solr_Document) $doc = $this->intoDocument($doc);
    
    $this->removeDocument($doc);
    $this->addDocument($doc);
  }

  /**
   * aggiunge un documento
   *
   * @param doc - documento di tipo Solr_Apache_Document oppure op_politician, op_opinable_content
   * @return void
   * @author Guglielmo Celata
   **/
  public function addDocument( $doc )
  {
    // se è il caso, trasforma un BdContent in Apache_Solr_Document
    try {
      if (!$doc instanceof Apache_Solr_Document) $doc = $this->intoDocument($doc);
      $this->_instance->addDocument($doc);
      sfContext::getInstance()->getLogger()->info("{OpIndexManager::addDocument} aggiunto ".$doc->id);              
    } catch (Exception $e) {
      sfContext::getInstance()->getLogger()->info("{OpIndexManager::addDocument}: errore: " . $e->getMessage());
      throw new Exception ($e);                      
    }

  }

  /**
   * aggiunge un insieme di documenti
   *
   * @param docs_ar - array di Solr_Apache_Document
   * @return void
   * @author Guglielmo Celata
   **/
  public function addDocuments($docs_ar)
  {
    $this->_instance->addDocuments($docs_ar);
  }
  

  
  
  /**
   * trasforma un contenuto in un documento Apache_Solr_Document
   *
   * @return oggetto di tipo Apache_Solr_Document
   * @param $cont - il contenuto da aggiungere (ogg. di tipo OpPolitician, OpTag, OpDeclaration, OpComment)
   * @author Guglielmo Celata
   **/
  public function intoDocument( $cont )
  {

    $document = new Apache_Solr_Document();

    if ($cont instanceof OpPolitician)
    {
      $document->id = $cont->getContentId();
      $document->pol_id = $cont->getContentId();
      $document->type_us = "op_politician";
      $document->politician_name = $cont->getFirstName() . " " . $cont->getLastName();
      $document->politician_last_name = $cont->getLastName();
      $document->politician_first_name_us = $cont->getFirstName();
      $document->politician_sex_us = $cont->getSex();
      $last_institution_charge = $cont->fetch_current_institution_charges(true);
      if ($last_institution_charge instanceof OpInstitutionCharge)
        $document->politician_last_institutional_charge_us = strip_tags($last_institution_charge->chargeDefinition());
      if ($cont->getBirthDate())
        $document->pol_birth_date_dt = join("T", split(" ", $cont->getBirthDate())) . "Z";
    } else if ($cont instanceof OpTag) {
      $document->id = 200000000 + $cont->getId();
      $document->tag_id = $cont->getId();
      $document->tag = $cont->getTag();
      $document->type_us = "op_tag";      
    } else if ($cont instanceof OpDeclaration) {
      $document->id = 400000000 + $cont->getContentId();
      $document->declaration_id = $cont->getContentId();
      $document->declaration_title = $cont->getTitle();
      $document->declaration_text = $cont->getText();
      $document->declaration_relevancy_i = $cont->getRelevancyScore();
      $document->type_us = "op_declaration";
    } else if ($cont instanceof OpComment) {
      $document->id = 300000000 + $cont->getId();
      $document->comment_id = $cont->getId();
      $document->declaration_id = $cont->getContentId();
      $document->comment_body = $cont->getBody();
      $document->comment_relevancy_i = $cont->getRelevancyScoreUp() - $cont->getRelevancyScoreDown();
      $document->type_us = "op_comment";      
    } else if ($cont instanceof OpTheme) {
      $document->id = 500000000 + $cont->getContentId();
      $document->theme_id = $cont->getContentId();
      $document->theme_title = $cont->getTitle();
      $document->theme_description = $cont->getDescription();
      $document->theme_relevancy_i = $cont->getRelevancyScore();
      $document->type_us = "op_theme";
    }

    // ritorna il documento da aggiungere
    return $document;

  }
  
}