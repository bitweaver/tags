{strip}
{if count($tagData) > 0 && $gBitUser->hasPermission('p_tags_view')}
<div class="tags">
	<b>{tr}Tags:{/tr}</b>&nbsp;
  	{section name=tag loop=$tagData}
		{if $smarty.section.tag.index > 0},&nbsp;{/if}
		<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tagData[tag].tag}">{$tagData[tag].tag}</a>
	{/section}
</div>		
{/if}
{/strip}
