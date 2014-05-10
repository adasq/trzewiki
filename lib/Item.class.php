<?php

/**
 * USER
 */
class Item extends Base {

    public $id = "item_id";
    public $table = "items";
    public $fields = array(
        "item_id" => "int",
        "product_id" => "int",
        "size_id" => "int",
        "price" => "int",
        "price2" => "int",
        "status" => "int",
        "deleted" => "int",
    );
    public $item_id;
    public $product_id;
    public $size_id;
    public $price;
    public $price2;
    public $status;
    public $deleted;

    public function getItems() {

        return $this->get();
    }

    public function getItemById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

}

//class
?>
