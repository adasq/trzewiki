{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


{if isset($media)}


<!-- <div class="panel panel-default">
  <div class="panel-body">
   {$product->toString()}
  </div>
</div> -->
{include file="admin/product_view.tpl" nocache} 

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">Wypełnij formularz</div>
  <div class="panel-body">


<form enctype="multipart/form-data" role="form" class="form" action="" method="POST">

<input type="hidden" name="media_id" value="{$media->media_id}">
 <input type="hidden" name="product_id" value="{$product->product_id}">
  
  <div class="form-group">
    <label>file_path</label>
    <input  value="{$media->file_path}" name="file_path" type="text" class="form-control" placeholder="file_path">
  </div>
  <div class="form-group">
    <label>type</label>
    <input  value="{$media->type}" name="type" type="text" class="form-control" placeholder="type">
  </div>

  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" name="file">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  

  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}