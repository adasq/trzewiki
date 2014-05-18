<?php

require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    if (isset($_SESSION['item_id']) && ($_POST['item_id'] == isset($_SESSION['item_id'])) && isset($_SESSION['cart_id'])) {
        $cart_item_rec = CartItem::finder()->find("item_id = :item_id AND deleted = 0", array(":item_id" => $_POST['item_id']));

        if ($cart_item_rec == null) {
            $cart_item_rec = new CartItem();
            $cart_item_rec->cart_id = $_SESSION['cart_id'];
            $cart_item_rec->item_id = $_SESSION['item_id'];

            if ($cart_item_rec->saveRecord()) {
                echo $_SERVER['HTTP_REFERER'];
            } else {
                echo 'retry';
            }
        } else {
            echo 'retry';
        }
    } else {
        echo 'retry';
    }
} else {
    echo 'need_login';
}
