<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

{config_load file='lang.conf'}

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{$PAGE_TITLE} | trzewiki</title> 

 <script type="text/javascript" src="{#BASE_URL#}/public_files/js/jquery-1.11.1.min.js"></script> 


<link rel="stylesheet" href="{#BASE_URL#}/public_files/css/bootstrap.min.css">
<link rel="stylesheet" href="{#BASE_URL#}/public_files/css/bootstrap-theme.min.css">
 <script src="{#BASE_URL#}/public_files/js/bootstrap.min.js"></script>



  <link type='text/css' rel="stylesheet" href="{#BASE_URL#}/public_files/css/main.css" />
	  <script type="text/javascript" src="{#BASE_URL#}/public_files/js/main.js"></script>

<script type="text/javascript" src="{#BASE_URL#}/public_files/tinymce/tinymce.min.js"></script>


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
        <li class="{if $current eq 'items'}active{/if}"><a href="{#BASE_URL#}/admin/items">
      <span class="glyphicon glyphicon-plane"></span> Buty
    </a></li>  
        <li class="{if $current eq 'types'}active{/if}"><a href="{#BASE_URL#}/admin/types">
      <span class="glyphicon glyphicon-tasks"></span> Atrybuty
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





<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>