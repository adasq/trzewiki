<?php

/**
 * USER
 */
class Manufacturer extends Base {

    public $id = "manufacturer_id";
    public $table = "manufacturers";
    public $fields = array(
        "manufacturer_id" => "int",
        "name" => "string",
        "deleted" => "int"
    );
    public $manufacturer_id;
    public $name;
    public $deleted;

    public function getManufacturers() {

        return $this->get();
    }

    public function getManufacturerById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }
    
    public function findAll($condition = null, $parameters = null) {
        return parent::findAll($condition, $parameters);
    }

}

//class
?>
