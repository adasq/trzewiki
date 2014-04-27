

<div  class="center transbg minh">
 
<br/>
{if isset($group_msg)}<h3 class="{if $group_msg["error"]}colorerror{else}colorsucces{/if}"  >{$group_msg["message"]}</h3>{/if}

<br/>

<form action="" method="post">

<table class="center">


<tr><td>nazwa:</td>
<td><input type="text" name="grp_name" class="finput" value="{if isset($grp_name)}{$grp_name}{/if}" size="25" tabindex="10" maxlength="32" /></td>
<td id="err_name">{if isset($err_name)} <p class="formerror"> {$err_name}</p>  {/if}
</td></tr>

<tr><td>opis:</td>
<td><input type="text" name="grp_description" class="finput" value="{if isset($grp_description)}{$grp_description}{/if}" size="25" tabindex="10" maxlength="32" /></td>
<td id="err_description">{if isset($err_description)}<p class="formerror">{$err_description}</p>{/if}</td></tr>


{*
<tr><td>tags:</td>
<td><input type="text" name="grp_tags"  value="{if isset($grp_tags)}{$grp_tags}{/if}" size="25" tabindex="10" maxlength="32" /></td>
<td id="err_tags">{if isset($err_tags)}{$err_tags}{/if}</td></tr>
*}

<tr><td>grafika:</td>
<td><input type="text" name="grp_image" class="finput"  value="{if isset($grp_image)}{$grp_image}{/if}" size="25" tabindex="10" maxlength="400" /></td>
<td id="err_image">{if isset($err_image)}<p class="formerror">{$err_image}</p>{/if}</td></tr>



<tr><td colspan="3" align="center">
<input type="hidden" name="submitted" value="true"/>
<input  class="fbutton" type="submit" value="Utwórz grupę!" />
</td></tr>
</table>
</form>


</div>