<?php
class Alert
{		 
	public $text;
	public $type;	
	public function __construct($type, $text)
	{
		$this->text = $text;
		$this->type = $type;
	}//__construct	
}//alert
?>
