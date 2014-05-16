{config_load file='lang.conf'}


<div   class="center transbg minh">

<a class="buttonx" href="{#BASE_URL#}/newgroup">{#GROUP_create_new#}</a>
<a class="buttonx" href="{#BASE_URL#}/groups?all">Pokaż wszystkie</a>


<form method="get" action="">
	<table class="center">
	<tr>
	<td><input id="search-input" class="finput" type="text" name="search"  value="{if isset($groups_search)}{$groups_search}{/if}" size="40" tabindex="10"  placeholder="Znajdź grupę..." maxlength="250" /></td>
	<td><input class="fbutton" type="submit" value="{#GROUP_find#}"/></td>
	</tr>			
	</table>
</form>

<div class="clr" style="margin-bottom: 30px;"></div>

{if isset($groups_search_none)}
<p style="margin-top: 30px;" class="tcenter pinfo">
		<i>{#GROUP_find_none#}</i>
</p>

{/if}






{if isset($groups)}
<ul class="center" style="width: 80%">
	{foreach $groups as $group} 
		<li>{include file="group.tpl"}</li> 	
	{/foreach}
</ul>
{/if}

<div class="clr"></div>

</div>