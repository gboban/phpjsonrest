<?php
require_once("db.php");

$mydb = Database::getInstance();
print("Got db instance<p />");
//print($mydb);
$rows = $mydb->query("SELECT * FROM contact");
print("Got rows:<br />");
print_r($rows);
print("<p />");

$result = $mydb->execute("INSERT INTO contact (contact_name, contact_surname, contact_description, contact_imgpath) VALUES('pero', 'peric', 'onaj testni pero', '/imgs/')");
print("Got result:<br />");
print($result);
print("<p />");

$rows = $mydb->query("SELECT * FROM contact");
print("Got rows(2):<br />");
print_r($rows);
print("<p />");
?>