<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="content/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowego</button>
</form> 
  </div>
</div>

{if isset($contents)}
 
<div class="panel panel-default">
  <div class="panel-heading">Edytuj treści statyczne</div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>nazwa</td>		<td>treść</td>		<td></td>  	</tr>

	{foreach $contents as $content} 
	<tr>  <td>{$content->content_key} </td>		<td>{$content->content_value}</td>		<td>

<div class="btn-group">
	<form style="float: left;" method="GET" action="content/edit/{$content->content_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
	<form  style="float: left;"  method="GET" action="content/edit/1">
	 	<button type="submit" class="btn btn-danger">Usuń</button>
	</form>  
 
</div>

	</td>  	</tr>
	{/foreach}

</table>





  </div>
</div>










{/if}

