{strip}
<ul>
	{if $gBitUser->hasPermission( 'bit_tags_view' )}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}index.php">{biticon ipackage="icons" iname="applications-internet" iexplain="Shows a tag cloud" iforce="icon"} {tr}Tags{/tr}</a></li>
	{/if}	
	{if $gBitUser->hasPermission( 'bit_tags_edit' )}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}edit.php">{biticon ipackage="icons" iname="document-new" iexplain="Edit tags" iforce="icon"} {tr}Edit tags{/tr}</a></li>
	{/if}
</ul>
{/strip}
