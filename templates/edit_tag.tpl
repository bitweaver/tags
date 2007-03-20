{* For editing a single tag *}
{strip}
<div class="floaticon">{bithelp}</div>
<div class="edit tag">
	<div class="header">
		{if $tagData}
			<h1>{tr}Edit Tag{/tr}: {$tagData.tag|escape}</h1>
		{else}
			<h1>{tr}Create Tag{/tr}</h1>
		{/if}
	</div>

	<div class="body">
		{form enctype="multipart/form-data" id="edittag"}
			<input type="hidden" name="tag_id" value="{if $tagData}{$tagData.tag_id}{/if}" />

			{legend legend="Edit Tag"}
				<div class="row">
					{formlabel label="Tag" for="tag"}
					{forminput}
						<input type="text" name="tag" id="tag" value="{if $tagData}{$tagData.tag}{/if}" />
					{/forminput}
				</div>

				<div class="row submit">
					<input type="submit" name="save" value="{tr}Save{/tr}" />
				</div>
			{/legend}
		{/form}
	</div><!-- end .body -->
</div><!-- end .tag -->
{/strip}