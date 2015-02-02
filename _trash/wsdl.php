<?php
ini_set("soap.wsdl_cache_enabled", "0");
require_once ( 'php-wsdl-2.3/class.phpwsdl.php' );
try{
	PhpWsdl::RunQuickMode ( 
			array(
					'model/wsinterface.php',
					'model/contact.php',
					'model/phone.php'
			)
	);
}catch(Exception $e){
	print("Failed: " . $e->getMessage());
}
?>