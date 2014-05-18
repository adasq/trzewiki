<?php
require_once __DIR__ . '/config.php';
?>

<?php

function getCartItemsCount() {
    $customer_id = $_SESSION['customer_id'];

    $cart_rec = Cart::finder()->findCartByStatus($customer_id, Cart::STATUS_NEW);
    $cart_item_rec = CartItem::finder()->findAll("cart_id = :cart_id AND deleted = 0", array(":cart_id" => $cart_rec->cart_id));

    return count($cart_item_rec);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>ProSzius.pl - Strona główna</title> 

        <script type="text/javascript" src="<? echo HOST ?>lib/jquery/jquery-1.10.2.min.js"></script> 
        <link rel="stylesheet" href="<? echo HOST ?>lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<? echo HOST ?>lib/bootstrap/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="<? echo HOST ?>public_files/theme/style.css" />
        <script src="<? echo HOST ?>lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="<? echo HOST ?>public_files/js/search.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<? echo HOST; ?>home"><img src='<? echo THEME_PATH ?>logo.png' alt='ProSius.pl' class='img-responsive pull-left' style='height: 25px;' /> ProSius.pl</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="right-menu">
                        <div class="col-md-3 pull-right">
                            <div class="navbar-form navbar-right" role="search">
                                <input type="hidden" id="search_host" value="<? echo HOST ?>">
                                    <div class="input-group">
                                        <input value="<? echo ((isset($_GET['phrase']) ? $_GET['phrase'] : '' )); ?>" ID="search_phrase" type="text" class="form-control input-sm" placeholder="Szukaj w sklepie"> <span class="input-group-btn">
                                                <button class="btn btn-primary btn-sm" type="button" id="search_button">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                    </div>
                            </div>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <? if(!isset($_SESSION['customer_id'])) { ?>
                            <li><a href="<? echo HOST; ?>login" title="Zaloguj się">Zaloguj się</a></li>
                            <li><a href="<? echo HOST; ?>register" title="Zarejestruj się">Rejestracja</a></li>
                            <li><a href="#">Kontakt</a></li>
                            <li><a href="#">Cennik</a></li>
                            <? } else { ?>
                            <li><a href="<? echo HOST; ?>cart"><span class="glyphicon glyphicon-shopping-cart"></span> Koszyk <span class="badge"><? echo getCartItemsCount(); ?></span></a></li>
                            <li><a href="<? echo HOST; ?>settings"><span class="glyphicon glyphicon-cog"></span> Ustawienia</a></li>
                            <li><a href="<? echo HOST; ?>logout">Wyloguj</a></li>
                            <? } ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>

            <div id="top"></div>

            <div id="search2" class="form-inline breadcrumb text-center">
<!--                Szukaj buta <select class="form-control">
                    <option>Płeć</option>
                </select> <select class="form-control">
                    <option>Producent</option>
                </select> <select class="form-control">
                    <option>Typ stopy</option>
                </select> <select class="form-control">
                    <option>Rozmiar</option>
                </select>
                <button class="btn btn-primary">Szukaj</button>-->
            </div>
