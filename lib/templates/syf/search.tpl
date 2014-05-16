{config_load file='lang.conf'}


<div class="center transbg minh" style="margin-bottom: 30px;">
<form method="get" action="">
	<table class="center">
	<tr>
	<td><input id="search-input" type="text" class="finput"  name="q"  value="{if isset($search)}{$search}{/if}" placeholder="Znajdź linki..." size="40" tabindex="10" maxlength="250" /></td>
	<td><input class="fbutton" type="submit" value="{#SEARCH_search#}"/></td>
	</tr>			
	</table>
</form>


{if isset($links)}
	
<p style="margin-top: 30px;" class="tcenter pinfo">
				Znalezione linki:
				</p>	

	<ul class="link-list">					
		{foreach $links as $link} 
				<li>{include file="link.tpl"}</li>	
		{/foreach}					
	</ul>


	
{elseif isset($search)}

<p style="margin-top: 30px;" class="tcenter pinfo">
		<i>Nie znaleziono żadnych linków.</i>
</p>

{/if}




</div>



