<?php

/**
 * USER
 */
class Media extends Base {

    public $id = "media_id";
    public $table = "media";
    public $fields = array(
        "media_id" => "int",
        "product_id" => "int",
        "file_path" => "string",
        "type" => "string",
        "deleted" => "int"
    );
    public $product_id;
    public $media_id;
    public $file_path;
    public $type;
    public $deleted;

    public function getMedia() {

        return $this->get();
    }

    public function getMediaById($id) {

        return $this->getById($id);
    }

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

    public function findByProductID($product_id) {
        return parent::find("product_id = :product_id AND deleted = 0", array(":product_id" => $product_id));
    }

    public function findAllByProductID($product_id) {
        return parent::findAll("product_id = :product_id AND deleted = 0", array(":product_id" => $product_id));
    }

}

//class
?>
