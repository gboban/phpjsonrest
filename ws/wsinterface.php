<?php
/*
 * NOTEs:
 * 	- annotations are for php2wsdl
 */
require_once("model/wsimplementation.php");

class WSInterface{
	private $_impl;
	
	function __construct(){
		$this->_impl = new wsImplementation();
	}
	
	function __destruct(){
		// may need to free $_impl
	}
	
	/**
	 * returns an contact by id
	 *
	 * @param int $id
	 * @param int $first
	 * @param int $count
	 * @return Contact
	 */
	public function get_contact($id, $first, $count){
		return $this->_impl->get_contact($id, $first, $count);
	}
	
	/**
	 * returns array of contacts depending on $pattern
	 *
	 * @param string $pattern
	 * @return ContactList
	 */
	public function get_contacts($pattern){
		return $this->_impl->get_contacts($pattern);
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
	public function add_contact($name, $surname, $desc, $imgpath){
		return $this->_impl->add_contact(
			$name,
			$surname,
			$desc,
			$imgpath
		);
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
	public function update_contact($id, $name, $surname, $desc, $imgpath){
		return $this->_impl->update_contact(
			$id,
			$name,
			$surname,
			$desc,
			$imgpath		
		);
	}
	
	/**
	 * deletes contact
	 *
	 * @param integer $id
	 * @return boolean
	 */
	public function delete_contact($id){
		return $this->_impl->delete_contact($id);
	}
	
	/**
	 * gets phones for the contact
	 *
	 * @param integer $contact_id
	 * @return PhoneList
	 */
	public function get_phones($contact_id){
		return $this->_impl->get_phones($contact_id);
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
	public function add_phone($contact_id, $type_id, $phone, $comment){
		return $this->_impl->add_phone(
			$contact_id,
			$type_id,
			$phone,
			$comment		
		);
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
	public function update_phone($id, $type_id, $phone, $comment){
		return $this->_impl->update_phone(
			$id,
			$this_id,
			$phone,
			$comment	
		);
	}
	
	/**
	 * adds phone to the contact
	 *
	 * @param integer $id
	 * @return boolean
	 */
	public function delete_phone($id){
		return $this->_impl->delete_phone($id);
	}
}