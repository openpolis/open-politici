<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(2, new lime_output_color());
$t->diag('starting test');

// dummy invocation, in order to have loadData work properly
// by loading OpLocation and OpUserPeer into the DatabaseMap (weird behavior)
$location = OpLocationPeer::retrieveByPK(1);
$user = OpUserPeer::retrieveByPK(1);

// reset auto_increment to 1 for op_import_similar
echo exec('mysql -uroot op_openpolis_test -e"delete from op_import_similar; alter table op_import_similar AUTO_INCREMENT=1"');

// load all test records from yml file
$sf_data = new sfPropelData();
$sf_data->loadData(SF_ROOT_DIR.'/data/test/yml/op_import_similar.yml');

// verify the contexts returned
$t->diag("building context selector");
$expected_contexts = array(
  '' => 'qualsiasi',
  'reg' => 'regioni',
  'prov' => 'provincie',
  'com.001' => 'comuni di Agrigento'
);
$contexts = OpImportSimilarPeer::getDistinctContexts();
$t->is_deeply($contexts, $expected_contexts, "contexts extracted correctly");


// verify the locations returned
$t->diag("building context selector");
$expected_locations = array(
  '' => 'qualsiasi',
  '80' => 'Roma',
  '53' => 'Gorizia',
  '28' => 'Alessandria'
);
$locations = OpImportSimilarPeer::getDistinctLocationsIdsWithNames('prov');
$t->is_deeply($locations, $expected_locations, "locations extracted correctly");



$t->diag('ending test');


