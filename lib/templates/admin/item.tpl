{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


{if isset($item)}


{include file="admin/product_view.tpl" nocache}
 <div class="col-md-10 col-md-offset-1">



<div class="panel panel-default">
  <div class="panel-heading">Wypełnij formularz</div>
  <div class="panel-body">

<form role="form" class="form" action="" method="POST">
<input type="hidden" name="item_id" value="{$item->item_id}">
  
 
<!--   <div class="form-group">
    <label>Rozmiar:</label>
<select class="form-control"  value="{$item->size_id}" name="size_id" >
  {foreach $sizes as $size}  
      <option  {if $size->size_id eq $item->size_id} selected {/if}    value="{$size->size_id}">us: {$size->us}/uk: {$size->uk}</option>
    
  {/foreach}
</select>
  </div>
  <div class="form-group">
    <label>Produkt:</label>
<select class="form-control" value="{$item->product_id}" name="product_id" >
  {foreach $products as $product} 
    <option  {if $product->product_id eq $item->product_id} selected {/if} value="{$product->product_id}">{$product->name}</option>
  {/foreach}
</select>
  </div> -->

   <div class="form-group">
    <label>price</label>
    <input  value="{$item->price}" name="price" type="text" class="form-control" placeholder="price">
  </div>
    <div class="form-group">
    <label>price2</label>
    <input  value="{$item->price2}" name="price2" type="text" class="form-control" placeholder="price2">
  </div>

   <div class="form-group">
    <div class="checkbox">
    <label>
      <input name="deleted" {if $item->deleted eq 1 } checked {/if} type="checkbox"> Oznacz jako usunięty
    </label>
  </div>
    </div>

 

  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}