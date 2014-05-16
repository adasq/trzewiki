{config_load file='lang.conf'}

<div id="putlink" class="center transbg formdiv">

<p class="tcenter pinfo">UDOSTĘPNIJ LINK! </p>
{if isset($put_msg)}<h3 class="{if $put_msg["error"]}colorerror{else}colorsucces{/if}"  >{$put_msg["message"]}</h3>{/if}

 

<form action="" method="post">
<table  class="center">


<tr><td>adres:</td><td><input type="text" class="finput" name="u" id="link" 
value="{if isset($put_link)}{$put_link}{/if}" size="35" tabindex="10" maxlength="255" /></td><td id="err_link">
{if isset($err_link)} <p class="formerror">{$err_link}</p>{/if}</td></tr>


{*
<tr><td>opis:</td><td>
<textarea class="ftextarea" name="d" disabled id="desc" rows="5" cols="49">
{if isset($put_desc)}{$put_desc}{/if}
</textarea>
</td><td id="err_desc">
{if isset($err_desc)} <p class="formerror">{$err_desc}</p>{/if}</td></tr>
*}


<tr><td>tagi:</td><td><input type="text" class="finput" name="t" id="tags" 
value="{if isset($put_tags)}{$put_tags}{/if}" size="35" tabindex="10" maxlength="255" placeholder="dodaj tagi, oddzielone spacją" /></td><td id="err_tags">
{if isset($err_tags)} <p class="formerror">{$err_tags}</p>{/if}</td></tr>



<tr>
<td>akcja: </td>
<td>	
<select name="a">
<option value="s">Podziel się</option>
<option value="wl">przeczytaj później</option>

	<optgroup label="Dodaj do katalogu:">
		{foreach $catalogs as $catalog} 	 
			<option title="sad" 
				style="margin: {math equation="x*15" x=$catalog->height}px;"
				value="{$catalog->catalog_id}">
					{$catalog->name}
			</option>
		{/foreach}
	</optgroup>

</select>
</td>	
</tr>



<tr>
<td>udostępnij: </td>
<td>	
<select name="s">
<option value="n">nikomu</option>
<option value="a">znajomym</option>
<optgroup label="grupie:">
		{foreach $groups as $group} 	 
			<option title="{$group->author_name}" 
				style="margin: {math equation="x*15" x=$catalog->height}px;"
				value="{$group->group_id}">
					{$group->group_name}
			</option>
		{/foreach}
	</optgroup>
</select>

</td>	
</tr>


<tr><td colspan="3" align="center">
<input type="hidden" name="submitted" value="true"/>
<input class="fbutton" type="submit" value="Prześlij link!" />
</td></tr>
</table>
</form>


<p class="tcenter pinfo">
<span>
Nie posiadasz żadnych katalogów?
<a href="{#BASE_URL#}/catalogs">Kliknij tutaj</a>.
<br/><br/>
Nie należysz do żadnej z grup?
<a href="{#BASE_URL#}/groups?all">Przeglądaj grupy</a>
lub 
<a href="{#BASE_URL#}/newgroup">stwórz własną grupę</a>
</span>
</p>






</div>