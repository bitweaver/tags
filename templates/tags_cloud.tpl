{strip}
<div class="data">
	{foreach item=tag from=$tagData}
		<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag}">{$tag.tag}</a> ({$tag.popcant})&nbsp;
	{foreachelse}
		<div class="norecords">
				{tr}No tags found{/tr}
		</div>
	{/foreach}
</div><!-- end .data -->
{/strip}