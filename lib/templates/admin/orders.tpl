<div class="page-header">
  <h1>Zamówienia <small>Realizuj zamówienia klietów</small></h1>
</div>




{if isset($transactions)}
 
<div class="panel panel-default">
  <div class="panel-heading">Zamówienia
 
  </div>
  <div class="panel-body">
    

<table class="table table-striped">
<tr>  <td>Klient</td>		<td>Status</td>   <td>Kiedy</td>	</tr>
 
	{foreach $transactions as $transaction} 


	<tr>  


<td> {$transaction->customer->login}	</td>	


		<td>2	</td>	

		
<td>3 </td>


	</tr>
	{/foreach}

</table>

  </div>
</div>
{else}
sss
{/if}