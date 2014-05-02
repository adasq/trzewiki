<?php
/**
 * USER
 */
class ProductType extends Base
{

	public $id = "types_product_id";
	public $table= "types_products";
	public $fields = array(
		"types_product_id" => "int",
		"product_id" => "int",
		"type_id" => "int",
		"deleted" => "int"
	);
	
public $product_id;
public $type_id;
public $deleted;
public $types_product_id;
	

	public function __construct($obj = null)
	{
		 parent::__construct($obj);

	}

	
}//class
?>
