<?php
if (isset($_POST['login'])) {
    require_once 'theme/config.php';

    $customer_rec = login($_POST['login'], $_POST['password']);
    if ($customer_rec == null) {
        die;
        echo 'login_failed';
        exit();
    } else {
        $log_rec = new Log();
        $log_rec->customer_id = $customer_rec->customer_id;
        $log_rec->action = 'customer_log_in';
        $log_rec->custom3 = date('Y-m-d H:m:s');
        $log_rec->saveRecord();

        $_SESSION['customer_id'] = $customer_rec->customer_id;
        $cart_rec = Cart::finder()->findCartByStatus($customer_rec->customer_id, Cart::STATUS_NEW);
        $_SESSION['cart_id'] = $cart_rec->cart_id;
        if (isset($_POST['redirect'])) {
            echo $_POST['redirect'];
        } else {
            echo HOST . 'home';
        }
        exit();
    }
    exit();
} else if (isset($_GET['logout'])) {
    require_once 'theme/config.php';

    $log_rec = new Log();
    $log_rec->customer_id = $_SESSION['customer_id'];
    $log_rec->action = 'customer_log_out';
    $log_rec->custom3 = date('Y-m-d H:m:s');
    $log_rec->saveRecord();

    session_destroy();
    header('Location: ' . HOST . 'home');
    exit();
}
?>

<?php
require_once 'theme/header.php';
?>

<?php if (!isset($_SESSION['customer_id'])) { ?>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Zaloguj się</h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-info" id="alert_please_wait">Trwa logowanie, proszę czekać...</div>
                <div class="alert alert-danger" id="alert_login_failed"></div>
                <form id="login_form" role="form">
                    <input type="hidden" id="host" value="<?php echo HOST ?>">
                    <input type="hidden" name="redirect" value="<?php echo ((isset($_GET['redirect'])) ? 'http://' . $_GET['redirect'] : HOST . 'home') ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="login" type="text" class="form-control" placeholder="Nazwa użytkownika" value="customer">
                            <span class="input-group-addon">Nazwa użytkownika</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Hasło" value="customer">
                            <span class="input-group-addon">Hasło</span>
                        </div>
                    </div>
                    <button ID="sign_in" type="button" class="btn btn-primary pull-right">Zaloguj się</button>
                </form>
            </div>
            <div class="panel-footer">
                <a href="<?php echo HOST; ?>register">Rejestracja</a>
                <a href="#" class="pull-right">Zapomniałem hasło</a>
            </div>
        </div>
    </div>
<?php } ?>
<?php
require_once 'theme/footer.php';
?>
<script src="<?php echo JS_PATH; ?>login.js" type="text/javascript"></script>


