{config_load file='lang.conf'}


{include file="catalog_popup.tpl"}



{if isset($catalog_msg)}<h3 class="{if $catalog_msg["error"]}colorerror{else}colorsucces{/if}"  >{$catalog_msg["message"]}</h3>{/if}


<div style="margin: 0 auto; width: 960px; min-height: 400px;">

<div class="center" style="margin-bottom: 30px;">
<form method="get" action="{#BASE_URL#}/catalogs">
	<table class="center">
	<tr>
	<td><input id="search-input" type="text" class="finput"  name="search"  value="{if isset($search)}{$search}{/if}" placeholder="Znajdź linki..." size="40" tabindex="10" maxlength="250" /></td>
	<td><input class="fbutton" type="submit" value="{#SEARCH_search#}"/></td>
	</tr>			
	</table>
</form>
</div>



{* lewy div !!!!!!!!!!! *}
<div id="catalogs" class="fl transbg tcenter" style=" ">
		<div style="width: 100%; height: 40px;">
		</div>
		{if isset($catalog_list)}
			<ul style="text-align: left; margin: 10px 5px;">
								{foreach $catalog_list as $catalog} 
								<li>
								<a style="{if isset($catalog_obj) && $catalog->catalog_id == $catalog_obj->catalog_id }color: black;{/if} padding-left:{math equation="x*10" x={$catalog->height}}px;" 
								href="{#BASE_URL#}/catalogs/{$catalog->catalog_id}">{$catalog->name}</a>					
								</li>
								{/foreach}
			</ul>
		{else}
		
		
		
				<p style="margin-bottom: 30px;" class="tcenter pinfo">
				<i>brak katalogow.</i>	
				</p>		
		{/if}	
		<a class="buttonx" href="{#BASE_URL#}/catalogs/new">+ główny katalog</a>
</div>
	
	
	
	
{* prawy div !!!!!!!!!!! *}
<div class="fl transbg" style="width: 760px; min-height: 500px;">
	
	

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
	
	
{else}


	
{if isset($catalog_showform)}
				<div class="center formdiv">
					<form action="" method="post">
					<table class="center">
					<tr><td>Nazwa katalogu:</td>
					<td><input type="text" class="finput" name="catalog_newname" value="{if isset($catalog_newname)}{$catalog_newname}{/if}" size="25" tabindex="10" maxlength="32" /></td>
					<td id="catalog_err_newname">{if isset($catalog_err_newname)}  <p class="formerror">{$catalog_err_newname}</p>  {/if}
					</td></tr>
					<tr><td colspan="3" align="center">
					<input type="hidden" name="submitted" value="true"/>
					<input  class="fbutton" type="submit" value="Dodaj katalog!" />
					</td></tr>
					</table>
					</form>
			</div>
{else}		
		
		{if isset($catalog_obj)}		
		
			<div style="width: 100%; height: 40px;">				
			<h1  class="fl"><a href="{#BASE_URL#}/catalogs/{$catalog_obj->catalog_id}">{$catalog_obj->name}</a></h1>	
			<a class="fr buttonx" href="{#BASE_URL#}/{if isset($catalog_obj)}catalogs/{$catalog_obj->catalog_id}/new {else}
			 catalogs?new
			 {/if}
			 ">+ nowy katalog</a>			
		
			<form class="fr" action="" method="post">
			<fieldset>
			<input type="hidden" name="delcat" value="{$catalog_obj->catalog_id}"/>
			<input type="hidden" name="submitted" value="true"/>
			<input class="buttonx"  type="submit" value="usuń katalog"/>
			</fieldset>
			</form>
	
			</div>
	
	
			{if isset($catalog_links)}
						<ul class="link-list">
							{foreach $catalog_links as $link} 
								<li>
								{include file="link.tpl"}					
								</li>
							{/foreach}
						</ul>
			{else}
						<p style="margin-top: 30px;" class="tcenter pinfo">
				<i>Brak linków.</i>
				</p>	
			{/if}
	
	
		{else}
		
		<p style="margin-top: 30px;" class="tcenter pinfo">
		Utwórz nowy katalog, <a href="{#BASE_URL#}/catalogs/new">kliknij tutaj</a>.
		</p>
		<div class="center" style="background-repeat:no-repeat; background-position:center;  background-image: url('{#BASE_URL_IMAGES#}/icons/big-catalog.png'); width: 760px; height: 400px;">
		</div>
	
				{* katalog nie istnieje! *}
		{/if}
			
{/if} {* show form *}			
				
				
{/if}				
				
				
		
				
</div> {* prawy div *}
	
	

</div> {* calosc div *}

