<?php

/**
 * USER
 */
class Product extends Base {
    
    public $id = "product_id";
    public $table = "products";
    public $fields = array(
        "product_id" => "int",
        "manufacturer_id" => "int",
        "product_no" => "string",
        "name" => "string",
        "description" => "string",
        "status" => "string",
        "deleted" => "int"
    );
    public $product_id;
    public $manufacturer_id;
    public $product_no;
    public $name;
    public $description;
    public $status;
    public $deleted;
    
public $url = "";

    const STATUS_NEW = 'new';
    const STATUS_RECOMMENDED = 'recommended';
    const STATUS_SALE = 'sale';
    const STATUS_PROMOTION = 'promotion';

    public function getProducts() {

        return $this->get();
    }

    public function getProductById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

    public function findAllByManufacturerID($manufacturer_id, $sex) {
        return parent::findBySql("SELECT * FROM products p JOIN items i ON p.product_id = i.product_id AND i.deleted = 0 JOIN sizes s ON s.size_id = i.size_id AND s.sex = :sex AND s.deleted = 0 WHERE p.manufacturer_id = :manufacturer_id AND p.deleted = 0 GROUP BY p.product_id", array(":manufacturer_id" => $manufacturer_id, ":sex" => $sex));
    }

    public function findLatestProducts($limit = null) {
        $condition = "deleted = 0 AND product_id IN (SELECT product_id FROM items WHERE status = 'new' AND deleted = 0) ORDER BY product_id DESC";

        if ($limit !== null) {
            $condition.= " LIMIT " . $limit;
        }
        return parent::findAll($condition);
    }

    public function findRecommendedProducts($limit = null) {
        $condition = "deleted = 0 AND product_id IN (SELECT product_id FROM items WHERE status = 'recommended' AND deleted = 0) ORDER BY product_id DESC";

        if ($limit !== null) {
            $condition.= " LIMIT " . $limit;
        }
        return parent::findAll($condition);
    }

    //----------------------------------------------------------------------------------------------------------------------
}

//class
?>
