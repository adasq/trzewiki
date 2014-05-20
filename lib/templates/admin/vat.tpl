<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

{config_load file='lang.conf'}

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>FAKTURA VAT</title> 

 <script type="text/javascript" src="{#BASE_URL#}/public_files/js/jquery-1.11.1.min.js"></script> 


<link rel="stylesheet" href="{#BASE_URL#}/public_files/css/bootstrap.min.css">
<link rel="stylesheet" href="{#BASE_URL#}/public_files/css/bootstrap-theme.min.css">
 <script src="{#BASE_URL#}/public_files/js/bootstrap.min.js"></script>


<!-- 
  <link type='text/css' rel="stylesheet" href="{#BASE_URL#}/public_files/css/main.css" /> -->
    <script type="text/javascript" src="{#BASE_URL#}/public_files/js/main.js"></script>

<script type="text/javascript" src="{#BASE_URL#}/public_files/tinymce/tinymce.min.js"></script>


</head>


<body>
<div class="container">
<div class="row">


<div class="page-header">
  <h1>Faktura VAT <small>FV/{$transaction->transaction_id}/2014/05</small></h1>
</div>




{if isset($transaction)}


<!-- ============================================================================================================ -->
 <div class="row">
<div class="panel panel-default">
  <div class="panel-heading">Podmioty tranakcji
 
  </div>
  <div class="panel-body">    
     <div class="row">


      <div class="col-sm-6">
          <!-- {$transaction->toString()} -->
            Sprzedawca:
      <table class="table">
        <tr> <td>Trzewiki sp. z.o.o</td>  </tr>
        <tr> <td>Sosnowiec, ul. Małachowskiego 12/10</td>   </tr>
        <tr> <td>tel. (032) 266 81 39</td>   </tr>
       

      </table>
     </div>



     <div class="col-sm-6">
      Nabywca:
      <table class="table">
      <!--  <tr> <td>Imię</td> <td>{$transaction->customer->first_name}</td>  </tr>
        <tr> <td>Nazwisko</td> <td>{$transaction->customer->last_name}</td>  </tr> -->
        <tr> <td>{$transaction->address}</td>   </tr>
       
      </table>
     </div>


     </div>
</div></div></div>


 <div class="row">
<div class="panel panel-default">
  <div class="panel-heading">Zamówienie nr {$transaction->transaction_id}
 
  </div>
  <div class="panel-body">   


      <div class="col-sm-6">
          <!-- {$transaction->toString()} -->
            Informacje:
      <table class="table">
        <tr> <td>Zlecenie zamówienia</td> <td>{$transaction->start_date}</td>  </tr>
        <tr> <td>Data realizacji</td> <td>{$transaction->end_date}</td>  </tr>
       
      </table>
     </div>

</div></div></div>




<!-- ============================================================================================================ -->


<div class="row">

<div class="panel panel-default">
  <div class="panel-heading">Produkty
 
  </div>
  <div class="panel-body">

     <div class="col-sm-12">
  <table class="table">
    <tr>  
<td>Produkt</td> <td>Cena</td>
</tr> 
{foreach $items as $item} 
 <tr> 
<td>
  {$item["product"]->name}
</td> 
<td>  
  {if {$item["item"]->price2} gt 0}
    {$item["item"]->price2}zł
  {else}
    {$item["item"]->price}zł
  {/if}

</td> 


</tr>  

{/foreach}
</table>

<h3 class="pull-right">Kwota do zapłaty: {$total} zł</h3>

  </div>
</div>
  </div>  <!-- PANEL PRODUKTY -->
</div>
<!-- ============================================================================================================ -->
 


{else}
Błąd podczas generowania faktury VAT
{/if}








 
</div>
</div>
</body>
</html>















