{* don't use strip on this tpl - it will mess up the list of links, as the browser will read them as one continuous string *}
{if $gBitSystem->isPackageActive('tags')}
	{bitmodule title="$moduleTitle" name="tags"}
		<ul id="cloud">
			{if $modTagData}
				{foreach item=tag from=$modTagData}
					<li class="tag{$tag.tagscale}">
						<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag|escape:"url"}">{$tag.tag}</a>
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
