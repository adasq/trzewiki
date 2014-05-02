<?php
/**
 * USER
 */
class Type extends Base
{
	
 
	public $id = "type_id";
	public $table= "types";
	public $fields = array(
		"type_id" => "int",
		"type_name" => "string",
		"deleted" => "int"
	);
	
public $type_id;
public $type_name;
public $deleted;



	public function getTypes(){

		return $this->get();		

	}

	public function getTypeById($id){

		return $this->getById($id);
		
	}


	

	public function __construct($obj = null)
	{
		 parent::__construct($obj);

	}

	
}//class
?>
