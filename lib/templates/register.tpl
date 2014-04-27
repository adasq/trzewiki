

<div class="center transbg formdiv">


<p class="pinfo">
Wypełnij poprawnie wszystkie pola formularza rejestracji. <b>Nazwa użytkownika</b> nie może zaczynać się od cyfry i powinna mieć conajmniej 6 znaków (a-zA-Z0-9)
<b>Hasło</b> conajmniej 5-literowe.
</p>



<form action="" method="post">
<table  class="center">

<tr><td>{#REGISTER_username#}:</td>
<td><input type="text" name="reg_username" id="username" class="finput"  value="{if isset($reg_username)}{$reg_username}{/if}" size="25" tabindex="10" maxlength="32" /></td>
<td id="err_username">{if isset($username_err)}  <p class="formerror">{$username_err}</p> {/if}
</td></tr>

<tr><td>{#REGISTER_mail#}:</td><td><input type="text" class="finput" name="reg_mail" id="mail" value="{if isset($reg_mail)}{$reg_mail}{/if}" size="25" tabindex="10" maxlength="32" /></td><td id="err_mail">{if isset($mail_err)}
 <p class="formerror">{$mail_err}</p>{/if}</td></tr>

<tr><td>{#REGISTER_password#}:</td><td><input type="password" class="finput" name="reg_password" id="pswd" 
value="{if isset($reg_password)}{$reg_password}{/if}" size="25" tabindex="10" maxlength="32" /></td>
<td id="err_pswd">{if isset($pswd_err)}   <p class="formerror">{$pswd_err}</p>  {/if}</td></tr>

<tr><td>{#REGISTER_password2#}:</td><td><input type="password" class="finput" name="reg_password2" id="verify" 
value="{if isset($reg_password2)}{$reg_password2}{/if}" size="25" tabindex="10" maxlength="32" /></td><td id="err_verify">
{if isset($pswd2_err)} <p class="formerror">{$pswd2_err}</p>{/if}</td></tr>

<tr ><td>{#REGISTER_captcha#}:</td>
<td style="width: 320px;">{$captcha_html}
</td>


<td id="captcha">{if isset($captcha_err)} <p class="formerror">{$captcha_err}</p>{/if}</td></tr>



<tr><td colspan="3" align="center">
<input type="hidden" name="submitted" value="true"/>
<input class="fbutton" type="submit" value="{#REGISTER_register#}" />
</td></tr>
</table>
</form>


<p class="tcenter pinfo">Posiadasz już konto? <a href="{#BASE_URL#}/login">Zaloguj się</a>. </p>



</div>