

{if isset($profile_msg)}
<h3 class="{if $profile_msg["error"]}colorerror{else}colorsucces{/if}"  >{$profile_msg["message"]}</h3>
{/if}


<div style="height: 60px;">

{if isset($friend_text)}<p class="fl pinfo">{$friend_text}</p>{/if}
{if isset($friend_form)}

	{foreach $friend_form as $form} 
	<form style="margin-left:10px;" class="fr" method="post" action="">
	<input type="hidden" name="faction" value="{$form[1]}">
	{* <input type="hidden" name="user" value="{$person->username}">  *}
	<input class="fbutton" type="submit" value="{$form[0]}"/>
	</form>
	{/foreach}


{/if}
</div>


 
 
 <div class="fl transbg" style="text-align: center; margin-right: 10px; width: 190px; min-height: 300px;">
 
 <img style="margin-top: 10px;" width=100 height=100 src="{#BASE_URL_IMAGES#}/avatars/{$person->avatar}"/>
 
 
 	<p class="tcenter pinfo">
		
			 <a title="" href="{#BASE_URL#}/user/{$person->username}"> {$person->username}</a>
				</p>	

 
 
 
 <ul style="padding: 10px 40px; text-align: left;">
					  <li><a href="{#BASE_URL#}/user/{$person->username}">Informacje</a></li>
					  <li><a href="{#BASE_URL#}/user/friends/{$person->username}">Znajomi</a></li>
					  <li><a href="{#BASE_URL#}/user/groups/{$person->username}">Grupy</a></li>
{if isset($myprofile)}<li><a href="{#BASE_URL#}/user/mail/{$person->username}">E-mail</a></li>{/if}
{if isset($myprofile)}<li><a href="{#BASE_URL#}/user/password/{$person->username}">Hasło</a></li>{/if}
{if isset($myprofile)}<li><a href="{#BASE_URL#}/user/avatar/{$person->username}">Avatar</a></li>{/if}

 

</ul>
 
 
 
 </div>
 
 
 {* prawy div*}
<div class="fl transbg" style="width: 760px; min-height: 500px;">
 

{if isset($action)}



{if $action == 'mail'}

									<p style="margin-top: 30px;" class="tcenter pinfo">
				Zmień swój adres e-mail:				</p>	
					
					<form action="" method="post">
					<table class="center">
				
					
					<tr><td>e-mail:</td><td><input class="finput" type="text" name="chg_mail" value="{if isset($chg_mail)}{$chg_mail}{/if}" size="25" tabindex="10" maxlength="32" /></td>
					<td id="err_mail">{if isset($err_mail)}  <p class="formerror">{$err_mail}</p>  {/if}</td></tr>
					
					<tr><td>ponownie:</td><td><input class="finput" type="text" name="chg_mail2" value="{if isset($chg_mail2)}{$chg_mail2}{/if}" size="25" tabindex="10" maxlength="32" /></td>
					<td id="err_mail2">{if isset($err_mail2)} <p class="formerror"> {$err_mail2}</p>  {/if}</td></tr>

					<tr>
						<td colspan="3" align="center">
						<input type="hidden" name="submitted" value="true"/>
						<input class="fbutton" type="submit" value="Zmień" />
						</td>
					</tr>
					</table>
					</form>			








{elseif $action == 'avatar'}

								<p style="margin-top: 30px;" class="tcenter pinfo">
				Zmień swój avatar:
				</p>	

					<form action="" method="post">
					<table class="center">
					<tr><td>link:</td><td><input class="finput" type="text" name="chg_avatar"  value="{if isset($chg_avatar)}{$chg_avatar}{/if}" size="40" tabindex="10" maxlength="250" /></td>
					<td id="err_avatar">{if isset($err_avatar)}  <p class="formerror">{$err_avatar}</p>  {/if}</td>
					</tr>
					
					<tr>
						<td colspan="3" align="center">
						<input type="hidden" name="submitted" value="true"/>
						<input class="fbutton" type="submit" value="Zmień" />
						</td>
					</tr>
					</table>
					</form>			

{elseif $action == 'password'}

					<p style="margin-top: 30px;" class="tcenter pinfo">
				Zmień swoje hasło:
				</p>	
			

					<form action="" method="post" >
					<table class="center">
					
					<tr><td>stare:</td><td><input class="finput" type="password" name="chg_password"  value="{if isset($chg_password)}{$chg_password}{/if}" size="25" tabindex="10" maxlength="32" /></td>
										<td id="err_password">{if isset($err_password)}  <p class="formerror">{$err_password}</p>  {/if}</td>
					</tr>
					
					<tr><td>nowe:</td><td><input class="finput" type="password" name="chg_password_new"  value="{if isset($chg_password_new)}{$chg_password_new}{/if}" size="25" tabindex="10" maxlength="32" /></td>
										<td id="err_password_new">{if isset($err_password_new)}  <p class="formerror">{$err_password_new}</p>  {/if}</td>
					</tr>
					
					<tr><td>ponowine:</td><td><input class="finput" type="password" name="chg_password_new2"  value="{if isset($chg_password_new2)}{$chg_password_new2}{/if}" size="25" tabindex="10" maxlength="32" /></td>
										<td id="err_password_new2">{if isset($err_password_new2)}  <p class="formerror">{$err_password_new2}</p>  {/if}</td>
					</tr>
					
					
					<tr>
						<td colspan="3" align="center">
						<input type="hidden" name="submitted" value="true"/>
						<input class="fbutton" type="submit" value="Zmień" />
						</td>
					</tr>
					</table>
					</form>	
 		
{elseif $action == 'friends'}					
			
				<p style="margin-top: 30px;" class="tcenter pinfo">
				Znajomi:
				</p>	
			
			
				{if isset($friends)}
						{foreach $friends as $user} 
										{include file="user.tpl"}				
						{/foreach}
				{else}
								<p class="tcenter pinfo">
				<i>Brak znajomych.</i>
				</p>			
				{/if}
				
				
				{if isset($myprofile)}
				<div class="clr"></div>
				<p style="margin-top: 30px;" class="tcenter pinfo">
				Dodatkowe informacje:
				</p>
				
				<div class="clr"></div>
				{include file="friends.tpl"}
				
				{else}
				{* <div class="clr"></div><p style="margin-top: 30px;" class="tcenter pinfo"><i>Brak dodatkowych informacji.</i></p> *}		
				{/if}
									
{elseif $action == 'groups'}	

				<p style="margin-top: 30px;" class="tcenter pinfo">
				Grupy:
				</p>	

			{if isset($groups_belongto)}
							<p style="margin-top: 30px;" class="tcenter pinfo">
							Grupy użytkownika:
							</p>	
									{foreach $groups_belongto as $group} 
													{include file="group.tpl"}				
									{/foreach}
			{else}
			
							<p style="margin-top: 30px;" class="tcenter pinfo">
							<i>użytkownik nie należy do żadnej z grup</i>
							</p>		
			{/if}
					<div style="clear: both;"></div>	
			{if isset($groups_own)}
			
							<p style="margin-top: 30px;" class="tcenter pinfo">
							Stworzone przez użytkownika:
							</p>
									{foreach $groups_own as $group} 
													{include file="group.tpl"}				
									{/foreach}
			{else}
		
							<p style="margin-top: 30px;" class="tcenter pinfo">
							Użytkownik nie stworzył żadnej z grup
							</p>		
			{/if}				

{/if}	

{else}

<div class="center transbg" style="padding: 30px 0px ;">
<table class=" center">		
		<tr>	 <td>nick:</td>	<td>{$person->username} </td>	</tr>	
		{if isset($myprofile)}<tr>	 <td>e-mail:</td>	<td>{$person->mail}</td>	</tr>{/if}	
		<tr>	 <td>zarejestrowany:</td>	<td>{$person->reg_date}</td>	</tr>
</table>




</div>

<p class="pinfo ">

{if isset($myprofile)}		
Zmień adres e-mail <span><a href="{#BASE_URL#}/user/mail/{$user->username}">tutaj</a></span>.<br/>
Swój avatar możesz zmienić <span><a href="{#BASE_URL#}/user/avatar/{$user->username}">tutaj</a></span>.<br/>
Przeglądaj listę <span><a href="{#BASE_URL#}/user/friends/{$user->username}">swoich znajomych</a></span>. <br/>
Przeglądaj <span><a href="{#BASE_URL#}/user/groups/{$user->username}">grupy</a></span> do których należysz i które stworzyłeś.<br/>
W celu zwiększenia bezpieczeństwa,  <span><a href="{#BASE_URL#}/user/password/{$user->username}">zmieniaj swoje hasło</a></span> przynajmniej raz w miesiącu.<br/>




{else}
Sprawdź do jakich <span><a href="{#BASE_URL#}/user/groups/{$person->username}">grup</a></span> należy {$person->username} <br/>
Przeglądaj <span><a href="{#BASE_URL#}/user/friends/{$person->username}">znajomych</a></span> użytkownika.

{/if}	


</p>



{/if}




</div>