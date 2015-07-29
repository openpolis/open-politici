<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(3, new lime_output_color());
$t->diag('starting test');

// reset auto_increment to 1 for op_import_similar
echo exec('mysql -uroot op_openpolis_test -e"delete from op_import_modifications; delete from op_import_block; alter table op_import_modifications AUTO_INCREMENT=1"');

// dummy invocation, in order to have loadData work properly
// by loading OpLocation into the DatabaseMap (weird behavior)
$location = OpLocationPeer::retrieveByPK(1);

// load all test records from yml file
$sf_data = new sfPropelData();
$sf_data->loadData(SF_ROOT_DIR.'/data/test/yml/op_import_modifications.yml');

$t->diag("test wrong parameter");
try {
  $res = OpImportModificationsPeer::getByRecTypeContextLocationId('niii');
  $t->fail("wrong parameter should throw an exception");
} catch (Exception $e) {
  $t->pass("wrong parameter throws an exception");
}

$t->diag("select all new records");
$res = OpImportModificationsPeer::getByRecTypeContextLocationId('new');
$t->ok(count($res), 6);

$t->diag("select all old records");
$res = OpImportModificationsPeer::getByRecTypeContextLocationId('old');
$t->ok(count($res), 6);


$t->diag('ending test');


