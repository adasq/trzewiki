<?php
require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    if (isset($_POST['save_customer_data'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

            $customer_rec = Customer::finder()->findByPk($_SESSION['customer_id']);
            $customer_rec->first_name = $_POST['first_name'];
            $customer_rec->last_name = $_POST['last_name'];
            $customer_rec->zip_code = $_POST['zip_code'];
            $customer_rec->city = $_POST['city'];
            $customer_rec->street = $_POST['street'];
            $customer_rec->email = $_POST['email'];

            if ($customer_rec->saveRecord()) {
                header("Location: " . HOST . 'settings/save/true');
            } else {
                header("Location: " . HOST . 'settings/save/false');
            }
        } else {
            header("Location: " . HOST . 'settings/save/false');
        }
    } else if (isset($_POST['save_customer_password'])) {
        require_once 'theme/config.php';

        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

        $customer_rec = Customer::finder()->findByPk($_SESSION['customer_id']);
        $actual_hash = hash('sha256', $_POST['actual_password'] . $customer_rec->salt);
        if ($actual_hash == $customer_rec->password) {
            if ($_POST['new_password'] === $_POST['new_password_re'] && strlen($_POST['new_password']) > 5) {
                $customer_rec->salt = generateSalt();
                $customer_rec->password = hash('sha256', $_POST['new_password'] . $customer_rec->salt);
                if ($customer_rec->saveRecord()) {
                    header("Location: " . HOST . 'settings/password/true');
                } else {
                    header("Location: " . HOST . 'settings/password/false');
                }
            } else {
                header("Location: " . HOST . 'settings/password/false');
            }
        } else {
            header("Location: " . HOST . 'settings/password/false');
        }
    }
    ?>

    <?php
    require_once 'theme/header.php';
    ?>

    <?php
    if (isset($_SESSION['customer_id'])) {
        $customer_rec = Customer::finder()->findByPk($_SESSION['customer_id']);
    }
    ?>

    <?php if (isset($_SESSION['customer_id'])) { ?>
        <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Twoje dane</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['save'])) {
                        if ($_GET['save'] === 'true') {
                            echo '<div class="alert alert-success">Zmiany zostały zapisane</div>';
                        } else if ($_GET['save'] === 'false') {
                            echo '<div class="alert alert-danger">Zmiany nie zostały zapisane, spróbuj ponownie...</div>';
                        }
                    }
                    ?>
                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];
                    ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" placeholder="Adres email" value="<?php echo $customer_rec->email; ?>">
                                <span class="input-group-addon">Adres email</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="first_name" placeholder="Imię" value="<?php echo $customer_rec->first_name; ?>">
                                <span class="input-group-addon">Imię</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="last_name" placeholder="Nazwisko" value="<?php echo $customer_rec->last_name; ?>">
                                <span class="input-group-addon">Nazwisko</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="street" placeholder="Ulica, numer domu, numer mieszkania" value="<?php echo $customer_rec->street; ?>">
                                <span class="input-group-addon">Ulica, numer domu, numer mieszkania</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="city" placeholder="Miasto" value="<?php echo $customer_rec->city; ?>">
                                <span class="input-group-addon">Miasto</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="zip_code" placeholder="Kod pocztowy" value="<?php echo $customer_rec->zip_code; ?>">
                                <span class="input-group-addon">Kod pocztowy</span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary pull-right" value="Zapisz zmiany" name="save_customer_data">
                    </form>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Zmiana hasła</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['password'])) {
                        if ($_GET['password'] === 'true') {
                            echo '<div class="alert alert-success">Zmiany zostały zapisane</div>';
                        } else if ($_GET['password'] === 'false') {
                            echo '<div class="alert alert-danger">Zmiany nie zostały zapisane, spróbuj ponownie...</div>';
                        }
                    }
                    ?>
                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" name="actual_password" placeholder="Aktualne hasło">
                                <span class="input-group-addon">Aktualne hasło</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" name="new_password" placeholder="Nowe hasło">
                                <span class="input-group-addon">Nowe hasło</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" name="new_password_re" placeholder="Powtórz nowe hasło">
                                <span class="input-group-addon">Powtórz nowe hasło</span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary pull-right" value="Zmień hasło" name="save_customer_password">
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php
    require_once 'theme/footer.php';
    ?>

<?php
}?>