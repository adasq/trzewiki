 {config_load file='lang.conf'}




<div class="transbg minh">

{if isset($links)}
<ul class="link-list">
					{foreach $links as $link} 
					<li>
{include file="link.tpl"}
		
					</li>

					{/foreach}

</ul>

{else}
		
		<p style="margin-top: 30px;" class="tcenter pinfo">
		<i>{#READ_LATER_nolinks#}</i>	
</p>
				
{/if}



</div>





