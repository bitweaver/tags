{strip}
	<div class="row">
		{formlabel label="Add Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{if $tagList}{$tagList}{/if}" />
		{formhelp note="Enter key words to describe your content. Separate each tag with a comma: , . Tag wisely, tag efficiently."}
		{/forminput}
	</div>
	{forminput}
		{include file='bitpackage:tags/view_tags_mini_inc.tpl' tagData=$tagData}
	{/forminput}
{/strip}
