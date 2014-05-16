<?php

/**
 * USER
 */
class Type extends Base {

    public $id = "type_id";
    public $table = "types";
    public $fields = array(
        "type_id" => "int",
        "type_name" => "string",
        "deleted" => "int"
    );
    public $type_id;
    public $type_name;
    public $deleted;

    const FOOT_NEUTRAL = 'foot_neutral';
    const FOOT_SUPINATION = 'foot_supination';
    const FOOT_PRONATION = 'foot_pronation';
    const SHOE_RACE = 'shoe_race';
    const SHOE_TRAINING = 'shoe_training';
    const SHOE_ROAD = 'shoe_road';
    const SHOE_TERRAIN = 'shoe_terrain';

    public function getTypes() {

        return $this->get();
    }

    public function getTypeById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

    public function findAllByProductID($product_id) {
        return parent::findBySql("SELECT * FROM types WHERE type_id IN (SELECT type_id FROM types_products WHERE product_id = :product_id AND deleted = 0) AND deleted = 0", array(":product_id" => $product_id));
    }

}

//class
?>
