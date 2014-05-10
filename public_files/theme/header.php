<?php
require_once 'config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>ProSzius.pl - Strona główna</title> 

        <script type="text/javascript" src="./lib/jquery/jquery-1.10.2.min.js"></script> 
        <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="./public_files/theme/style.css" />
        <script src="./lib/bootstrap/js/bootstrap.min.js"></script>

        <link type='text/css' rel="stylesheet" href="{#BASE_URL#}/public_files/css/main.css" />
        <script type="text/javascript" src="{#BASE_URL#}/public_files/js/main.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">[LOGO] ProSius.pl</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="right-menu">
                        <div class="col-md-3 pull-right">
                            <form class="navbar-form navbar-right" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" placeholder="Szukaj w sklepie"> <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Kontakt</a></li>
                            <li><a href="#">Cennik</a></li>
                            <li><a href="#">Cokolwiek</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>

            <div id="top"></div>

            <div id="search2" class="form-inline breadcrumb text-center">
                Szukaj buta <select class="form-control">
                    <option>Płeć</option>
                </select> <select class="form-control">
                    <option>Producent</option>
                </select> <select class="form-control">
                    <option>Typ stopy</option>
                </select> <select class="form-control">
                    <option>Rozmiar</option>
                </select>
                <button class="btn btn-primary">Szukaj</button>
            </div>
