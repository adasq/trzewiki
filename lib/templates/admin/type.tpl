{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


{if isset($type)}

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">

    Dodaj nowy atrybut

    Edytuj dane atrybutu

  </div>
  <div class="panel-body">


<form role="form" class="form" action="" method="POST">
<input type="hidden" name="type_id" value="{$type->type_id}">
  
  <div class="form-group">
    <label>Nazwa</label>
    <input  value="{$type->type_name}" name="type_name" type="text" class="form-control" placeholder="Nazwa">
  </div>

  <div class="checkbox">
    <label>
      <input name="deleted" {if $type->deleted eq 1 } checked {/if} type="checkbox"> Oznacz jako usunięty
    </label>
  </div>
  

  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}