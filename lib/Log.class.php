<?php

/**
 * USER
 */
class Log extends Base {

    public $id = "log_id";
    public $table = "logs";
    public $fields = array(
    "log_id" => "int",
    "admin_id" => "int",
    "customer_id" => "int",
    "action" => "string",
    "custom1" => "string",
    "custom2" => "string",
    "custom3" => "string"
    );
 public $log_id;
    public $admin_id= null;
    public $customer_id= null;
    public $action;
    public $custom1;
    public $custom2;
    public $custom3;


    public function __construct($obj = null) {
        parent::__construct($obj);
    }


    public function getLogs() {
        return $this->get();
    }

   


}

//class
?>
