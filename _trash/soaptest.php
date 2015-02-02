<?php
require_once("model/wsinterface.php");

class CSoapTest{
	/**
	 * Returns hello message
	 *
	 * @param string $invar
	 * @return string
	 */
	public function hello($invar){
		return "Hello SOAP PHP my own... ugh...($invar)...?" . print_r(func_get_args(), true);
	}
}
//print("works!!!!<p />");

try{
	
	//print("Going to try<br />");
	$srv = new SoapServer(
		"http://localhost/SOAPHelloWorldWS/ws.php?wsdl", array('soap_version' => SOAP_1_1)
	);
	
	//print("Server created!<br />");
	$srv->setClass("WSInterface");
	
	//print("worked!!!<br />");
	$srv->handle();

}catch(Exception $e){
	//print("Failedd!!!<br />");
}

//print("EOP!!!!");

?>