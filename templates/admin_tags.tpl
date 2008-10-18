{strip}
{formfeedback hash=$feedback}
{form}
	{jstabs}

		{jstab title="Settings"}
			{legend legend="Display Location"}
				<input type="hidden" name="page" value="{$page}" />
				{foreach from=$formTagsDisplayOptions key=item item=output}
					<div class="row">
						{formlabel label=`$output.label` for=$item}
						{forminput}
							{if $output.type == 'numeric'}
								{html_options name="$item" values=$numbers output=$numbers selected=$gBitSystem->getConfig($item) labels=false id=$item}
							{elseif $output.type == 'input'}
								<input type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item)}" />
							{else}
								{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
							{/if}
							{formhelp note=`$output.note` page=`$output.page`}
						{/forminput}
					</div>
				{/foreach}
			{/legend}
			
			{legend legend="Availability"}
				<div class="row">
					{formlabel label="Taggable Content"}
					{forminput}
						{formhelp note="Enabled content types can be tagged by users with appropriate permissions."}
						{html_checkboxes options=$formTaggable.guids value=y name=taggable_content separator="<br />" checked=$formTaggable.checked}
					{/forminput}
				</div>
			{/legend}
		{/jstab}
            
		{jstab title="Sanitation"}
		{legend legend="Santitation Settings"}
			<input type="hidden" name="page" value="{$page}" />
			{foreach from=$formTagsStripOptions key=item item=output}
				<div class="row">
					{formlabel label=`$output.label` for=$item}
					{forminput}
						{if $output.type == 'numeric'}
							{html_options name="$item" values=$numbers output=$numbers selected=$gBitSystem->getConfig($item) labels=false id=$item}
						{elseif $output.type == 'input'}
							<input type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item)}" />
						{else}
							{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
						{/if}
						{formhelp note=`$output.note` page=`$output.page`}
					{/forminput}
				</div>
			{/foreach}
		{/legend}
		{/jstab}
{*
		{jstab title="Other Settings"}
		{legend legend="Other Settings"}
			<input type="hidden" name="page" value="{$page}" />
			{foreach from=$formTagsOtherOptions key=item item=output}
				<div class="row">
					{formlabel label=`$output.label` for=$item}
					{forminput}
						{if $output.type == 'numeric'}
							{html_options name="$item" values=$numbers output=$numbers selected=$gBitSystem->getConfig($item) labels=false id=$item}
						{elseif $output.type == 'input'}
							<input type='text' name="{$item}" id="{$item}" value="{$gBitSystem->getConfig($item)}" />
						{else}
							{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
						{/if}
						{formhelp note=`$output.note` page=`$output.page`}
					{/forminput}
				</div>
			{/foreach}
		{/legend}
		{/jstab}
*}
	{jstab title="List"}
		{form legend="List Settings"}
			<input type="hidden" name="page" value="{$page}" />

			{foreach from=$formTagLists key=item item=output}
				<div class="row">
					{formlabel label=`$output.label` for=$item}
					{forminput}
						{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
						{formhelp note=`$output.note` page=`$output.page`}
					{/forminput}
				</div>
			{/foreach}

		{/form}
	{/jstab}


	{/jstabs}
	<div class="row submit">
		<input type="submit" name="tags_preferences" value="{tr}Change preferences{/tr}" />
	</div>
{/form}
{/strip}
