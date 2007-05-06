{strip}

{if $gBitSystem->isPackageActive('tags')}
	{bitmodule title="$moduleTitle" name="tags"}
		<ul id="cloud">
			{if $modTagData}
				{foreach item=tag from=$modTagData}
					<li class="tag{$tag.tagscale}">
						<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag}">
							{$tag.tag}
						</a>
					</li>
				{/foreach}
			{else}
				<li class="norecords">
					{tr}No tags found{/tr}
				</li>
			{/if}
		</ul>
	{/bitmodule}
{/if}

{/strip}