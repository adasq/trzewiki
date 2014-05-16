

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="items/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowy</button>
</form> 
  </div>
</div>


{if isset($items)}
 
<div class="panel panel-default">
  <div class="panel-heading">Buty
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr> <td>Produkt</td> <td>Rozmiary us/uk/cm/euro</td> <td>Cena / Cena promocyjna</td>	<td></td>  	</tr>
		
 
	{foreach $items as $item} 
	<tr>   

 <td>
{foreach $products as $product} 
{if $product->product_id eq $item->product_id}
<div class="media">
  <div class="">
      <a class="pull-left" href="#">
    <img class="media-object" style="width: 150px; height: auto;" class="img-thumbnail" 
    src="{#BASE_URL_IMAGES#}/products/{$product->url}" alt="">
  </a>
  </div>

  <div class="media-body">
    <h4 class="media-heading">
    	<a href="{#BASE_URL#}/admin/products/edit/{$product->product_id}">{$product->name}</a>
    </h4>
    <small  >{$product->description|truncate:120:'...'}</small>
<!--   <a href="{#BASE_URL_IMAGES#}/products/{$media->file_path}">{$media->file_path|truncate:60:'...'}</a>   -->

  </div>
</div>
{/if}
{/foreach}
</td>



 <td>
{foreach $sizes as $size} 
{if $item->size_id eq $size->size_id}

 <small>
{$size->us}/{$size->uk}/{$size->cm}/{$size->euro}

 </small>


{/if}
{/foreach}
</td>







<td>
{$item->price}zł / {$item->price2}zł
</td>


	<td>
		 
<div class="btn-group">
	<form style="float: left;" method="GET" action="items/edit/{$item->item_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
	<form  style="float: left;"  method="GET" action="items/edit/1">
	 	<button type="submit" class="btn btn-danger">Usuń</button>
	</form>  
 
</div>
	</td> 	</tr>
	{/foreach}

</table>

  </div>
</div>

{/if}