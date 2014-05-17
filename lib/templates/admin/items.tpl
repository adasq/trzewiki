<div class="page-header">
  <h1>Egzemplarze obuwia <small>Zarządzaj egzemplarzami obuwia!</small></h1>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="{#BASE_URL#}/admin/items/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowy</button>
</form> 
  </div>
</div>


{if isset($items)}
 
<div class="panel panel-default">
  <div class="panel-heading">Buty
 
  </div>
  <div class="panel-body">
    


 

<form method="GET" class=" filter_form form-inline" action="" role="form">
  <div class="form-group">
<select class="product form-control">
  {foreach $products as $product} 
    <option  
  {if isset($smarty.get.product) &&  $smarty.get.product eq $product->product_id}  selected     {/if}
      value="{$product->product_id}">{$product->name}</option>
  {/foreach}
</select>
  </div>

    <button type="submit" onclick="test()"  class="btn btn-success">Wybierz</button>
</form>

<script>
function test(){
  $('.filter_form').attr("action", "http://localhost/trzewiki/admin/items/product/"+$('.product').val());
}
</script>


 

<div class="row">
&nbsp
</div>












{if sizeof($items) gt 0}
<table class="table table-striped">
<tr> <td>Produkt</td> <td>Rozmiary us/uk/cm/euro</td> <td>Cena / Cena promocyjna</td>	<td></td>  	</tr>
 
 
 <div>
	{foreach $items as $item} 
	<tr>   

 <td>
{foreach $products as $product} 
{if $product->product_id eq $item->product_id}
<div class="media">
  <div class="">
       
    <img class="pull-left media-object" style="width: 150px; height: auto;" class="img-thumbnail" 
    src="{#BASE_URL_IMAGES#}/products/{$product->url}" alt="">

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
{if $size->us} {$size->us} {else} <i>brak</i>{/if} 
/ 
{if $size->uk} {$size->uk} {else} <i>brak</i>{/if} 
/ 
{if $size->cm} {$size->cm} {else} <i>brak</i>{/if}  
/ 
{if $size->euro} {$size->euro} {else} <i>brak</i>{/if} 
 </small>


{/if}
{/foreach}
</td>



<td>
{$item->price}zł  / {if $item->price2 gt 0} {$item->price2}zł {else} <i>brak</i>{/if}
</td>


	<td>
		 
<div class="btn-group">
	<form style="float: left;" method="GET" action="{#BASE_URL#}/admin/items/edit/{$item->item_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
</div>
	</td> 	</tr>
	{/foreach}
</div>



</table>
{else}


{if  isset($smarty.get.product) }
<h3>  <small>Brak egzemplarzy...</small> </h3>

{/if}

{/if}


  </div>
</div>

{/if}