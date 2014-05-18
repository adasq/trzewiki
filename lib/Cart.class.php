<?php

/**
 * Carts
 */
class Cart extends Base {

    public $id = "cart_id";
    public $table = "carts";
    public $fields = array(
        "cart_id" => "int",
        "customer_id" => "int",
        "create_date" => "string",
        "status" => "string",
        "deleted" => "string"
    );
    public $cart_id;
    public $customer_id;
    public $create_date;
    public $status;
    public $deleted = 0;

    const STATUS_NEW = 'new';

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

    public function findCartByStatus($customer_id, $status) {
        return parent::find("customer_id = :customer_id AND status = :status AND deleted = 0", array(":customer_id" => $customer_id, ":status" => $status));
    }

    //----------------------------------------------------------------------------------------------------------------------
}

//class
?>
