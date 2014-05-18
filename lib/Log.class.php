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
        "custom3" => "string",
        "deleted" => "int"
    );
    public $log_id;
    public $admin_id = 'null';
    public $customer_id = 'null';
    public $action = '';
    public $custom1 = 'custom1';
    public $custom2 = 'custom2';
    public $custom3 = 'custom3';
    public $deleted = 0;

    public function __construct($obj = null) {

        parent::__construct($obj);
    }

    public function create() {
        $this->custom3 = date("Y-m-d H:i:s");

        $this->save();
    }

    public function getLogs() {

        $logs = $this->get();
        foreach ($logs as $key => $value) {
            $logs[$key]->custom3 = formatDate($logs[$key]->custom3);
        }

        return $logs;
    }

}

//class
?>
