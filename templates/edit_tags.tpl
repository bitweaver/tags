{strip}
{if $gContent->mContentTypeGuid != 'bitcomment' || $gBitSystem->isFeatureActive('tags_on_comments')}
	<div class="row">
		{formlabel label="Add Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{if $tagList}{$tagList}{/if}" />
		{formhelp note="Enter key words to describe your content. Separate each tag with a comma: tag one,tag two."}
		{/forminput}
	</div>
	{if count($tagData) > 0 }
		<div class="row tags">
			{forminput}
				<strong>{tr}Existing Tags:{/tr}</strong>&nbsp;
				{section name=tag loop=$tagData}
					{if $smarty.section.tag.index > 0},&nbsp;{/if}
					<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tagData[tag].tag}">{$tagData[tag].tag}</a>
				{/section}
				{formhelp note="NOTE: To remove tags use the \"Drop Tag\" options that are available when just viewing this content."}
			{/forminput}
		</div>
	{/if}
{/if}
{/strip}
