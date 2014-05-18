<?php

require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    if (isset($_SESSION['item_id']) && ($_POST['item_id'] == isset($_SESSION['item_id']))) {
        
    } else {
        echo 'retry';
    }
} else {
    echo 'need_login';
}
