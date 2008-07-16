{* don't use strip on this tpl - it will mess up the list of links, as the browser will read them as one continuous string *}
{if $tagData}
	<ul id="cloud">
		{foreach item=tag from=$tagData}
			<li class="tag{$tag.tagscale}">
				<a href="{$tag.tag_url}" rel="tag">{$tag.tag}</a>&nbsp;<small>({$tag.popcant})</small>
			</li>
		{/foreach}
	</ul>
{else}
	<div class="norecords">
		{tr}No tags found{/tr}
	</div>
{/if}
