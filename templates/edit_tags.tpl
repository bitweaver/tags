{strip}

{if $loadTags}

	<div class="row">
		{formlabel label="Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{if $preview}{$smarty.post.tags}{elseif $tagList}{$tagList}{/if}" />
			<br />
			{jspopup class="popup_link" href=$smarty.const.TAGS_PKG_URL title="View all tags" width="null" height="null"}
			{formhelp note="Key words to describe the content, separated by commas: tag one, tag two."}
		{/forminput}
	</div>
	
{/if}

{/strip}