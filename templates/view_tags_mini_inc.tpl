{strip}
{if count($tagData) > 0 && $gBitUser->hasPermission('p_tags_view')}
<div class="display tags">
	{form ipackage=tags ifile=drop_tags.php}
		<input type="hidden" name="content_id" value="{$gContent->mContentId}" />
		<strong>{tr}Tags:{/tr}</strong>&nbsp;
		{section name=tag loop=$tagData}
			{if $smarty.section.tag.index > 0},&nbsp;{/if}
			<a href="{$tagData[tag].tag_url}" rel="tag">{$tagData[tag].tag}</a>
			{if $gContent->isOwner() || $gBitUser->hasPermission('p_tags_admin')}
				<input type="checkbox" name="tag_id[]" value="{$tagData[tag].tag_id}" />
				<input type="hidden" name="tag_{$tagData[tag].tag_id}" value="{$tagData[tag].tag}" />
			{/if}
		{/section}
		{if $gContent->isOwner() || $gBitUser->hasPermission('p_tags_admin')}
			<input type="submit" name="drop_tags" value="{tr}Drop Tags{/tr}" />
		{/if}
	{/form}
</div>
{/if}
{/strip}
