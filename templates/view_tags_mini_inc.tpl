{strip}
{if count($tagData) > 0 && $gBitUser->hasPermission('p_tags_view')}
	<div class="display tags">
		{form ipackage=tags ifile="drop_tags.php"}
			<input type="hidden" name="content_id" value="{$gContent->mContentId}" />

			<strong>{tr}Tags:{/tr}</strong>
			&nbsp;
	
			{if $preview}
				{$smarty.post.tags|escape}
			{elseif $tagData}
				
				{section name=tag loop=$tagData}
				
					{if $gContent->isOwner() || $gBitUser->hasPermission('p_tags_admin')}
						<input type="checkbox" name="tag_id[]" value="{$tagData[tag].tag_id}" />
						<input type="hidden" name="tag_{$tagData[tag].tag_id}" value="{$tagData[tag].tag}" />
					{/if}

					<a href="{$tagData[tag].tag_url|append_url:'content_type_guid':$gContent->mContentTypeGuid}" rel="tag">{$tagData[tag].tag}</a>
					{if !$smarty.section.tag.last}, {/if}
				{/section}
			
			{/if}

			{if $gContent->isOwner() || $gBitUser->hasPermission('p_tags_admin')}
				&nbsp;
				<input type="submit" class="btn btn-default" name="drop_tags" value="{tr}Drop selected{/tr}" />
			{/if}

		{/form}
	</div>
{/if}
{/strip}
