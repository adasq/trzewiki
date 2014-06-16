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

            $headers = "Reply-to: szmitas@gmail.com <szmitas@gmail.com>" . PHP_EOL;
            $headers .= "From: szmitas@gmail.com <szmitas@gmail.com>" . PHP_EOL;
            $headers .= "MIME-Version: 1.0" . PHP_EOL;
            $headers .= "Content-typ: text/html; charset=utf-8" . PHP_EOL;
            $headers .= "Content-Transfer-Encodin: 8bit" . PHP_EOL;

            if (mail("szmitas@gmail.com", "xxx", "xx")) {
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
$subject = 'testing';
$email = 'test@gmail.com';
$message = 'test message';          
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: The test site" . "\r\n";


$to="szmitas@gmail.com";
$subject="sub";
$from="info@mypropick.com"; 
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: <".$from.">\n";
$headers .= "X-Priority: 1\n";
$message='<div style=" width:700px; margin:0 auto; border:1px solid #e2e2e2; padding:20px;">
<h3>MYPROPICK Services:</h3></div>';
$message .= "<br/>Regards <br />MYPROPICK.COM";


if (mail($to, $subject, $message, $headers )) {
  echo "Message send successfully";
} 
else {
  echo "Please try again, Message could not be sent!";
}  
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


