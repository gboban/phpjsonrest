<?php


if(isset($_GET['resource_type'])){
	$param_array['resource_type'] = $_GET['resource_type'];
}else{
	$param_array['resource_type'] = null;
}

if(isset($_GET['id'])){
	$param_array['id'] = $_GET['id'];
}else{
	$param_array['id'] = null;
}

if(isset($_GET['cid'])){
	$param_array['cid'] = $_GET['cid'];
}else{
	$param_array['cid'] = null;
}

if(isset($_GET['pattern'])){
	$param_array['pattern'] = $_GET['pattern'];
}else{
	$param_array['pattern'] = null;
}

if(isset($_GET['first'])){
	$param_array['first'] = $_GET['first'];
}else{
	$param_array['first'] = null;
}

if(isset($_GET['count'])){
	$param_array['count'] = $_GET['count'];
}else{
	$param_array['count'] = null;
}

if($_SERVER['REQUEST_METHOD']=="GET"){
	if($param_array['pattern']!=null){
		$response_data = $anI->get_contacts(
				array(
						'pattern'=>$param_array['pattern'],
						'first'=>$param_array['first'],
						'count'=>$param_array['count']
				)
		);
	}elseif($param_array['id']!=null){
		$response_data = $anI->get_contact($param_array);
	}else{
		// invalid request
	}
}elseif($_SERVER['REQUEST_METHOD']=="DELETE"){

	// delete resource - we expect id in param_array
	if($param_array['id']!=null){
		$response_data = $anI->delete_contact($param_array);
		if(!$response_data){
			// error not found
		}
	}else{
		// invalid request
	}
}elseif($_SERVER['REQUEST_METHOD']=="POST"){
	// add new resource (can be contact or phone)
	// we should get json data
	$input = get_request();
	$data = json_decode($input);
	//var_dump($data);
	$response_data = $anI->add_contact(
			$data
	);
	if(!$response_data){
		// error executing sql
	}


}elseif($_SERVER['REQUEST_METHOD']=="PUT"){
	// update resource - we expect id param in param_array
	// json data expected
	$input = get_request();
	$data = json_decode($input);
	if($param_array['id']!=null){
		$response_data = $anI->update_contact(
				$param_array['id'],
				$data
		);
		if(!$response_data){
			// error executing sql
		}
	}else{
		// invalid request
	}
}else{
	// don't understand the verb.... exit with some error
}
?>