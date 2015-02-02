<?php
require("phone.php");
/**
 * Contacts
 *
 * @pw_complex ContactList An array of Contact
 */
/**
 * Contact
 *
 * @pw_element string $id
 * @pw_element string $name
 * @pw_element string $surname
 * @pw_element string $desc
 * @pw_element string $imgpath
 *
 * @pw_complex Contact End the definition+
 */
class Contact{
	public $name;
	public $surname;
	public $desc;
	public $imgpath;
	
	/**
	 * gets phones for the contact
	 *
	 * @param integer $par
	 * @return integer
	 */
	public function aetF($par){
		return null;
	}
}
?>