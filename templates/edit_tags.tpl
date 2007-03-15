{strip}
	<div class="row">
		{formlabel label="Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{*{if $gContent}{$gContent->mInfo['tags']}{else*}{if $serviceHash}{$serviceHash}{/if}" />
		{formhelp note="Enter key words to describe your content. Separate each tag with a comma: , . Tag wisely, tag efficiently."}
		{/forminput}
	</div>
{/strip}
