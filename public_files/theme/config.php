<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

define('GATE', 'customer');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'szmitas_trzewiki');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_polish_ci');

define('HOST', 'http://localhost/trzewiki/');
define('IMAGES_PATH', HOST . 'public_files/images/products/');

require_once '../lib/PDODataBase.class.php';
require_once '../lib/Base.class.php';
require_once '../lib/Media.class.php';
require_once '../lib/Customer.class.php';
require_once '../lib/Manufacturer.class.php';
require_once '../lib/Product.class.php';
require_once '../lib/Type.class.php';
require_once '../lib/ProductType.class.php';
require_once '../lib/Item.class.php';
require_once '../lib/Size.class.php';

require_once 'functions.php';
require_once 'dict.php';
