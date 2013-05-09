{strip}
<ul class="dropdown-menu">
	{if $gBitUser->hasPermission('p_tags_view')}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}index.php">{booticon iname="icon-tags" iexplain="Tag Cloud" ilocation=menu}</a></li>
	{/if}
	{if $gBitUser->hasPermission( 'p_tags_admin' )}
		<li><a class="item" href="{$smarty.const.TAGS_PKG_URL}list.php">{booticon iname="icon-file" ipackage="icons" iexplain="Edit Tags" ilocation=menu}</a></li>
	{/if}
</ul>
{/strip}
