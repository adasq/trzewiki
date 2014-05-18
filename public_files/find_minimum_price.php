<?php

require_once 'theme/config.php';

if (isset($_POST['available_sizes'])) {
    $query = "SELECT MIN(COALESCE(price2, price)) as price, i.item_id FROM items i JOIN products p ON p.product_id = i.product_id AND p.product_id = :product_id AND p.deleted = 0 JOIN sizes s ON s.size_id = i.size_id AND s.size_id = :size_id AND s.deleted = 0 WHERE i.deleted = 0  AND NOT EXISTS (SELECT * FROM cart_items WHERE item_id = i.item_id AND deleted = 0)";
    $item_rec = Item::finder()->findBySql($query, array(":product_id" => $_POST['product_id'], ":size_id" => $_POST['available_sizes']));

    if ($item_rec != null) {
        $_SESSION['item_id'] = $item_rec[0]->item_id;
        echo $item_rec[0]->item_id . ';' . $item_rec[0]->price;
    } else {
        echo 'Nie kombinuj!';
    }
} else {
    echo 'Nie kombinuj!';
}

