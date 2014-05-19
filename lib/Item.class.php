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
        "deleted" => "int",
    );
    public $item_id;
    public $product_id;
    public $size_id;
    public $price;
    public $price2;
    public $deleted;

    public function getItems() {

        return $this->get();
    }

    public function getItemById($id) {

        return $this->getById($id);
    }
    public function getItemByIdWithDeleted($id) {

        return $this->getById($id, true);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

    public function findAllByProductID($product_id) {
        return parent::findAll("product_id = :product_id AND deleted = 0", array(":product_id" => $product_id));
    }

    public function findAllSizes($product_id) {
        $query = "SELECT items.*, sizes.* FROM items LEFT JOIN sizes ON items.size_id = sizes.size_id AND sizes.deleted = 0 WHERE items.deleted = 0 AND product_id = :product_id AND NOT EXISTS (SELECT * FROM cart_items WHERE item_id = items.item_id AND deleted = 0) GROUP BY sizes.size_id ORDER BY sizes.us ASC";
        return parent::findBySql($query, array(":product_id" => $product_id));
    }

//    public function findAllPrices($product_id) {
//        $query = "SELECT items.* FROM items WHERE items.deleted = 0 AND items.product_id = :product_id GROUP BY items.price ORDER BY items.price ASC";
//        return parent::findBySql($query, array(":product_id" => $product_id));
//    }

}

//class
?>
