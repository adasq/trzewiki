

<div class="center transbg formdiv">


<p class="pinfo">Wpisz adres e-mail, który podawałeś przy rejestracji. Hasło zostanie zmienione i przesłane do Ciebie e-mailem.
</p>


{if isset($rst_mail_succes)}<h3>Poprawnie zmieniono hasło, oto one: <b style="color: black;">{$rst_mail_succes}</b></h3>{/if}

<form action="" method="post">

<table class="center">

<tr><td>{#RESET_PASSWORD_mail#}:</td><td><input class="finput" type="text" name="rst_mail" id="mail" value="{if isset($rst_mail)}{$rst_mail}{/if}" size="25" tabindex="10" maxlength="32" /></td>
<td id="err_mail">{if isset($err_mail)}<p class="formerror">{$err_mail}</p>{/if}</td></tr>




<tr><td colspan="3" align="center">
<input type="hidden" name="submitted" value="true"/>
<input type="submit" class="fbutton" value="{#RESET_PASSWORD_reset#}" />
</td></tr>
</table>
</form>

</div>