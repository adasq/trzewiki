<?php
require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    if (isset($_POST['finish'])) {
        $correct = true;
        if (!isset($_POST['first_name']) || strlen($_POST['first_name']) == 0) {
            $correct = false;
        }
        if (!isset($_POST['last_name']) || strlen($_POST['last_name']) == 0) {
            $correct = false;
        }
        if (!isset($_POST['zip_code']) || strlen($_POST['zip_code']) != 6) {
            $correct = false;
        }
        if (!isset($_POST['city']) || strlen($_POST['city']) == 0) {
            $correct = false;
        }
        if (!isset($_POST['street']) || strlen($_POST['street']) == 0) {
            die;
            $correct = false;
        }
        if ($correct) {
            try {
                PDODataBase::get()->beginTransaction();

                $transaction_rec = new Transaction();
                $transaction_rec->cart_id = $_SESSION['cart_id'];
                $transaction_rec->payment_method = $_POST['payment_method'];
                $transaction_rec->status = Transaction::STATUS_IN_PROGRESS;
                $transaction_rec->tkey = md5(print_r($_SERVER, true) . rand(0, 9999999));
                $transaction_rec->receipt_type = $_POST['receipt_type'];
                $transaction_rec->start_date = date('Y-m-d H:i:s');
                $transaction_rec->address = $_POST['first_name'] . ' ' . $_POST['last_name'] . ', ' . $_POST['street'] . ', ' . $_POST['zip_code'] . ' ' . $_POST['city'];
                $transaction_rec->saveRecord();

                $_SESSION['transaction_key'] = $transaction_rec->tkey;

                $cart_rec = Cart::finder()->findCartByStatus($_SESSION['customer_id'], Cart::STATUS_NEW);
                $cart_rec->status = Cart::STATUS_ORDERED;
                $cart_rec->saveRecord();

                $cart_rec = new Cart();
                $cart_rec->status = Cart::STATUS_NEW;
                $cart_rec->customer_id = $_SESSION['customer_id'];
                $cart_rec->saveRecord();
                $_SESSION['cart_id'] = $cart_rec->cart_id;

                $log_rec = new Log();
                $log_rec->customer_id = $_SESSION['customer_id'];
                $log_rec->action = 'new_transaction';
                $log_rec->custom1 = $transaction_rec->transaction_id;
                $log_rec->custom3 = date('Y-m-d H:i:s');
                $log_rec->saveRecord();

                $log_rec = new Log();
                $log_rec->customer_id = $_SESSION['customer_id'];
                $log_rec->action = 'customer_created_new_cart';
                $log_rec->custom1 = $cart_rec->cart_id;
                $log_rec->custom3 = date('Y-m-d H:i:s');
                $log_rec->saveRecord();

                PDODataBase::get()->commit();
                if ($_POST['payment_method'] == Transaction::PAYMENT_METHOD_ONLINE) {
                    header('Location: ' . HOST . 'pay/success/true');
                } else if ($_POST['payment_method'] == Transaction::PAYMENT_METHOD_STANDARD) {
                    header('Location: ' . HOST . 'transactions/success/waiting');
                }
            } catch (Exception $e) {
                PDODataBase::get()->rollBack();
                echo "Fejl: " . $e->getMessage();
            }
        } else {
            header('Location: ' . HOST . 'pay/success/false');
        }
    }
    ?>

    <?php
    require_once 'theme/header.php';
    ?>

    <?php
    if (isset($_SESSION['customer_id'])) {
        $customer_rec = Customer::finder()->findByPk($_SESSION['customer_id']);
        $cart_rec = Cart::finder()->findCartByStatus($customer_rec->customer_id, Cart::STATUS_NEW);
        $cart_item_rec = CartItem::finder()->find("cart_id = :cart_id AND deleted = 0", array(":cart_id" => $cart_rec->cart_id));
    }
    ?>

    <?php
    if (isset($_SESSION['customer_id'])) {
        if ($cart_rec != null && count($cart_item_rec) > 0) {
            ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class = "col-xs-6 col-xs-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Dane do wysyłki</h3>  
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-info">Dane zostały uzupełnione na podstawie Twoich <a href="<?php echo HOST; ?>settings" title="Przejdź do ustawień">ustawień</a>. Nie zostaną zapisane w przypadku zmiany.</div>
                            <div class = "form-group">
                                <div class = "input-group">
                                    <input type = "text" class = "form-control" name = "first_name" placeholder = "Imię" value = "<?php echo $customer_rec->first_name; ?>">
                                    <span class = "input-group-addon">Imię</span>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "input-group">
                                    <input type = "text" class = "form-control" name = "last_name" placeholder = "Nazwisko" value = "<?php echo $customer_rec->last_name; ?>">
                                    <span class = "input-group-addon">Nazwisko</span>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "input-group">
                                    <input type = "text" class = "form-control" name = "street" placeholder = "Ulica, numer domu, numer mieszkania" value = "<?php echo $customer_rec->street; ?>">
                                    <span class = "input-group-addon">Ulica, numer domu, numer mieszkania</span>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "input-group">
                                    <input type = "text" class = "form-control" name = "city" placeholder = "Miasto" value = "<?php echo $customer_rec->city; ?>">
                                    <span class = "input-group-addon">Miasto</span>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "input-group">
                                    <input type = "text" class = "form-control" name = "zip_code" placeholder = "Kod pocztowy" value = "<?php echo $customer_rec->zip_code; ?>">
                                    <span class = "input-group-addon">Kod pocztowy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "col-xs-6 col-xs-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Potwierdzenie</h3>
                        </div>
                        <div class="panel-body"><div class="radio">
                                <label>
                                    <input type="radio" name="receipt_type" value="bill" checked>
                                    Rachunek
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="receipt_type" value="invoice">
                                    Faktura
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Metoda płatności</h3>
                        </div>
                        <div class="panel-body"><div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="online">
                                    Przelewy24.pl
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="standard" checked>
                                    Zwykły przelew
                                </label>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <input class="btn btn-primary btn-block" type="submit" value="Zakończ transakcję!" name="finish">
                        </div>
                    </div>
                </div>
            </form>
            <?php
        } else if (isset($_GET['success']) && $_GET['success'] == 'true' && isset($_SESSION['transaction_key'])) {

            $transaction_rec = null;
            $customer_rec = Customer::finder()->find("customer_id = :customer_id", array(":customer_id" => $_SESSION['customer_id']));
            $total = 0;
            if (isset($_SESSION['transaction_key'])) {
                $transaction_rec = Transaction::finder()->find("tkey = :tkey", array(":tkey" => $_SESSION['transaction_key']));

                if ($transaction_rec != null) {
                    $cart_item_rec = CartItem::finder()->findAll("cart_id = :cart_id AND deleted = 0", array(":cart_id" => $transaction_rec->cart_id));

                    foreach ($cart_item_rec as $cart_item) {
                        $item_rec = Item::finder()->findByPk($cart_item->item_id);
                        $total += min(array($item_rec->price, ($item_rec->price2) ? $item_rec->price2 : 9999999999));
                    }
                }
            }
            unset($_SESSION['transaction_key']);
            ?>
            <div class="col-xs-6 col-xs-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Wybrałeś Przelewy24.pl</h3>
                    </div>
                    <div class="panel-body text-center">
                        Kliknij Płacę!, aby kontynuować zakupy z Przelewy24.pl.
                        <form action="https://sandbox.przelewy24.pl/index.php" method="post" class="form">
                            <input type="hidden" name="p24_session_id" value="<?php echo $transaction_rec->tkey; ?>" />
                            <input type="hidden" name="p24_id_sprzedawcy" value="27590" />
                            <input type="hidden" name="p24_kwota" value="<?php echo $total * 100; ?>" />
                            <input type="hidden" name="p24_opis" value="<?php echo $transaction_rec->tkey; ?>" />
                            <input type="hidden" name="p24_klient" value="<?php echo substr($transaction_rec->address, 0, strpos($transaction_rec->address, ',')); ?>" />
                            <input type="hidden" name="p24_adres" value="<?php echo substr($transaction_rec->address, strpos($transaction_rec->address, ',') + 2, strlen($transaction_rec->address) - strrpos($transaction_rec->address, ',') - strpos($transaction_rec->address, ',') + 2); ?>" />
                            <input type="hidden" name="p24_kod" value="<?php echo substr($transaction_rec->address, strrpos($transaction_rec->address, ',') + 2, 6); ?>" />
                            <input type="hidden" name="p24_miasto" value="<?php echo substr($transaction_rec->address, strrpos($transaction_rec->address, ',') + 9); ?>" />
                            <input type="hidden" name="p24_kraj" value="PL" />
                            <input type="hidden" name="p24_email" value="<?php echo $customer_rec->email; ?>" />
                            <input type="hidden" name="p24_language" value="pl" />
                            <input type="hidden" name="p24_return_url_ok" value="<?php echo HOST . 'transactions'; ?>" />
                            <input type="hidden" name="p24_return_url_error" value="<?php echo HOST . 'transactions'; ?>" />
                            <input type="hidden" name="p24_crc" value="<?php echo md5($transaction_rec->tkey . '|27590' . '|' . $total * 100 . '|d978bf6f32c19abe'); ?>" />
                            <input name="submit_send" value="Płacę!" type="submit" class="btn btn-primary btn-lg"/>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        } else {
            showAlert('danger', 'Twój koszyk jest pusty!');
        }
    } else {
        showAlert('danger', 'Czego tu szukasz?');
    }
    ?>


    <?php
    require_once 'theme/footer.php';
    ?>

<?php } ?>