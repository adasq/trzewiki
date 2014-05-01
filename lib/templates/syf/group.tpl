{config_load file='lang.conf'}


<div class="fl group-ent">
<div class="group-ent-inner">

<a title="{#GROUP_view_profile#} {$group->group_name}" href="{#BASE_URL#}/group/{$group->group_name}">
<img class="fl" width="100" height="100" alt="{$group->group_name}" src="{#BASE_URL_IMAGES#}/groups/{$group->image}"/>
</a>
{#GROUP_group_description#}:
<p>
	{if $group->description === null}
	<i>Brak opisu</i>
	{else}
	{$group->description|truncate:70:"...":true}
	{/if}
</p>
<div class="clr"></div>
<a title="{#GROUP_view_profile#} {$group->group_name}" href="{#BASE_URL#}/group/{$group->group_name}">{$group->group_name}</a>

<p>
<span>{#GROUP_group_create_date#}:{$group->create_date}</span>			
</p>


		
		
		
	</div>

</div>

