{* {config_load file='lang.conf'} *}




<div style="height: 60px;">

{if isset($group_mygroup)}

	{*jestem autorem grupy*}

{else}

	{*NIE jestem autorem grupy*}
	
		{if isset($group_userstatus)}
		
				{if $group_userstatus === '0'}

				    <p class="fl pinfo">{#GROUP_user_apply_info#}</p>
	
				{elseif $group_userstatus === '1'}		
					<p class="fl pinfo">{#GROUP_user_member_info#}</p>    
					<form  class="fr" method="post" action="">
					<input type="hidden" name="action" value="3" />
					<input class="fbutton" type="submit" value="{#GROUP_user_leave#}" />
					</form>	    
				{else}
				    <p class="fl pinfo">{#GROUP_user_notmember_info#}</p>	    
					<form  class="fr" method="post" action="">
					<input type="hidden" name="action" value="0"/>
					<input class="fbutton" type="submit" value="{#GROUP_user_join#}"/>
					</form>	 
				{/if}
		{else}	
			 <p class="fl pinfo">{#GROUP_user_notmember_info#}</p>	    
					<form  class="fr" method="post" action="">
					<input type="hidden" name="action" value="0"/>
					<input class="fbutton" type="submit" value="{#GROUP_user_join#}"/>
					</form>	 	
				
		{/if}

{/if}

</div>



<div class="fl transbg" style="overflow: hidden; text-align: center; margin-right: 10px; width: 190px; min-height: 300px;">




	<img style="margin-top: 20px;" alt="{$group->group_name}" src="{#BASE_URL_IMAGES#}/groups/{$group->image}"/>
	
	<p class="tcenter pinfo">			
			<a title="{#GROUP_view_profile#} {$group->group_name}" href="{#BASE_URL#}/group/{$group->group_name}">{$group->group_name}</a>		
	</p>	
	
 	
	<table style="margin-top: 10px; text-align: left;"> 
	<tr><td colspan="2"></td></tr>
	
	<tr> <td>{#GROUP_group_author#}: </td> <td><a title="{#USER_view_profile#} {$group->author_name}" href="{#BASE_URL#}/user/{$group->author_name}">{$group->author_name}</a></td></tr> 
	<tr><td>{#GROUP_group_create_date#}:</td><td>{$group->create_date}</td></tr>
	<tr><td>{#GROUP_group_count#}:</td><td>{$group->count} {#GROUP_group_count_members#}</td></tr>
	</table>
	
</div>
	
	<div class="fl transbg" style="width: 760px; min-height: 500px;">


<p style="margin-top: 30px;" class="pinfo">
				Opis grupy: {$group->description}
				
				</p>
				

	{*czlonkowie*}
	{if isset($group_members)}	
		
		<p style="margin-bottom: 30px;" class="tcenter pinfo">
				{#GROUP_group_members#} ({$group->count} {#GROUP_group_count_members#}):
				
				</p>
		
		
		{foreach $group_members as $user}
			{include file="user.tpl"}
		{/foreach}
	{else}
	
			<p style="margin-top: 30px;" class="tcenter pinfo">
				<i>{#GROUP_group_nomembers#}</i>	
				</p>
	
	{/if}
	
	
	{*potencjalni kandydaci, wyswietlani autorowi*}
	{if isset($group_mygroup)}
		{if isset($group_others)}
				{if isset($group_others[0])}
		 
		 <div class="clr"></div>		
					
					<p style="margin-bottom: 30px;" class="tcenter pinfo">
						{#GROUP_group_wantjoin#}:
					</p>
					
					
					{foreach $group_others[0] as $user}	
						{include file="user.tpl"}
					{/foreach}
		{/if}
			

		{else}	
		{/if}
	{else}
	{/if}
 
 
 </div>


