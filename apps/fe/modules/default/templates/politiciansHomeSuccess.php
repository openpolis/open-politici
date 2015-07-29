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
<?php use_helper('Validation', 'Javascript', 'Object'
/* canonicals links */
, 'HeaderLinks'); 

if ( sfRouting::getInstance()->getCurrentRouteName() == 'politici' )
	add_link('@politici_new', 'canonical'); 
	
?>

<div id="title">
  <em></em>
  <h1>Tutti i politici italiani eletti</h1>
</div>

<hr />

<div class="genericblock">
In questa pagina puoi trovare in vari modi tutti gli oltre 130mila politici italiani eletti dal pi&ugrave; piccolo comune fino al Parlamento Europeo.
</div>

<br />

<div class="genericblock">
<div class="header">
    <h2>Cerca un politico per nome</h2>
</div>
<div class="nuvola">
    <?php echo form_tag('default/choice1', array('id'=>'politician_search_form', 'name'=>'politician_search_form')) ?>
	<?php echo form_error('politician') ?><br />
	<?php echo include_partial('autocompleter/politicianAutocompleter') ?>
      <input id="Submit" class="cerca" type="submit" value="Cerca" name="Submit" />
    </form>
</div>
</div>
<div class="orisep">&nbsp;</div>


<div id="title">
  <em></em>
  <h1>Trova i politici per istituzione</h1>
</div>
<hr />

<div class="genericblock">
  <ul>
    <li class="dark">
	  <strong>	
        <?php echo link_to(__('Commissari ('.$numero_commissari_europei.')') , '@politico_new?content_id=332752&slug=federica-mogherini-rebesani') ?> 
        <?php echo "&nbsp;e&nbsp;" ?>
        <?php echo link_to(__('Parlamentari europei ('.$numero_parlamentari_europei.')') , '@istituzione_new?slug=parlamentari-europei&id='.sfConfig::get('app_institution_id_PE')) ?>
      </strong>
    </li>
    <li class="light">
      <strong>    	
		<?php echo link_to('Presidente della Repubblica' , '@politico_new?content_id=549&slug=sergio-mattarella') ?>
      </strong>
    </li>   
    <li class="dark">
      <strong>    	
		    <?php echo link_to('Membri del Governo ('.($numero_membri_governo).')' , '@istituzione_new?slug=governo-ministri-e-sottosegretari&id='.sfConfig::get('app_institution_id_GI')) ?>
      </strong>     
	  </li>
    <li class="light">
      <strong>    		
		    <?php echo link_to(__('Senatori ('.$numero_senatori.')') , '@istituzione_new?slug=senatori&id='.sfConfig::get('app_institution_id_SR')) ?>
      </strong>    
	  </li>
	  <li class="dark">
      <strong>    	
		    <?php echo link_to(__('Deputati ('.$numero_deputati.')') , '@istituzione_new?slug=deputati&id='.sfConfig::get('app_institution_id_CD')) ?>
      </strong>    
	</li>
  </ul>	
</div>
<hr />
<div class="orisep">&nbsp;</div>
<div class="genericblock">
  <div class="header">
    <a name="regione"></a>
    <h2><?php echo __('Membri di Giunte e Consigli Regionali') ?>&nbsp;(<?php echo $numero_membri_giunte_regionali.'&nbsp;+&nbsp;'.$numero_membri_consigli_regionali ?>)</h2>
  </div>
  <div class="nuvola">
    <?php foreach ($regions as $region): ?>
    <?php $c = new Criteria();
    $c->clearSelectColumns();
          $c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GR'), Criteria::EQUAL);
          $c->Add(OpInstitutionChargePeer::LOCATION_ID, $region->GetId(), Criteria::EQUAL);
          $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
          $c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
          $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
          $c->addSelectColumn(OpInstitutionChargePeer::POLITICIAN_ID);
          $c->setDistinct();
          $numero_membri_giunta = OpInstitutionChargePeer::doSelectRS($c)->getRecordCount();
          
          $c = new Criteria();
          $c->clearSelectColumns();
          $c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CR'), Criteria::EQUAL);
          $c->Add(OpInstitutionChargePeer::LOCATION_ID, $region->GetId(), Criteria::EQUAL);
          $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
          $c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
          $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
          $c->addSelectColumn(OpInstitutionChargePeer::POLITICIAN_ID);
          $c->setDistinct();
          $numero_membri_consiglio = OpInstitutionChargePeer::doSelectRS($c)->getRecordCount();
    ?> 
	<?php echo link_to($region->GetName().'&nbsp;('.$numero_membri_giunta.'+'.$numero_membri_consiglio.')','@regione_new?location_id='.$region->GetId().'&slug='. $region->getSlug() ); ?>
	 | 
	<?php endforeach; ?>	
  </div>
</div>  
<hr />
<div class="orisep">&nbsp;</div>
<div class="genericblock">
  <div class="header">
    <a name="provincia"></a>
    <h2><?php echo __('Membri di Giunte e Consigli Provinciali') ?>&nbsp;(<?php echo $numero_membri_giunte_provinciali.'&nbsp;+&nbsp;'.$numero_membri_consigli_provinciali ?>)</h2>
  </div>
  <div class="nuvola">
    <?php foreach ($provincials as $provincial): ?>
      <?php	$c = new Criteria();
            $c->clearSelectColumns();
            $c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GP'), Criteria::EQUAL);
            $c->Add(OpInstitutionChargePeer::LOCATION_ID, $provincial->GetId(), Criteria::EQUAL);
            $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
            $c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
            $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
            $c->addSelectColumn(OpInstitutionChargePeer::POLITICIAN_ID);
            $c->setDistinct();
            $numero_membri_giunta2 = OpInstitutionChargePeer::doSelectRS($c)->getRecordCount();
			      
            $c = new Criteria();
            $c->clearSelectColumns();
            $c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CP'), Criteria::EQUAL);
            $c->Add(OpInstitutionChargePeer::LOCATION_ID, $provincial->GetId(), Criteria::EQUAL);
            $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
            $c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
            $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
            $c->addSelectColumn(OpInstitutionChargePeer::POLITICIAN_ID);
            $c->setDistinct();
            $numero_membri_consiglio2 = OpInstitutionChargePeer::doSelectRS($c)->getRecordCount();
     ?>
     <?php echo link_to($provincial->GetName().'&nbsp;('.$numero_membri_giunta2.'+'.$numero_membri_consiglio2.')','@provincia_new?location_id='.$provincial->GetId() .'&slug='. $provincial->getSlug()); ?>
     |
   <?php endforeach; ?>	
  </div>
</div>
<hr />
<div class="orisep">&nbsp;</div>
<div class="genericblock">
  <div class="header">
    <a name="comune"></a>
    <h2><?php echo __('Membri di Giunte e Consigli Comunali') ?>&nbsp;(<?php echo $numero_membri_giunte_comunali.'&nbsp;+&nbsp;'.$numero_membri_consigli_comunali ?>)</h2>
  </div>
  <div class="nuvola">
    <?php echo form_tag('default/choice3', array('id'=>'location_search_form', 'name'=>'location_search_form')) ?>
      <?php echo include_partial('autocompleter/locationAutocompleter', array('value'=>'Inserisci il comune')) ?>
      <input id="Submit" class="cerca" type="submit" value="Cerca" name="Submit" />
    </form>
  </div>
</div>
<br />
