

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="manufacturers/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowego</button>
</form> 
  </div>
</div>


{if isset($manufacturers)}
 
<div class="panel panel-default">
  <div class="panel-heading">Producenci
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>name</td>		<td></td>  	</tr>
 
	{foreach $manufacturers as $manufacturer} 
	<tr>  <td>{$manufacturer->name}</td>
	<td>

<div class="btn-group">
	<form style="float: left;" method="GET" action="manufacturers/edit/{$manufacturer->manufacturer_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
	<form  style="float: left;"  method="GET" action="manufacturers/edit/1">
	 	<button type="submit" class="btn btn-danger">Usuń</button>
	</form>  
 
</div>

	</td>  	</tr>
	{/foreach}

</table>

  </div>
</div>

{/if}