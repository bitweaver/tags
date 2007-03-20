{strip}
<ul>
	<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}index.php">{biticon ipackage="icons" iname="applications-internet" iexplain="Shows a tag cloud" iforce="icon"} {tr}Tags{/tr}</a></li>
	{if $gBitUser->hasPermission( 'p_tags_edit' )}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}list.php">{biticon ipackage="icons" iname="document-new" iexplain="Edit tags" iforce="icon"} {tr}Edit tags{/tr}</a></li>
	{/if}
</ul>
{/strip}
