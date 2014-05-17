{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}

<form role="form" class="form" action="" method="POST">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> 

       {if $content->content_id}
      Edytuj dane dotyczące treści
   {else}
   Dodaj nową treść
     {/if}
    </h3>
  </div>
  <div class="panel-body">

  <div class="form-group">
  	 <input name="content_key" type="text" class="form-control" value="{$content->content_key}" placeholder="nazwa">
</div>

  <div class="form-group">
  		  <textarea rows=20 name="content_value" type="text" class="form-control" placeholder="treść">{$content->content_value}</textarea>
</div>

  <div class="form-group">
    <div class="checkbox">
    <label>
      <input name="deleted" {if $content->deleted eq 1 } checked {/if} type="checkbox"> Oznacz jako usunięty
    </label>
  </div>
    </div>


  <div class="form-group pull-right">  			
	 <button type="submit" class="btn pull-right btn-success">Zapisz</button>

</div>

  </div>
</div>
</form>
