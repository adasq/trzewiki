{* {config_load file='lang.conf'} *}






{if isset($catalog_list)}
<ul style="background-color: #000;">
					{foreach $catalog_list as $catalog} 
					<li>
					<a style="padding-left:{math equation="x*10" x={$catalog->height}}px; " href="">{$catalog->name}</a>					
					</li>
					{/foreach}


</ul>
{else}
		brak katalogow!			
{/if}







