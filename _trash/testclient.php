<?php
$client = new SoapClient(null, array(
		'location' => "http://localhost/SOAPHelloWorldWS/soaptest.php",
		'uri'      => "http://localhost/SOAPHelloWorldWS/soaptest.php",
		'trace'    => 1 ));

echo $return = $client->__soapCall("Hello",array("ahoj!", 1, 2, "pero"));
?>