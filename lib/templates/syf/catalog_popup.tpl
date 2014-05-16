{config_load file='lang.conf'}


<div class="blank" style="visibility: hidden;">
</div>	

<div id="catalogs-popup" class="center" style="visibility: hidden;">

<a href="#" id="popup-close" class="catalogs-popup-close fr">x</a>


{if isset($catalog_list)}

<div class="clr"></div>

<div   style="width: 300px;" class="center">
<input class="finput" style="padding: 0;"  type="text" id="taginput" maxlength="255" placeholder="Dodaj tagi." />
</div>

<p class="tcenter pinfo">
Dodaj ten link do katalogu:
</p>
 
		<ul  style="padding: 10px; margin: 10px 10px;" class="transbg center">
							{foreach $catalog_list as $catalog} 
							<li>
							<a id="cid-{$catalog->catalog_id}" style="padding-left:{math equation="x*10" x={$catalog->height}}px; " href="#" class="targetCatalog" >{$catalog->name}</a>					
							</li>
							{/foreach}
		</ul>
		{else}
		<p style="margin-top: 30px;" class="tcenter pinfo">
				<i>Brak katalogów.</i>
								</p>	
								
								
		<p class="tcenter pinfo">
				<a href="{#BASE_URL#}/catalogs/new" >Dodaj katalog.</a>
								</p>	
		{/if}
		
		
		
	
</div>