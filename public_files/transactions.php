<?php
require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    ?>

    <?php
    require_once 'theme/header.php';
    ?>

    <?php

    function renderTransactions() {
        $transaction_rec = Transaction::finder()->findByCustomerID($_SESSION['customer_id']);

        foreach ($transaction_rec as $t) {
            $total = 0;
            $cart_item_rec = CartItem::finder()->findAll("cart_id = :cart_id AND deleted = 0", array(":cart_id" => $t->cart_id));
            echo '  <tr>'
            . '         <td>' . Dict::getValue($t->status, "TransactionStatusArray")
            . '         <td>' . $t->start_date . '</td>'
            . '         <td>' . $t->end_date . '</td>';
            echo '      <td>'
            . '             <table class="table">';

            foreach ($cart_item_rec as $cart_item) {
                $item_rec = Item::finder()->findByPk($cart_item->item_id);
                $item_rec->price2 = ($item_rec->price2 == null) ? 9999999 : $item_rec->price2;
                $size_rec = Size::finder()->findByPk($item_rec->size_id);
                $product_rec = Product::finder()->findByPk($item_rec->product_id);

                echo '  <tr>'
                . '         <td>'
                . '             <a href="' . HOST . 'manufacturer/' . $product_rec->manufacturer_id . '/product/' . $product_rec->product_id . '" title="Przejdź do strony produktu">' . $product_rec->name . '<small> ' . $size_rec->cm . ' CM / ' . $size_rec->euro . ' EUR / ' . $size_rec->us . ' US / ' . $size_rec->uk . ' UK</small></a>'
                . '         </td>'
                . '         <td class="text-center">'
                . min(array($item_rec->price, $item_rec->price2))
                . '          PLN</td>'
                . '     </tr>';
                $total += min(array($item_rec->price, $item_rec->price2));
            }
            echo '          </table>'
            . '         </td>'
            . '         <td>' . $total . ' PLN</td>'
            . '     </tr>';
        }
    }
    ?>

    <div class="col-xs-12">
        <h1 class="page-header">Moje zakupy</h1>
        <table class="table table-hover table-striped">
            <tr>
                <th>Status</th>
                <th>Data rozpoczęcia</th>
                <th>Data zakończenia</th>
                <th>Przedmioty</th>
                <th>Kwota</th>
            </tr>
            <?php renderTransactions() ?>
        </table>
    </div>

    <?php
    require_once 'theme/footer.php';
    ?>
    <?php }
?>