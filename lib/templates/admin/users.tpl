
<div class="page-header">
  <h1>Użytkownicy <small>Zarządzaj danymi klientów!</small></h1>
</div>


<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="users/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowego klienta</button>
</form> 
  </div>
</div>


{if isset($users)}
 
<div class="panel panel-default">
  <div class="panel-heading">Użytkownicy</div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>Login</td>		<td>Adres e-mail</td>	 <td>Nazwisko</td>	 <td>Status</td>		<td></td>  	</tr>
 
	{foreach $users as $user} 
	<tr>  <td>{$user->login}</td>		<td>{$user->email}</td>	 <td>{$user->last_name}</td>	 <td><b>{$user->status}</b></td>		
	<td>
<div class="btn-group">
	<form style="float: left;" method="GET" action="users/edit/{$user->customer_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form> 
</div>
	</td>  






		</tr>
	{/foreach}

</table>





  </div>
</div>










{/if}

