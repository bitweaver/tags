{strip}
<ul>
	{if $gBitUser->hasPermission('p_tags_view')}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}index.php">{biticon ipackage="tags" iname="tags" iexplain="Tag Cloud" ilocation=menu}</a></li>
	{/if}
	{if $gBitUser->hasPermission( 'p_tags_admin' )}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}list.php">{booticon iname="icon-file" ipackage="icons" iexplain="Edit Tags" ilocation=menu}</a></li>
	{/if}
</ul>
{/strip}
