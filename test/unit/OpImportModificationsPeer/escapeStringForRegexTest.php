<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(15, new lime_output_color());
$t->diag('starting test');

$chars = array("\\", "/", "^", ".", "$", "|", "(", ")", "[", "]", "*", "+", "?", "{", "}");
$expected_chars = array("\\", "\/", "\^", "\.", "\$", "\|", "\(", "\)", "\[", "\]", "\*", "\+", "\?", "\{", "\}");

foreach ($chars as $cnt => $c) {
  $t->is(OpImportModificationsPeer::escapeStringForRegex($c), $expected_chars[$cnt]);
}

$t->diag('ending test');
