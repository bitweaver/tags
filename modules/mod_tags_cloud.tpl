{strip}
{if $gBitSystem->isPackageActive('tags')}
	{bitmodule title="$moduleTitle" name="tags"}
		{if $modTagData}
			<div id="cloud">
				{foreach item=tag from=$modTagData}
					<li class="tag{$tag.tagscale}"><a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag}">{$tag.tag}</a></li>
				{/foreach}
			</div>
		{else}
			<div class="norecords">
				{tr}No tags found{/tr}
			</div>
		{/if}
	{/bitmodule}
{/if}
{/strip}