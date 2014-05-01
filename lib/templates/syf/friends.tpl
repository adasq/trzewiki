{* {config_load file='lang.conf'} *}


{if isset($empty)}

	<p style="margin-top: 30px;" class="pinfo tcenter">
		<i>Brak dodatkowych informacji.</i>
	</p>

{else}		
		
		
		
		
		
<table>
{if isset($friends_mi_res)}


	{if isset($friends_mi_res[0])}
		<tr><td><p style="margin-top: 30px;" class="pinfo">
				Zaprosili Cię do znajomych:
				</p>	</td>
		
						
		
		 <td>
		{foreach $friends_mi_res[0] as $user}
		{include file="user.tpl"}
		{/foreach}
		</td>
		</tr>
	{/if}
	
	 

	
	{if isset($friends_mi_res[2])}
		
		<tr><td><p>Nie przyjęli Twojego zaproszenia:</p></td>
		<td>
		{foreach $friends_mi_res[2] as $user}
		{include file="user.tpl"}
		{/foreach}
		</td>
		</tr>
	{/if}
	

{if isset($friends_mi_res[3])}
		<tr><td><p style="margin-top: 30px;" class="pinfo">
				Usunęli Cię ze znajomych:
				</p></td>
		 <td>
		{foreach $friends_mi_res[3] as $user}
		{include file="user.tpl"}
		{/foreach}
		</td>
		</tr>
{/if}



{/if}



{if isset($friends_mi_req)}

	{if isset($friends_mi_req[0])}
		<tr><td>
<p class="pinfo">
				Zaprosiłeś:
				</p>
</td>
		 <td>
		{foreach $friends_mi_req[0] as $user}
		{include file="user.tpl"}
		{/foreach}
		</td>
		</tr>	
	{/if}
	
{*
	{if isset($friends_mi_req[666])}
		<tr><td><p>Masz w znajomych</p></td>
		 <td>
		{foreach $friends_mi_req[1] as $user}
		{include file="user.tpl"}
		{/foreach}
				</td>
		</tr>
	{/if}
*}	
	
	{if isset($friends_mi_req[2])}
		<tr><td><p style="margin-top: 30px;" class="pinfo">
				Nie dodali Cię do znajomych:
				</p></td>
		 <td>
		{foreach $friends_mi_req[2] as $user}
		{include file="user.tpl"}
		{/foreach}
				</td>
		</tr>
	{/if}
	

{if isset($friends_mi_req[3])}
		<tr><td><p style="margin-top: 30px;" class="pinfo">
				Usunąłeś ze znajomych:
				</p></td>
		 <td>
		{foreach $friends_mi_req[3] as $user}
		{include file="user.tpl"}
		{/foreach}
				</td>
		</tr>
{/if}

{/if}







 


</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
{/if}




