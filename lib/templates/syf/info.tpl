{config_load file= 'lang.conf' }
 
 


{include file="catalog_popup.tpl"}


 <div class="defsize transbg minh">
 
  <p class="pinfo tcenter">
	
	
	{if $action == 'about'}
	
	O nas!
	{elseif $action == 'rules'}
	Zasady korzystania z serwisu!
	
	{elseif $action == 'contact'}
	Kontakt!
	
	{elseif $action == 'faq'}
	Najczęściej zadawane pytania!
	{/if}
	
	</p>	
 
 
 
 </div>
