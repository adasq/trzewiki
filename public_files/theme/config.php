<?php

session_start();

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('HOST', 'http://localhost/trzewiki/');
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    define('DB_USER', 'szmitas_trzewiki');
    define('DB_PASSWORD', 'trzewiki123');
    define('HOST', 'http://www.trzewiki.ubuntu-pomoc.org/');
}

define('GATE', 'customer');
define('DB_HOST', 'localhost');
define('DB_NAME', 'szmitas_trzewiki');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_polish_ci');

define('IMAGES_PATH', HOST . 'public_files/images/products/');
define('THEME_PATH', HOST . 'public_files/theme/images/');
define('JS_PATH', HOST . 'public_files/js/');

require_once dirname(__DIR__) . '/../lib/PDODataBase.class.php';
require_once dirname(__DIR__) . '/../lib/Base.class.php';
require_once dirname(__DIR__) . '/../lib/Media.class.php';
require_once dirname(__DIR__) . '/../lib/Customer.class.php';
require_once dirname(__DIR__) . '/../lib/Log.class.php';
require_once dirname(__DIR__) . '/../lib/Manufacturer.class.php';
require_once dirname(__DIR__) . '/../lib/Product.class.php';
require_once dirname(__DIR__) . '/../lib/Item.class.php';
require_once dirname(__DIR__) . '/../lib/Cart.class.php';
require_once dirname(__DIR__) . '/../lib/CartItem.class.php';
require_once dirname(__DIR__) . '/../lib/Type.class.php';
require_once dirname(__DIR__) . '/../lib/ProductType.class.php';
require_once dirname(__DIR__) . '/../lib/Item.class.php';
require_once dirname(__DIR__) . '/../lib/Size.class.php';
require_once dirname(__DIR__) . '/../lib/Transaction.class.php';

$DB = PDODataBase::get();

require_once __DIR__ . '/functions.php';
require_once 'dict.php';
