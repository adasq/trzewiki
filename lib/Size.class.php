<?php

/**
 * USER
 */
class Size extends Base {

    public $id = "size_id";
    public $table = "sizes";
    public $fields = array(
        "size_id" => "int",
        "manufacturer_id" => "int",
        "us" => "string",
        "uk" => "string",
        "cm" => "string",
        "euro" => "string",
        "sex" => "string",
        "deleted" => "int"
    );
    public $size_id;
    public $manufacturer_id;
    public $us;
    public $uk;
    public $cm;
    public $euro;
    public $sex;
    public $deleted;

    public $manufacturer = null;

    public function getSizes() {

        return $this->get();
    }

    public function getSizeById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

}

//class
?>
