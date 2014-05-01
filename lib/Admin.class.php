<?php
/**
 * USER
 */
class Admin extends Base
{

	public $id = "admin_id";
	public $table= "admins";
public $fields = array(	
"admin_id" => "int",
"login" => "string",
"first_name" => "string",
"last_name" => "string",
"password" => "string"
);

public $admin_id;
public $login;
public $password;
public $first_name;
public $last_name;

	public function getAdmins(){

		return $this->get();		

	}

	public function getAdminById($id){

		return $this->getById($id);
		
	} 

	public function __construct($obj = null)
	{
		 parent::__construct($obj);

	}
	
	//----------------------------------------------------------------------------------------------------------------------
}//class
?>
