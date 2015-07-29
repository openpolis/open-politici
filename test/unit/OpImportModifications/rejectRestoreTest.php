<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');


$t = new lime_test(6, new lime_output_color());
 
$t->diag('starting test');

// simulate old signin, so that sf_user can be safely passed to reject and restore methods
$sf_user = sfContext::getInstance()->getUser();
$user = OpUserPeer::retrieveByPK(1);
$sf_user->signIn($user);

// rimozione tutti i record dalla tabella 
OpImportModificationsPeer::doDeleteAll();

// read test op_import_similar record and add to DB (setup)
$recs = sfYaml::load(SF_ROOT_DIR.'/data/test/yml/op_import_modifications.yml');
$rec = $recs['OpImportModifications']['reg_new_1'];
$s = new OpImportModifications();
$s->fromArray($rec, BasePeer::TYPE_FIELDNAME);
$s->save();

// check blocked_at before rejection
$t->ok(is_null($s->getBlockedAt()), "record is not marked as blocked");

// user rejects record
$t->diag("user 1 blocks the test record");
$s->reject($sf_user);

// test record rejection
$t->is(date('U'), $s->getBlockedAt('U'), "record was blocked right now");
$t->ok(!is_null($s->getBlockedAt()), "record is marked as blocked");

// test existence of corresponding record in op_import_block
$c = new Criteria();
$c->add(OpImportBlockPeer::REC_TYPE, $s->getRecType());
$c->add(OpImportBlockPeer::CSV_REC, $s->getCsvRec());
$block_record = OpImportBlockPeer::doSelectOne($c);
$t->isa_ok($block_record, 'OpImportBlock', "corresponding record in op_import_block was found");

// user restore the record
$t->diag("user 1 restores the test record");
$s->restore($sf_user);

// test record restore
$t->ok(is_null($s->getBlockedAt()), "record is not marked as blocked");

// test non-existence of corresponding record in op_import_block
$c = new Criteria();
$c->add(OpImportBlockPeer::REC_TYPE, $s->getRecType());
$c->add(OpImportBlockPeer::CSV_REC, $s->getCsvRec());
$block_record = OpImportBlockPeer::doSelectOne($c);
$t->ok(is_null($block_record), "corresponding record in op_import_block was not found");

$t->diag('ending test');


