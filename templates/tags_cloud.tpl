{* don't use strip on this tpl - it will mess up the list of links, as the browser will read them as one continuous string *}
{if $tagData}
	<ul id="cloud">
		{foreach item=tag from=$tagData}
			<li class="tag{$tag.tagscale}">
				<a href="{$tag.tag_url}{if $smarty.request.content_type_guid}?content_type_guid={$smarty.request.content_type_guid}{/if}" rel="tag">{$tag.tag}</a>&nbsp;<small>({$tag.tag_count})</small>
			</li>
		{/foreach}
	</ul>
{/if}
