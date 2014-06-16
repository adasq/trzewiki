<?php
if (isset($_POST['restore'])) {
    require_once 'theme/config.php';

    $customer_rec = Customer::finder()->find("email = :email", array(":email" => $_POST['email']));

    if ($customer_rec !== null) {

        $new_password = substr(generateSalt(), 0, 8);

        $customer_rec->salt = generateSalt();
        $customer_rec->status = Customer::STATUS_ACTIVE;
        $customer_rec->password = hash('sha256', $new_password . $customer_rec->salt);
        if ($customer_rec->saveRecord()) {

            $headers = "Reply-to: kontakt@trzwiki.pl <kontakt@trzwiki.pl>" . PHP_EOL;
            $headers .= "From: kontakt@trzwiki.pl <kontakt@trzwiki.pl>" . PHP_EOL;
            $headers .= "MIME-Version: 1.0" . PHP_EOL;
            $headers .= "Content-typ: text/html; charset=utf-8" . PHP_EOL;
            $headers .= "Content-Transfer-Encodin: 8bit" . PHP_EOL;

            if (mail($customer_rec->email, "Nowe haslo", $customer_rec->password, $headers)) {
                header("Location: " . HOST . "restore/success/true");
            } else {
                header("Location: " . HOST . "restore/success/false");
            }
        } else {
            header("Location: " . HOST . "restore/success/false");
        }
    } else {
        header("Location: " . HOST . "restore/success/false");
    }
}
?>

<?php
require_once 'theme/header.php';
?>

<?php if (!isset($_SESSION['customer_id'])) { ?>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Zapomniałem hasła</h3>
            </div>
            <div class="panel-body">
                <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
                    <div class="alert alert-success">Hasło zmienione, sprawdź maila i loguj się nowymi danymi...</div>
                <?php } else if (isset($_GET['success']) && $_GET['success'] == 'false') { ?>
                    <div class="alert alert-danger">Hasło nie zostało zmienione, spróbuj ponownie...</div>
                <?php } ?>
                <form id="login_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" role="form">
                    <input type="hidden" id="host" value="<?php echo HOST ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="email" type="text" class="form-control" placeholder="Nazwa użytkownika" value="customer@customer.pl">
                            <span class="input-group-addon">Adres email</span>
                        </div>
                    </div>
                    <button name="restore" type="submit" class="btn btn-primary pull-right">Przypomij</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?php
require_once 'theme/footer.php';
?>
<script src="<?php echo JS_PATH; ?>login.js" type="text/javascript"></script>


