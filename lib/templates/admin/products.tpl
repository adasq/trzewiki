<div class="page-header">
  <h1>Produkty <small>
 Zarządzaj produktami
  </small></h1>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="products/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowego</button>
</form> 
  </div>
</div>

{if isset($products)}
 
<div class="panel panel-default">
  <div class="panel-heading">Producenci
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>name</td>		<td></td>  	</tr>
 
	{foreach $products as $product} 
	<tr>  <td>{$product->name}</td>
	<td>

<div class="btn-group">
	<form style="float: left;" method="GET" action="products/edit/{$product->product_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
 
</div>

	</td>  	</tr>
	{/foreach}

</table>

  </div>
</div>

{/if}