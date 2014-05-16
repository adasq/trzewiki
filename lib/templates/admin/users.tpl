<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="users/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowego</button>
</form> 
  </div>
</div>


{if isset($users)}
 
<div class="panel panel-default">
  <div class="panel-heading">Użytkownicy</div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>login</td>		<td>email</td>	 <td>last_name</td>	 <td>status</td>		<td></td>  	</tr>
 
	{foreach $users as $user} 
	<tr>  <td>{$user->login}</td>		<td>{$user->email}</td>	 <td>{$user->last_name}</td>	 <td>{$user->status}</td>		<td></td> 
	<td>

<div class="btn-group">
	<form style="float: left;" method="GET" action="users/edit/{$user->customer_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
	<form  style="float: left;"  method="GET" action="user/edit/1">
	 	<button type="submit" class="btn btn-danger">Usuń</button>
	</form>  
 
</div>

	</td>  	</tr>
	{/foreach}

</table>





  </div>
</div>










{/if}

