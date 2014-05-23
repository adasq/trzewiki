<?php
require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    ?>

    <?php
    if (isset($_POST['p24_session_id'])) {
        require_once 'theme/config.php';

        function p24_weryfikuj($p24_id_sprzedawcy, $p24_session_id, $p24_order_id, $p24_kwota) {
            $P = array();
            $RET = array();
            $url = "https://sandbox.przelewy24.pl/transakcja.php";
            $P[] = "p24_id_sprzedawcy=" . $p24_id_sprzedawcy;
            $P[] = "p24_session_id=" . $p24_session_id;
            $P[] = "p24_order_id=" . $p24_order_id;
            $P[] = "p24_kwota=" . $p24_kwota;
            $P[] = "p24_crc=" . md5($p24_session_id . "|" . $p24_order_id . "|" .
                            $p24_kwota . "|d978bf6f32c19abe");
            $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            if (count($P))
                curl_setopt($ch, CURLOPT_POSTFIELDS, join("&", $P));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $result = curl_exec($ch);
            curl_close($ch);
            $T = explode(chr(13) . chr(10), $result);
            $res = false;
            foreach ($T as $line) {
                $line = preg_replace("[\n\r]", "", $line);
                if ($line != "RESULT" and ! $res)
                    continue;
                if ($res)
                    $RET[] = $line;
                else
                    $res = true;
            }
            return $RET;
        }

        if (!isset($_POST['p24_error_code'])) {
            $total = 0;
            $transaction_rec = Transaction::finder()->find("tkey = :tkey", array(":tkey" => $_POST['p24_session_id']));

            if ($transaction_rec != null) {
                $cart_item_rec = CartItem::finder()->findAll("cart_id = :cart_id AND deleted = 0", array(":cart_id" => $transaction_rec->cart_id));

                foreach ($cart_item_rec as $cart_item) {
                    $item_rec = Item::finder()->findByPk($cart_item->item_id);
                    $total += min(array($item_rec->price, ($item_rec->price2) ? $item_rec->price2 : 9999999999));
                }
            }
            $WYNIK = p24_weryfikuj('27590', $_POST["p24_session_id"], $_POST["p24_order_id"], $total * 100);
            if ($WYNIK[0] == "TRUE") {
                $transaction_rec = Transaction::finder()->find("tkey = :tkey", array(":tkey" => $_POST["p24_session_id"]));
                $transaction_rec->status = Transaction::STATUS_FINISHED;
                $transaction_rec->end_date = date('Y-m-d- H:i:s');
                $transaction_rec->saveRecord();
            }
            header('Location: ' . HOST . 'transactions/success/true');
        } else {
            header('Location: ' . HOST . 'transactions/success/false');
        }
    }
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

    <?php
    if (isset($_GET['success'])) {
        if ($_GET['success'] == 'true') {
            showAlert('success', 'Twoja wpłata trafiła na nasze konto! Bierzemy się za realizację zamówienia (tak wiem, automatowi nie można ufać!).<br/><br/>Może być też tak, żę automatyczna weryfikacja nie powiodła się i musisz poczekać, aż administrator potwierdzi przelew.');
        } else if ($_GET['success'] == 'false') {
            showAlert('warning', 'Coś poszło nie tak, zapłać ponownie!');
        } else if ($_GET['success'] == 'waiting') {
            showAlert('success', 'Teraz kolej na Twój przelew!');
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