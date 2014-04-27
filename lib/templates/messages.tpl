{config_load file= 'lang.conf' }
 
 


{include file="catalog_popup.tpl"}


 <div id="messages" class="defsize transbg minh">
 	

	
	
  <p class="pinfo tcenter">
	POWIADOMIENIA {if isset($day)}(sprzed {$day} dni){/if}:
	</p>	
	

 <ul class="messages-list">

{if isset($messages)}

					{foreach $messages as $message} 
					
					
					
<li class="transbg{if isset($message["new"])} message-new{/if}">
 
{if isset($message["url"])}  

	<p class="pinfo">
		{if $message["group_name"] != null} [{$message["group_name"]}] {else} [znajomi] {/if}
		użytkownik {$message["username"]}
		{if $message["mode"] == 0}
		    udostępnił
		{elseif $message["mode"] == 1 }
		   dodał do przeczytania na później
		{elseif $message["mode"] == 2 }
		   dodał do katalogów
		{/if}
		 link: 
	</p>
	
	
	{assign var=link value=$message} 
	{include file="link.tpl"}
	
	{*
	 <p class="pinfo">
	<span title="Dnia {$message["last_activity"]}">{$message["last_activity"]|formatdate}</span>
	</p>	
	*}
	<br/>

{*==========================================   obsługa znajomych ================================= *}
{elseif isset($message["friend_id"]) }
	<div>
		 <p class="pinfo">
			  
			  <span class="fr" title="Dnia {$message["last_activity"]}">{$message["last_activity"]|formatdate}</span>
		
										 {* FRIENDS_INVITE *}
			{if $message["mode"] == 0}
			
				{if $user->user_id == $message["user1"] }
					Zaprosiłeś użytkownika {$message["user2name"]} do znajomych.
				{elseif $user->user_id == $message["user2"] }
					Użytkownik {$message["user1name"]} zaprosił Cię do znajomych.
				{else}
					
				{/if}
			
			{elseif $message["mode"] == 1 }			 {* FRIENDS_ACCEPT *}
			
			
					{if $user->user_id == $message["user1"] }
						{$message["user2name"]} przyjął Twoje zaproszenie do znajomych.
					{elseif $user->user_id == $message["user2"] }
						Dodałeś użytkownika {$message["user1name"]} do znajomych.
					{else}
						użytkownicy {$message["user1name"]}, {$message["user2name"]} są teraz znajomymi.
					{/if}
			
			
			
			{elseif $message["mode"] == 2 }		 {* FRIENDS_REJECT *}
			
					{if $user->user_id == $message["user1"] }
						{$message["user2name"]} odrzucił Twoją propozycję dodania do znajomych.
					{elseif $user->user_id == $message["user2"] }
						Odrzuciłeś propozycję dodania do znajomych przez użytkownika {$message["user1name"]}.
					{else}
					 
					{/if}
					
			
			{elseif $message["mode"] == 3 }		{* FRIENDS_DELETE *}
			
					{if $user->user_id == $message["user1"] }
						Usunąłeś użytkownika {$message["user2name"]} ze znajomych.
					{elseif $user->user_id == $message["user2"] }
						Użytkownik {$message["user1name"]} usunął Cię ze znajomych.
					{else}
						 
					{/if}
			{else}
			{/if}
 
 </p>	
  </div>
{*==========================================   obsługa akcji grup ================================= *}							
{elseif isset($message["gm_id"]) }	
 	<div>
		 <p class="pinfo">
			  
			  <span class="fr" title="Dnia {$message["last_activity"]}">{$message["last_activity"]|formatdate}</span>
		
		
		{if $message["mode"] == 0}			{* GROUPS_APPLY *}
		
		 		{if $user->user_id == $message["user_id"] }
					Złożyłeś podanie o przyjęcie do grupy {$message["group_name"]}.
				{elseif $user->user_id == $message["author_id"] }
					Użytkownik {$message["who"]} chce dołączyć do grupy {$message["group_name"]}.
				{else}
			 
				{/if}
		 
		 {elseif  $message["mode"] == 1}	 {* GROUPS_ACCEPT *}
		 
		  		{if $message["author_id"] == $message["user_id"] &&  $user->user_id == $message["user_id"]  }
					Utworzyłeś nową grupę: {$message["group_name"]}.
				{elseif $user->user_id == $message["user_id"] }
					Zostałeś przyjęty do grupy {$message["group_name"]}.
				{else}
					Użytkownik {$message["who"]} został przyjęty do grupy {$message["group_name"]}.
				{/if}
						
		 {elseif  $message["mode"] == 2}	 {* GROUPS_REJECT *}
		 
				 {if  $user->user_id == $message["user_id"]  }
					Nie zostałeś przyjęty do grupy {$message["group_name"]}.
				{else}
				 
				{/if}
		
		 
		 {elseif  $message["mode"] == 3}	 {* GROUPS_LEAVE *}
	  
		  	{if  $user->user_id == $message["user_id"]  }
				Opóściłeś grupę {$message["group_name"]}.
			{else}
				Użytkownik {$message["who"]} opóścił grupę {$message["group_name"]}.
			{/if}
  
		{elseif  $message["mode"] == 4}	 {* GROUPS_DELETE *}
				{if  $user->user_id == $message["user_id"]  }
					Zostałeś usunięty z grupy {$message["group_name"]}.
				{else}
					Użytkownik {$message["who"]} został usunięty z grupy {$message["group_name"]}.
				{/if}
		{else}
		{/if}
 </p>	
  </div>

 {/if}
 
 
</li>

{/foreach}

<li>
<div class="fr">

	{if isset($day)} <a href="{#BASE_URL#}/home?day={$day}">starsze</a> {else} <a href="{#BASE_URL#}/home?day=1">starsze</a> {/if} 	

	</div>
</li>

{else}
 <p class="pinfo tcenter">
 <i>brak powadomień!</i>
 </p>
 
 
 <div class="fr">

	{if isset($day)} <a href="{#BASE_URL#}/home?day={$day}">starsze</a> {else} <a href="{#BASE_URL#}/home?day=1">starsze</a> {/if} 	

	</div>
 
					
{/if}

</ul>

 </div>
