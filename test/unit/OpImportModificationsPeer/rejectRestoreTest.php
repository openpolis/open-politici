<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(6, new lime_output_color());
$t->diag('starting test');

// simulate old signin, so that sf_user can be safely passed to reject and restore methods
$sf_user = sfContext::getInstance()->getUser();
$user = OpUserPeer::retrieveByPK(1);
$sf_user->signIn($user);

// dummy invocation, in order to have loadData work properly
// by loading OpLocation into the DatabaseMap (weird behavior)
$location = OpLocationPeer::retrieveByPK(1);

// reset auto_increment to 1 for op_import_similar
echo exec('mysql -uroot op_openpolis_test -e"delete from op_import_modifications; delete from op_import_block; alter table op_import_modifications AUTO_INCREMENT=1"');

// load all test records from yml file
$sf_data = new sfPropelData();
$sf_data->loadData(SF_ROOT_DIR.'/data/test/yml/op_import_modifications.yml');

$t->diag("user rejects items 1, 2, 3");
OpImportModificationsPeer::doReject(array(1, 2, 3), $sf_user);

// verify the number of rejected items
$c = new Criteria();
$c->add(OpImportModificationsPeer::BLOCKED_AT, null, Criteria::ISNOTNULL);
$rej_recs = OpImportModificationsPeer::doSelect($c);
$t->is(count($rej_recs), 3, "three items were rejected");

// verify the identity of rejected status
$ids = array();
foreach($rej_recs as $rec)
  $ids []= $rec->getId();  
$t->is_deeply($ids, array(1, 2, 3), "the three correct items were rejected");

// test existence of corresponding records in op_import_block
$c = new Criteria();
$n_blocked_records = OpImportBlockPeer::doCount($c);
$t->is($n_blocked_records, 3, "corresponding records in op_import_block were found");


$t->diag("user restores items 1, 3");
OpImportModificationsPeer::doRestore(array(1, 3));

// verify the number of rejected items
$c = new Criteria();
$c->add(OpImportModificationsPeer::BLOCKED_AT, null, Criteria::ISNOTNULL);
$rej_recs = OpImportModificationsPeer::doSelect($c);
$t->is(count($rej_recs), 1, "three is now only one item rejected");

// verify the identity of rejected status
$ids = array();
foreach($rej_recs as $rec)
  $ids []= $rec->getId();  
$t->is_deeply($ids, array(2), "the rejected item left is the correct one");


// test existence of corresponding records in op_import_block
$c = new Criteria();
$n_blocked_records = OpImportBlockPeer::doCount($c);
$t->is($n_blocked_records, 1, "one corresponding record in op_import_block left");

$t->diag('ending test');


