{strip}
{if $gContent->mContentTypeGuid != 'bitcomment' || $gBitSystem->isFeatureActive('tags_on_comments')}

	<div class="row">
		{formlabel label="Add Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{if $smarty.post.preview}{$smarty.post.tags}{elseif $tagList}{$tagList}{/if}" />
			<br />
			{jspopup class="popup_link" href=$smarty.const.TAGS_PKG_URL title="View all tags" width="null" height="null"}
			{formhelp note="Key words to describe the content, separated by commas: tag one, tag two. To remove tags use the \"Drop Tag\" options when just viewing this content."}
		{/forminput}
	</div>
	
	{* 
		existing tags are already visible in the tags input field
		note on how to delete them available in formhelp
	*}
	{*if count($tagData) > 0 }
		<div class="row tags">
			{formlabel label="Existing Tags"}
			{forminput}
				{section name=tag loop=$tagData}
					{if $smarty.section.tag.index > 0},&nbsp;{/if}
					<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tagData[tag].tag}">{$tagData[tag].tag}</a>
				{/section}
				{formhelp note="To remove tags use the \"Drop Tag\" options when just viewing this content."}
			{/forminput}
		</div>
	{/if*}

{/if}
{/strip}