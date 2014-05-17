<div class="page-header">
  <h1>Produkty 

{if isset($product->product_id)}

    <small>
   {if $product->product_id}
      Edytuj dane produktu
   {else}
   Dodaj nowy produkt
     {/if}
  </small>
{/if}

</h1>
</div>


{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}




{if isset($product)}

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">
    {if $product->product_id}
      Edytuj dane produktu
   {else}
   Dodaj nowy produkt
     {/if}
  </div>
  <div class="panel-body">

<div class="panel panel-default">
  <div class="panel-body">
<form role="form" class="form" action="" method="POST">
<input type="hidden" name="product_id" value="{$product->product_id}">
 

  <div class="form-group">
    <label>Producent:</label>
<select class="form-control"  value="{$product->manufacturer_id}" name="manufacturer_id" >
  {foreach $manufacturers as $manufacturer} 
    <option  {if $manufacturer->manufacturer_id eq $product->manufacturer_id} selected {/if}    value="{$manufacturer->manufacturer_id}">{$manufacturer->name}</option>
  {/foreach}
</select>
  </div>

     <div class="form-group">
    <label>name</label>
    <input  value="{$product->name}" name="name" type="text" class="form-control" placeholder="name">
  </div>

     <div class="form-group">
    <label>product_no</label>
    <input  value="{$product->product_no}" name="product_no" type="text" class="form-control" placeholder="">
  </div>


	  <div class="form-group">
    <label>description</label>
    <textarea rows="20" name="description" class="form-control" placeholder="description">
      {$product->description}
    </textarea>
  </div>


   <div class="form-group">
    <div class="checkbox">
    <label>
      <input name="deleted" {if $product->deleted eq 1 } checked {/if} type="checkbox"> Oznacz jako usunięty
    </label>
  </div>
    </div>


    <div class="form-group">

    <div class="pull-right">

        <button type="submit" class="btn btn-success">Zapisz</button>
    </div>
  </div>



</form>
</div></div>

  {if $product->product_id}

<div class="panel panel-default">
  <div class="panel-heading">
Media:
  </div>
  <div class="panel-body">
<div class="panel panel-default">
  <div class="panel-body">
  {foreach $medias as $media}  
<div class="media">
  <div class="">
      <a class="pull-left" href="#">
    <img class="media-object" style="width: 150px; height: auto;" class="img-thumbnail" src="{#BASE_URL_IMAGES#}/products/{$media->file_path}" alt="">
  </a>
  </div>

  <div class="media-body">
    <h4 class="media-heading">{$media->type} 
    <form style="float: right;" method="GET" action="{#BASE_URL#}/admin/media/delete/{$media->media_id}">
    <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    </h4>
  <a href="{#BASE_URL_IMAGES#}/products/{$media->file_path}">{$media->file_path|truncate:60:'...'}</a>  
  </div>
</div>
  {/foreach}
  </div>
</div>
  </div></div>

<!-- ======================================================== -->
  <div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="{#BASE_URL#}/admin/media/new/{$product->product_id}">
    <button type="submit" class="pull-right btn btn-success">Dodaj media </button>
</form> 
  </div>
</div>
<!-- ======================================================== -->


{if isset($productTypes)}

<div class="panel panel-default">
  <div class="panel-heading">
Atrybuty:
  </div>
  <div class="panel-body">
  <ul class="list-group">
  {foreach $productTypes as $pt} 
{foreach $types as $type}  
  {if $pt->type_id eq $type->type_id}
   <li class="list-group-item"> 
  <form  method="GET" action="{#BASE_URL#}/public_files/admin_types.php">

    <input type="hidden" name="pid" value="{$product->product_id}">
     <input type="hidden" name="action" value="remove">
       <input type="hidden" name="tid" value="{$type->type_id}">
    <div class="form-group">   
    <label> {$type->type_name} </label>  
    <button type="submit" class="pull-right btn btn-danger">Usuń</button>
      </div>
</form> 
</li>
  {/if}{/foreach}{/foreach}

  </ul>
  </div>
</div>

{/if}
<!-- ======================================================== -->

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="{#BASE_URL#}/public_files/admin_types.php">
  <div class="form-group">
    <label>Dodaj atrybut do produktu:</label>
    <input type="hidden" name="pid" value="{$product->product_id}">
     <input type="hidden" name="action" value="add">
<select class="form-control" name="tid" >
  {foreach $types as $type} 
    <option value="{$type->type_id}">{$type->type_name}</option>
  {/foreach}
</select>
  </div>
    <button type="submit" class="pull-right btn btn-success">Dodaj atrybut </button>
</form> 
  </div>
</div>







{/if}
</div>







</div></div>


{/if}