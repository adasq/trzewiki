{config_load file='lang.conf'}
	
	
<div class="fl user-ent">
<div class="user-ent-inner">
		<a title="{#USER_view_profile#} {$user->username}" href="{#BASE_URL#}/user/{$user->username}"><img width="100" height="100" alt="{$user->username}" src="{#BASE_URL_IMAGES#}/avatars/{$user->avatar}"/></a>
		<a title="{#USER_view_profile#} {$user->username}" href="{#BASE_URL#}/user/{$user->username}">{$user->username}</a>
		
		
		{if isset($group_mygroup)}
<div style="margin-top: 10px;">
			{if $user->mode === '1'}
			
						<form method="post" action="">
						<fieldset>
							<input type="hidden" name="action" value="4" />
							<input type="hidden" name="user" value="{$user->username}" />
							<input class="buttonx" type="submit" value="{#GROUP_user_kick#}"/>
							</fieldset>
						</form>	  
			{/if}
			{if $user->mode === '0'}
						<form method="post" action="">
						<fieldset>
							<input type="hidden" name="action" value="1" />
							<input type="hidden" name="user" value="{$user->username}" />
							<input class="buttonx" type="submit" value="{#GROUP_user_add#}" />
							</fieldset>
						</form>	
						<form method="post" action="">
						<fieldset>
							<input type="hidden" name="action" value="2" />
							<input type="hidden" name="user" value="{$user->username}" />
							<input class="buttonx" type="submit" value="{#GROUP_user_reject#}" />
							</fieldset>
						</form>	  
			{/if}
</div>
{/if}
</div></div>