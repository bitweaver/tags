{strip}
{if count($tagData) > 0 && $gBitUser->hasPermission('p_tags_view')}
	<div class="display tags">
		{form ipackage=tags ifile=drop_tags.php}
			<input type="hidden" name="content_id" value="{$gContent->mContentId}" />

			<h2>{tr}Tags{/tr}</h2>
	
			{if $preview}
				{$smarty.post.tags|escape}
			{elseif $tagData}
				
				{section name=tag loop=$tagData}
					<a href="{$tagData[tag].tag_url}" rel="tag">{$tagData[tag].tag}</a>
					{if !$smarty.section.tag.last}, {/if}
				{/section}
			
			{/if}
			
		{/form}
	</div>
{/if}
{/strip}