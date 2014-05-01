<?php
/**
 * USER
 */
class Product extends Base
{

	public $id = "product_id";
	public $table= "products";
	public $fields = array(
		"product_id" => "int",
		"manufacturer_id" => "int",
		"product_no" => "string",
		"name" => "string",
		"description" => "string",
		"deleted" => "int"
	);
	
public $product_id;
public $manufacturer_id;
public $product_no;
public $name;
public $description;
public $deleted;


	public function getProducts(){

		return $this->get();		

	}

	public function getProductById($id){

		return $this->getById($id);
		
	}


	

	public function __construct($obj = null)
	{
		 parent::__construct($obj);

	}
	
	//----------------------------------------------------------------------------------------------------------------------
}//class
?>
