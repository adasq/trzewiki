{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


{if isset($manufacturer)}

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">Edytuj dane producenta</div>
  <div class="panel-body">


<form role="form" class="form" action="" method="POST">
<input type="hidden" name="manufacturer_id" value="{$manufacturer->manufacturer_id}">
  
  <div class="form-group">
    <label>name</label>
    <input  value="{$manufacturer->name}" name="name" type="text" class="form-control" placeholder="name">
  </div>

   <div class="form-group">
    <div class="checkbox">
    <label>
      <input name="deleted" {if $manufacturer->deleted eq 1 } checked {/if} type="checkbox"> Oznacz jako usunięty
    </label>
  </div>
    </div>
  

  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}