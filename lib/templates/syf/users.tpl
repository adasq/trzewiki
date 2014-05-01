{config_load file='lang.conf'}



<div   class="center transbg minh">


<form method="get" action="">
	<table class="center">
	<tr>
	<td><input class="finput" id="search-input" type="text" name="q"  value="{if isset($users_search)}{$users_search}{/if}" placeholder="Znajdź użytkownika..." size="40" tabindex="10" maxlength="250" /></td>
	<td><input class="fbutton" type="submit" value="{#USERS_find#}"/></td>
	</tr>			
	</table>
</form>
<div class="clr" style="margin-bottom: 30px;"></div>
{if isset($users_search_none)}
<p style="margin-top: 30px;" class="tcenter pinfo">
		<i>{#USERS_find_none#}</i>
</p>
{/if}



{if isset($users)}
<ul class="center" style="width: 80%">
	{foreach $users as $user} 
	<li>{include file="user.tpl"}</li>
	{/foreach}
</ul>
{/if}

<div class="clr" style="margin-bottom: 30px;"></div>

</div>