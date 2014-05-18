<?php
if (isset($_POST['login'])) {
    require_once 'theme/config.php';

    if (isset($_POST['rules'])) {
        if (isset($_POST['login']) && strlen($_POST['login']) > 4 && isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $customer_rec = Customer::finder()->find("login = :login OR email = :email", array(":login" => $_POST['login'], ":email" => $_POST['email']));

            if ($customer_rec == null) {
                if (strlen($_POST['password']) > 4 && ($_POST['password'] === $_POST['repassword'])) {
                    $customer_rec = new Customer();
                    $customer_rec->login = $_POST['login'];
                    $customer_rec->email = $_POST['email'];
                    $customer_rec->salt = generateSalt();
                    $customer_rec->status = Customer::STATUS_ACTIVE;
                    $customer_rec->password = hash('sha256', $_POST['password'] . $customer_rec->salt);
                    $customer_rec->saveRecord();

                    echo 'success';
                } else {
                    echo 'invalid_password';
                }
            } else {
                echo 'customer_exists';
            }
        } else {
            echo 'invalid_data';
        }
    } else {
        echo 'accept_rules';
    }
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
                <h3 class="panel-title">Zarejestruj się</h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger" id="alert_register_fail"></div>
                <div class="alert alert-success" id="alert_register_end">Rejestracja zakończona, możesz zalogować się korzystając z podanych wcześniej danych.</div>
                <form id="register_form" role="form">
                    <input type="hidden" id="host" value="<? echo HOST ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="login" type="text" class="form-control" placeholder="Nazwa użytkownika">
                            <span class="input-group-addon">Nazwa użytkownika</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input name="email" type="text" class="form-control" placeholder="Adres email">
                            <span class="input-group-addon">Adres email</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Hasło">
                            <span class="input-group-addon">Hasło</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input name="repassword" type="password" class="form-control" placeholder="Powtórz hasło">
                            <span class="input-group-addon">Powtórz hasło</span>
                        </div>
                    </div>
                    <input ID="rules" name="rules" type="checkbox">Przeczytałem(am) i akceptuję <a href="<?php echo HOST; ?>rules" title="Regulamin">regulamin</a>.
                    <button ID="sign_up" type="button" class="btn btn-primary pull-right">Utwórz konto</button>
                </form>
            </div>
            <div class="panel-footer">
                <a href="<? echo HOST; ?>register">Rejestracja</a>
                <a href="#" class="pull-right">Zapomniałem hasło</a>
            </div>
        </div>
    </div>
<?php } ?>

<?php
require_once 'theme/footer.php';
?>
<script src="<? echo JS_PATH; ?>register.js" type="text/javascript"></script>