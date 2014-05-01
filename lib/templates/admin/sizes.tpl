

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="sizes/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowy</button>
</form> 
  </div>
</div>


{if isset($sizes)}
 
<div class="panel panel-default">
  <div class="panel-heading">Rozmiary
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>us</td>		<td></td>  	</tr>
	
<!-- size_id
manufacturer_id
us
uk
cm
euro
sex
deleted -->
 
	{foreach $sizes as $size} 
	<tr>  <td>{$size->size_id}</td>
	<td>

<div class="btn-group">
	<form style="float: left;" method="GET" action="sizes/edit/{$size->size_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
	<form  style="float: left;"  method="GET" action="sizes/edit/1">
	 	<button type="submit" class="btn btn-danger">Usuń</button>
	</form>  
 
</div>

	</td>  	</tr>
	{/foreach}

</table>

  </div>
</div>

{/if}