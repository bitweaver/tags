{strip}
<div class="data">
	{if $tagData}
		<ul id="cloud">
		{foreach item=tag from=$tagData}
			<li class="tag{$tag.tagscale}"><a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag}">{$tag.tag}</a> ({$tag.popcant})<li>
		{/foreach}
	{else}
		<div class="norecords">
				{tr}No tags found{/tr}
		</div>
	{/if}
</div><!-- end .data -->
{/strip}