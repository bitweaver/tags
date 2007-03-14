{strip}
	<div class="row">
		{formlabel label="Tags" for="tags"}
		{forminput}
			<input type="text" name="tags" id="tags" value="{if $gContent}{$gContent->mInfo['tags']}{else if $serviceHash}{$serviceHash.tags}{/if}" />
		{formhelp note="Key words to describe your content. Tag wisely, tag efficiently."}
		{/forminput}
	</div>
{/strip}
