<div class="page-header">
  <h1>Zamówienia <small>Realizuj zamówienia klietów</small></h1>
</div>




{if isset($transactions)}
 
<div class="panel panel-default">
  <div class="panel-heading">Zamówienia
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>Klient</td>		<td>Status</td>   <td>Kiedy</td><td></td>	</tr>
 
	{foreach $transactions as $transaction} 


	<tr>  


<td> <a href="{#BASE_URL#}/admin/users/edit/{$transaction->customer->customer_id}">{$transaction->customer->first_name} {$transaction->customer->last_name}</a>	</td>	


		<td>

{$transaction->status}
			</td>	

		
<td> {$transaction->start_date} </td>


<td> 

<div class="btn-group">
	<form style="float: left;" method="GET" action="orders/edit/{$transaction->transaction_id}">
		<button type="submit" class="btn btn-default">Więcej</button>
	</form>
 
</div>

</td>


	</tr>
	{/foreach}

</table>

  </div>
</div>
{else}
sss
{/if}