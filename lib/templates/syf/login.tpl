{config_load file='lang.conf'}



<div class="center transbg formdiv">


<form action="" method="post">
<table class="center">
{if isset($login_error)}   <tr><td colspan="2" align="center"> <p class="formerror">{$login_error}</p> </td></tr> {/if}
<tr>
<td>{#LOGIN_username#}:</td>
<td><input type="text" class="finput"  name="log_username" id="username" value="{if isset($log_username)}{$log_username}{/if}" size="25" tabindex="10" maxlength="32" /></td>
</tr>


<tr><td>{#LOGIN_password#}:</td><td><input type="password" class="finput" name="log_password" id="pswd" value="{if isset($log_password)}{$log_password}{/if}" size="25" tabindex="10" maxlength="32" /></td></tr>



<tr>
<td colspan="2" align="center">
<input type="hidden" name="submitted" value="true"/>
<input class="fbutton" type="submit" value="{#LOGIN_login#}" /></td>
</tr>


</table>

</form>

<p style="margin-top: 30px;" class="tcenter pinfo">Jeśli jeszcze nie masz konta <a href="{#BASE_URL#}/register">zarejestruj się</a>.
<br/>
Zapomniałeś hasła? nic straconego! <a href="{#BASE_URL#}/reset">{#LOGIN_forgot_password#}</a>.</p>





</div>

