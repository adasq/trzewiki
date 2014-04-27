{* {config_load file='lang.conf'} *}


<div {if isset($link["lo_id"])}id="loid-{$link["lo_id"]}"{/if} class="link">

<div class="fl link-inner">



<div class="fl" style="width: 600px;">
<img width="16" height="16" class="fl" alt="favicon" src="{$link["favicon"]}"/> 
<a target="_blank" href="{$link["url"]}">{$link["url"]|truncate:80:"...":true}</a>
<p>{$link["description"]|truncate:80:"...":true}</p>
</div>


<div class="fr" style="width: 100px;">
{if isset($watch_later_links)}
		<form action="" method="post">
		<fieldset>
		<input type="hidden" name="wlid" value="{$link["wl_id"]}"/>
		<input class="buttonx" type="submit" value="{#READ_LATER_delete#}"/>
		</fieldset>
		</form>
		
	{else if isset($catalogs_links)}
		<form action="" method="post">
		<fieldset>
		<input type="hidden" name="dellink" value="{$link["link_id"]}"/>
		<input type="hidden" name="submitted" value="true"/>
		<input class="buttonx" type="submit" value="usuń"/>
		</fieldset>
		</form>
		 
		
		<button id="lid-{$link["link_id"]}" class="addLink buttonx">skopiuj</button>
		
	{else if isset($messages)}
		<button id="lid-{$link["link_id"]}" class="addLink buttonx">dodaj</button>
	
	{/if}
</div>






</div> {* .inner-link *}

{if isset($message) && isset($link["last_activity"]) }

	<p style="bottom:1px;" class="fl linfo">
		<span title="{$link["last_activity"]}">Dodano {$message["last_activity"]|formatdate} </span>
		
	</p>
{/if}


{if isset($watch_later_links) or isset($catalogs_links) or isset($search)}
<p style="bottom:1px;" class="fl linfo">
dodano 
{$link["date"]} 
{if isset($search)} do katalogu <a target="_blank"  href="{#BASE_URL#}/catalogs/{$link["catalog_id"]}#loid-{$link["lo_id"]}">{$link["catalog_name"]}</a>{/if}
 | 
 <a target="_blank" href="{$link["server"]}">{$link["server"]}</a> 
 
 
 {if isset($link["tags"])}
	
	{if $link["tags"] != NULL}

		
		| tagi: 
					{foreach $link["tags"] as $tag} 	
				<span ><a href="{#BASE_URL#}/search?q={$tag}">{$tag}</a></span>						
					{/foreach} 			
	{else}
	{/if}
 
 </p>
 



{else}

{/if}



{else}

{/if}




</div>{* .link *}











