

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="items/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowy</button>
</form> 
  </div>
</div>


{if isset($items)}
 
<div class="panel panel-default">
  <div class="panel-heading">Rozmiary
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>item_id</td>	<td>price</td> 	<td></td>  	</tr>
		
<!-- item_id
product_id
size_id
price
price2
status
deleted -->

 
	{foreach $items as $item} 
	<tr>  <td>{$item->item_id}</td>
	<td>
<div class="btn-group">
	<form style="float: left;" method="GET" action="items/edit/{$item->item_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
	<form  style="float: left;"  method="GET" action="items/edit/1">
	 	<button type="submit" class="btn btn-danger">Usuń</button>
	</form>  
 
</div>
	</td>  	</tr>
	{/foreach}

</table>

  </div>
</div>

{/if}