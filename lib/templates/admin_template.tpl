<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

{config_load file='lang.conf'}

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{$PAGE_TITLE} | trzewiki</title> 

 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script> 
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 
  <link type='text/css' rel="stylesheet" href="{#BASE_URL#}/public_files/css/main.css" />
	  <script type="text/javascript" src="{#BASE_URL#}/public_files/js/main.js"></script>



</head>


<body>
<div class="container">
{include file="admin_nav.tpl" nocache}

<div class="row">
  <div class="col-md-2"> 
  	 
<ul class="nav nav-pills nav-stacked">
  <li class="{if $current eq 'content'}active{/if}"><a href="{#BASE_URL#}/admin/content">
  <span class="glyphicon glyphicon-file"></span> Treści</a></li>
  <li class="{if $current eq 'users'}active{/if}"><a href="{#BASE_URL#}/admin/users">
   <span class="glyphicon glyphicon-user"></span> Użytkownicy
  </a></li>
  <li class="{if $current eq 'manufacturers'}active{/if}"><a href="{#BASE_URL#}/admin/manufacturers">
     <span class="glyphicon glyphicon-globe"></span> Producenci
  </a></li>  
    <li class="{if $current eq 'products'}active{/if}"><a href="{#BASE_URL#}/admin/products">
      <span class="glyphicon glyphicon-shopping-cart"></span> Produkty
    </a></li>  
    <li class="{if $current eq 'sizes'}active{/if}"><a href="{#BASE_URL#}/admin/sizes">
      <span class="glyphicon glyphicon-fullscreen"></span> Rozmiary
    </a></li>  
</ul> 
 


  </div>
  <div class="col-md-10">
 {include file="{$CONTENT}.tpl"}
  </div>
</div>

</div>


 <div id="footer">
      <div class="container">
<p class="text-muted">Trzewiki @ 2014 | Regulamin | O nas | Kontakt | Reklama</p>
      </div> 
    </div>



</body>
</html>





