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
            PDODataBase::get()->beginTransaction();

            $transaction_rec = new Transaction();
            $transaction_rec->cart_id = $_SESSION['cart_id'];
            $transaction_rec->payment_method = $_POST['payment_method'];
            $transaction_rec->status = Transaction::STATUS_IN_PROGRESS;
            $transaction_rec->start_date = date('Y-m-d H:i:s');
            $transaction_rec->address = $_POST['first_name'] . ' ' . $_POST['last_name'] . ', ' . $_POST['street'] . ', ' . $_POST['zip_code'] . ' ' . $_POST['city'];
            $transaction_rec->saveRecord();

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
            header('Location: ' . HOST . 'pay/success/true');
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
                            <h3 class="panel-title">Metoda płatności</h3>
                        </div>
                        <div class="panel-body"><div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="online" disabled>
                                    Przelewy24 czy coś innego
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
        } else if (isset($_GET['success']) && $_GET['success'] == 'true') {
            showAlert('success', 'Czekamy na dokonanie przelewu!');
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