<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');


$t = new lime_test(3, new lime_output_color());
 
$t->diag('starting test');

// rimozione tutti i record dalla tabella 
OpImportSimilarPeer::doDeleteAll();

// lettura record di op_import_similar da testare
$recs = sfYaml::load(SF_ROOT_DIR.'/data/test/yml/op_import_similar.yml');
$rec = $recs['OpImportSimilar']['reg_3_1'];

// aggiunta di un record
$s = new OpImportSimilar();
$s->fromArray($rec, BasePeer::TYPE_FIELDNAME);
$s->save();
$t->is($s->getNewCsvRec(), '01|PIEMONTE|ARTESIO|ELEONORA LUIGIA|F|29/07/1954|TORINO (TO)|Consigliere', 'test record inserted');


// tentativo di aggiunta del record per una seconda volta
try {
  $s2 = new OpImportSimilar();
  $s2->fromArray($rec, BasePeer::TYPE_FIELDNAME);
  $s2->save();
  $t->fail("same record was inserted twice, unique index violated. Check DB schema.");
} catch (PropelException $e) {
  $t->pass("unique index was enforced. Insertion stopped.");  
}


// rimozione del record
try {
  $s->delete();
  $t->pass("record deleted successfully");
} catch (Exception $e) {
  $t->fail("error while removing record: $e");
}


$t->diag('ending test');


