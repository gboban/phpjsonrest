<?php
require_once('json_interface.php');

$param_array = array();
$response_data = null;

$debug = "DBG:";

function get_request() {
	try{
		$contents = file_get_contents('php://input');
	}catch(Exception $e){
		$contents = "ERROR: file_get_contents() returns no data: " . $e->getMessage();
	}
	return $contents;
}

$anI = new JSONInterface();

$resource_type = null;
$id = null;

if(isset($_GET['resource_type'])){
	$resource_type = $_GET['resource_type'];
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$data = null;
try{
	$input = get_request();
	$data = json_decode($input);
}catch(Exception $e){
	$data = null;
}

$response_data = $anI->dispatch($_SERVER['REQUEST_METHOD'], $resource_type, $id, $_GET, $data);
if(($response_data == "null") || ($response_data == "false")){
	switch($_SERVER['REQUEST_METHOD']){
		case "GET":
		case "PUT":
		case "DELETE":
			header("HTTP/1.0 404 Not Found");
			break;
		case "POST":
			header("HTTP/1.0 404 Not Found");
	}
}
//print("<h1>response data</h1>");
//var_dump($response_data);
header('Content-Type: application/json');
if($response_data!=null){
	print($response_data);
}else{
	$response = json_encode(
			'{"method": "'.$_SERVER['REQUEST_METHOD'].'"'.
			' "DBG": "'.$debug.'"}'
			);
	print($response);
}
?>