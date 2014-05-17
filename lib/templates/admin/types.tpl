<div class="page-header">
  <h1>Cechy obuwia <small>Zarządzaj chechami / atrybutami obuwia!</small></h1>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="types/new">
	 	<button type="submit" class="btn btn-success">Dodaj atrybut</button>
</form> 
  </div>
</div>


{if isset($types)}
 
<div class="panel panel-default">
  <div class="panel-heading">Atrybuty
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>name</td>		<td></td>  	</tr>
 
	{foreach $types as $type} 
	<tr>  <td>{$type->type_name}</td>
	<td>

<div class="btn-group">
	<form style="float: left;" method="GET" action="types/edit/{$type->type_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form> 
 
</div>

	</td></tr>
	{/foreach}

</table>

  </div>
</div>

{/if}