<div class="page-header">
  <h1>Informacje dotyczące zamówienia <small>Zmieniaj stan zamówień</small></h1>
</div>




{if isset($transaction)}
 <div class="row">
<div class="panel panel-default">
  <div class="panel-heading">Zamówienie
 
  </div>
  <div class="panel-body">
    
  	

  	


  	 <div class="row">


  	 <div class="col-sm-6">
  	 	Klient:
  	 	<table class="table">
  	 	<!-- 	<tr> <td>Imię</td> <td>{$transaction->customer->first_name}</td>  </tr>
  	 		<tr> <td>Nazwisko</td> <td>{$transaction->customer->last_name}</td>  </tr> -->
  	 		<tr> <td>{$transaction->address}</td>   </tr>
  	 	 
  	 	</table>
  	 </div>
  	  <div class="col-sm-6">
  	  		<!-- {$transaction->toString()} -->
  	  			Informacje:
  	 	<table class="table">
  	 		<tr> <td>Stan</td> <td>{$transaction->status}</td>  </tr>
  	 		<tr> <td>Zlecenie zamówienia</td> <td>{$transaction->start_date}</td>  </tr>
  	 		<tr> <td>Data realizacji</td> <td>{$transaction->end_date}</td>  </tr>
  	 	 
  	 	</table>
  	 </div>

  	 </div>







</div></div></div>



<div class="row">

<div class="panel panel-default">
  <div class="panel-heading">Produkty
 
  </div>
  <div class="panel-body">

  	 <div class="col-sm-12">
	<table class="table">
		<tr>  
<td>Produkt</td> <td>Cena</td> <td></td>
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

<td>
<div class="btn-group">
	<form style="float: left;" method="GET" action="{#BASE_URL#}/admin/products/edit/{$item["product"]->product_id}">
		<button type="submit" class="btn btn-default">Więcej</button>
	</form>
 
</div>

</td>

</tr>  

{/foreach}
</table>
	</div>
</div>
  </div>  <!-- PANEL PRODUKTY -->

</div>




{if $transaction->status eq 'in_progress'}
<div class="row">
  <div class="md-col-12">
<div class="pull-right btn-group">
	<form method="POST" action=""> 
		<input name="tid" type="hidden" value="{$item["product"]->product_id}">
		<button type="submit " class="btn btn-success">Zrealizowano</button>
	</form>
 
</div>
 </div> </div>
{else}
Zamówienie zostało pomyślnie zrealizowane
{/if}



{else}

Brak infromacji!

{/if}