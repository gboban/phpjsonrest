<?php

function make_request(/*str*/$method, /*str*/$base_url, /*str*/$resource_type, /*array*/$query_params, /*array*/$ws_params){
	$url = $base_url;
	$url .= "?resource_type=" . $resource_type . "";
	
	foreach($query_params as $key=>$value){
		$url .= "&" . $key . "=" . $value;
	}
	
	$data_array = $ws_params;
	$data = json_encode($data_array);
	
	// use key 'http' even if you send the request to https://...
	$options = array(
			'http' => array(
					'header'=>  "Content-Type: application/json\r\n" .
					"Accept: application/json\r\n",
					'method'  => $method,
					'content' => $data,
			),
	);
	$context  = stream_context_create($options);
print("Isuing: " . $method . "<br />" . $url . "<br />");
print($data);
	$result = file_get_contents($url, false, $context);
	var_dump($result);
	print("<hr />");
	$response = json_decode($result);
//	var_dump($response);

	return $response;
}

function get_contacts(){
	$query_params = array(
		'pattern' => "%",
		'first' => "0",
		'count' => "5"
	);
	
	$ws_params = array();
	
	$response = make_request(
			"GET",
			"http://localhost/omega/ws_json.php",
			"contact",
			$query_params,
			$ws_params
				
	);

print("<hr />==============================================================<hr />");
	var_dump($response);
print("<hr />==============================================================<hr />");
	return $response;
}

function get_contact(){
	$query_params = array(
			'id' => "2"
	);
	
	$ws_params = array();
	
	$response = make_request(
			"GET",
			"http://localhost/omega/ws_json.php",
			"contact",
			$query_params,
			$ws_params
	
	);
	
	print("<hr />==============================================================<hr />");
	var_dump($response);
	print("<hr />==============================================================<hr />");
	return $response;
	
}

print("<p />JSONClient TESTS<hr />");
print("<p />JSONClient get_contact<b>s</b><hr />");
get_contacts();

print("<p />JSONClient get_contact PUT<hr />");
//get_contact();
?>