<?php

/**
 * Carts
 */
class CartItem extends Base {

    public $id = "cart_item_id";
    public $table = "cart_items";
    public $fields = array(
        "cart_item_id" => "int",
        "cart_id" => "int",
        "item_id" => "int",
        "deleted" => "string"
    );
    public $cart_item_id;
    public $cart_id;
    public $item_id;
    public $deleted = 0;

     public $item = null;

    const STATUS_NEW = 'new';

      public function getCartItemById($id) {

        return $this->getById($id);
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */





    public static function finder() {
        return new self ();
    }

    //----------------------------------------------------------------------------------------------------------------------
}

//class
?>
