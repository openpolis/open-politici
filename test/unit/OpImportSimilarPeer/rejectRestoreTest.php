<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(4, new lime_output_color());
$t->diag('starting test');

// simulate old signin, so that sf_user can be safely passed to reject and restore methods
$sf_user = sfContext::getInstance()->getUser();
$user = OpUserPeer::retrieveByPK(1);
$sf_user->signIn($user);

// dummy invocation, in order to have loadData work properly
// by loading OpLocation into the DatabaseMap (weird behavior)
$location = OpLocationPeer::retrieveByPK(1);

// reset auto_increment to 1 for op_import_similar
echo exec('mysql -uroot op_openpolis_test -e"delete from op_import_similar; alter table op_import_similar AUTO_INCREMENT=1"');

// load all test records from yml file
$sf_data = new sfPropelData();
$sf_data->loadData(SF_ROOT_DIR.'/data/test/yml/op_import_similar.yml');

$t->diag("user rejects items 1, 2, 3");
OpImportSimilarPeer::doReject(array(1, 2, 3), $sf_user);

// verify the number of rejected items
$c = new Criteria();
$c->add(OpImportSimilarPeer::DELETED_AT, null, Criteria::ISNOTNULL);
$rej_recs = OpImportSimilarPeer::doSelect($c);
$t->is(count($rej_recs), 3, "three items were rejected");

// verify the identity of rejected status
$ids = array();
foreach($rej_recs as $rec)
  $ids []= $rec->getId();  
$t->is_deeply($ids, array(1, 2, 3), "the three correct items were rejected");


$t->diag("user restores items 1, 3");
OpImportSimilarPeer::doRestore(array(1, 3));

// verify the number of rejected items
$c = new Criteria();
$c->add(OpImportSimilarPeer::DELETED_AT, null, Criteria::ISNOTNULL);
$rej_recs = OpImportSimilarPeer::doSelect($c);
$t->is(count($rej_recs), 1, "three is only one item rejected");

// verify the identity of rejected status
$ids = array();
foreach($rej_recs as $rec)
  $ids []= $rec->getId();  
$t->is_deeply($ids, array(2), "the rejected item left is the correct one");


$t->diag('ending test');


