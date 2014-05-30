{strip}

{if $gContent->mContentTypeGuid != 'bitcomment' || $gBitSystem->isFeatureActive('tags_on_comments')}

	<div class="form-group">
		{formlabel label="Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{if $preview}{$smarty.post.tags}{elseif $tagList}{$tagList}{/if}" />
			<br />
			{jspopup class="popup_link" href="`$smarty.const.TAGS_PKG_URL`?content_type_guid=`$gContent->mContentTypeGuid`" title="View all tags" width="null" height="null"}
			{formhelp note="Key words to describe the content, separated by commas: tag one, tag two."}
		{/forminput}
	</div>
	
{/if}

{/strip}
