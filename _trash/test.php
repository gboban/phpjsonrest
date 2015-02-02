<?php
/*
 * TESTCASE
 * - constructing wsImplementation() causes seg fault?
 */

print("<h2>TESTCASE: segfault in constructor this-&gt;var</h2>");
require_once("model/wsimplementation.php");
$wsi = new wsImplementation();
var_dump($wsi);
print("<p><b>was caused by:</b> assigning member variables in constructor?");
print("<h3>END TEST</h3>");


/*
 * TESTCASE
* - Database::getInstance() causes seg fault when called from wsImplementation?
*/
require_once("model/db.php");
print("<h2>TESTCASE 2: segfault in Database::get_instance()</h2>");
require_once("model/wsimplementation.php");
$db = Database::get_instance();
var_dump($db);
print("<p><b>was caused by: assigning member variables in constructor?</b>");
print("<h3>END TEST</h3>");

/*
 * TESTCASE
* - JSONInterface causes seg fault when constructed()
*/
print("<h2>TESTCASE 2: segfault in JSONInterface construction</h2>");
require_once("json_interface.php");
$i  = new JSONInterface();
var_dump($i);
print("<p><b>was caused by: assigning member variables in constructor?</b>");
print("<h3>END TEST</h3>");
?>