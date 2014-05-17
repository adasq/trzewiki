<div class="page-header">
  <h1>Logi <small>Przeglądaj aktywności dotyczące użytkowników!</small></h1>
</div>




{if isset($logs)}
 
<div class="panel panel-default">
  <div class="panel-heading">Logi
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>Kto</td>		<td>Akcja</td>   <td>Kiedy</td>	</tr>
 
	{foreach $logs as $log} 


	<tr>  


<td>
	{if isset($log->admin)} 

		
		[ADMINISTRATOR]:<i> {$log->admin->first_name} {$log->admin->last_name}</i>

	{elseif isset($log->client)}

		 <a href="{#BASE_URL#}/admin/users/edit/{$log->client->customer_id}"> {$log->client->first_name} {$log->client->last_name} </a>
 
	{else}
		<i>nikt</i>
	{/if}
		
	</td>	


		<td> {$log->action}</td>	

		
<td> {$log->custom3}</td>


	</tr>
	{/foreach}

</table>

  </div>
</div>
{else}
sss
{/if}