<?php
/*
 * NOTEs:
 * 	- annotations are for php2wsdl if required
 */
require_once("model/wsimplementation.php");

class JSONInterface{
	private $_impl;
	
	protected function get_impl(){
		if(!$this->_impl){
			$this->_impl = new wsImplementation();
		}
		
		return $this->_impl;
	}
	
	/*
	 * Dispatch request handler (dispatch) & helpers dispatch_<verb>
	*
	* param $method [GET, PUT, POST, DELETE]
	* param $resource_type
	* param $id
	* param $param - request parameters (get vars)
	* param data $data - decoded JSON data posted in request
	*/
	protected function dispatch_get($resource_type, $id, $param, $data){
		$result = null;
		if($resource_type=='contact'){
			if($id!=null){
				// get object
				$result = $this->get_contact($id);
			}else{
				// get array of objects
				$result = $this->get_contacts($param);

			}
		}elseif($resource_type=='phone'){
			if(isset($param['contact_id'])){
				$contact_id = $param['contact_id'];
				// get phones - $id represents contact id
				$result = $this->get_phones($contact_id);
			}
		}
	
		return $result;
	}
	
	protected function dispatch_delete($resource_type, $id, $param, $data){
		$result = null;
	
		if($resource_type == 'contact'){
			if($id != null){
				$result = $this->delete_contact($id);
			}
		}elseif($resource_type == 'phone'){
			if($id != null){
				$result = $this->delete_phone($id);
			}
		}
	
		return $result;
	}
	
	protected function dispatch_put($resource_type, $id, $param, $data){
		$result = null;
	
		if($resource_type == 'contact'){
			if($id != null){
				$result = $this->update_contact($id, $data);
			}
		}elseif($resource_type == 'phone'){
			if($id != null){
				$result = $this->update_phone($id, $data);
			}
		}
	
		return $result;
	}
	
	protected function dispatch_post($resource_type, $id, $param, $data){
		$result = null;
	
		if($resource_type == 'contact'){
			$result = $this->add_contact($data);
		}elseif($resource_type == 'phone'){
			if(isset($data->contact_id)){
				$result = $this->add_phone($data);
			}
		}
	
		return $result;
	}
	
	public function dispatch($method, $resource_type, $id, $param, $data){
		switch($method){
			case "GET":
				$result = $this->dispatch_get($resource_type, $id, $param, $data);
				break;
			case "DELETE":
				$result = $this->dispatch_delete($resource_type, $id, $param, $data);
				break;
			case "PUT":
				$result = $this->dispatch_put($resource_type, $id, $param, $data);
				break;
			case "POST":
				$result = $this->dispatch_post($resource_type, $id, $param, $data);
				break;
			default:
				trigger_error(
				"Unknown verb... " . $method,
				E_USER_ERROR
				);
		}
		
		return $result;
	}
	
	/**
	 * returns an contact by id
	 *
	 * @param int $id
	 * @param int $first
	 * @param int $count
	 * @return Contact
	 */
	public function get_contact($id){
		$result = $this->get_impl()->get_contact($id);
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * returns array of contacts depending on $pattern
	 *
	 * @param string $pattern
	 * @return ContactList
	 */
	public function get_contacts($args){
		$json = "";
		$result = $this->get_impl()->get_contacts(
				$args['pattern'],
				$args['first'],
				$args['count']
		);

		$json = json_encode($result);
		return $json;
	}

	/**
	 * adds new contact to the database and returns its id
	 *
	 * @param string $name
	 * @param string $surname
	 * @param string $desc
	 * @param string $imgpath
	 * @return integer
	 */
	public function add_contact($args){
		$result = $this->get_impl()->add_contact(
			$args->contact_name,
			$args->contact_surname,
			$args->contact_city,
			$args->contact_desc,
			$args->contact_imgpath
		);
		
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * updates contact
	 *
	 * @param integer $id
	 * @param string $name
	 * @param string $surname
	 * @param string $desc
	 * @param string $imgpath
	 * @return boolean
	 */
	public function update_contact($id, $args){
		$result = $this->get_impl()->update_contact(
			$id,
			$args->contact_name,
			$args->contact_surname,
			$args->contact_city,
			$args->contact_desc,
			$args->contact_imgpath		
		);

		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * deletes contact
	 *
	 * @param integer $id
	 * @return boolean
	 */
	public function delete_contact($id){
		$result = $this->get_impl()->delete_contact($id);
		
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * gets phones for the contact
	 *
	 * @param integer $contact_id
	 * @return PhoneList
	 */
	public function get_phones($contact_id){
		$result = $this->get_impl()->get_phones($contact_id);
		
		$json = json_encode($result);
		return $json;
	}

	/**
	 * adds phone to the contact
	 *
	 * @param integer $contact_id
	 * @param integer $type_id
	 * @param string $phone
	 * @param string $comment
	 * @return boolean
	 */
	public function add_phone($args){
		$result = $this->get_impl()->add_phone(
			$args->contact_id,
			(isset($args->type_id))? $args->type_id : 0,
			$args->phone_number,
			$args->phone_comment		
		);
		
		$json = json_encode($result);
		return $json;
	}

	/**
	 * updates phone to the contact
	 *
	 * @param integer $id
	 * @param integer $contact_id
	 * @param integer $type_id
	 * @param string $phone
	 * @param string $comment
	 * @return boolean
	 */
	public function update_phone($id, $args){
		$result = $this->get_impl()->update_phone(
			$id,
			$args->contact_id,
			(isset($args->type_id))? $args->type_id : 0,
			$args->phone_number,
			$args->phone_comment	
		);
		
		$json = json_encode($result);
		return $json;
	}
	
	/**
	 * adds phone to the contact
	 *
	 * @param integer $id
	 * @return boolean
	 */
	public function delete_phone($id){
		$result = $this->get_impl()->delete_phone($id);
		
		$json = json_encode($result);
		return $json;
	}
}