<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

{config_load file='lang.conf'}

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Admin</title> 



 <script type="text/javascript" src="{#BASE_URL#}/public_files/js/jquery-1.11.1.min.js"></script> 

<link rel="stylesheet" href="{#BASE_URL#}/public_files/css/bootstrap.min.css">
<link rel="stylesheet" href="{#BASE_URL#}/public_files/css/bootstrap-theme.min.css">
 <script src="{#BASE_URL#}/public_files/js/bootstrap.min.js"></script>

  <link type='text/css' rel="stylesheet" href="{#BASE_URL#}/public_files/css/main.css" />
    <script type="text/javascript" src="{#BASE_URL#}/public_files/js/main.js"></script>








</head>


<body>
<div class="container">
<div class="row">

  <div class="col-md-8 col-md-offset-2">

{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


<div class="panel panel-default">
  <div class="panel-heading">Panel administracyjny</div>
  <div class="panel-body">
  
<form role="form" method="POST">
  <div class="form-group">
    <label>Login:</label>
    <input name="login" type="text" class="form-control" value="admin" placeholder="login">
  </div>
 
  <div class="form-group">
    <label>Hasło:</label>
    <input name="password"  type="password" class="form-control" value="pswd" placeholder="hasło">
  </div>

  <button type="submit" class="pull-right btn btn-success">Zaloguj się!</button>
</form>
  </div>
</div>




  </div>
</div>


</div>





</body>
</html>






