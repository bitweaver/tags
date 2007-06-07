{strip}
<ul>
	{if $gBitUser->hasPermission('p_tags_view')}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}index.php">{biticon ipackage="tags" iname="tags" iexplain="Shows a tag cloud" iforce="icon"} {tr}Tag Cloud{/tr}</a></li>
	{/if}
	{if $gBitUser->hasPermission( 'p_tags_admin' )}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}list.php">{biticon ipackage="icons" iname="document-new" iexplain="Edit tags" iforce="icon"} {tr}Edit tags{/tr}</a></li>
	{/if}
</ul>
{/strip}
