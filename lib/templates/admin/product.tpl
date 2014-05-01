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
    <input  value="{$product->product_no}" name="product_no" type="text" class="form-control" placeholder="product_no">
  </div>


	  <div class="form-group">
    <label>description</label>
    <input  value="{$product->description}" name="description" type="text" class="form-control" placeholder="description">
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
  <div class="panel-body">
  <form  method="GET" action="{#BASE_URL#}/admin/media/new/{$product->product_id}">
    <button type="submit" class="btn btn-success">Dodaj media </button>
</form> 
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  {foreach $medias as $media}  
<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" src="{$media->file_path}" alt="...">
  </a>
  <div class="media-body">
    <h4 class="media-heading">{$media->type} 
    <form style="float: right;" method="GET" action="{#BASE_URL#}/admin/media/delete/{$media->media_id}">
    <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    </h4>
  <a href="{$media->file_path}">{$media->file_path|truncate:60:'...'}</a>  
  </div>
</div>
  {/foreach}


  </div>
</div>
{/if}




</div>







</div></div>


{/if}