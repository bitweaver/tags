{strip}
<table class="data">
	<tr>
		<th>{tr}Tag{/tr}</th>
		<th>{tr}Use Count{/tr}</th>
		<th>{tr}Action{/tr}</th>
	</tr>
	{if $tagData}
		{cycle values="even,odd" print=false}
		{foreach item=tag from=$tagData}
			<tr class="{cycle}">
				<td>
					<strong><a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag}">{$tag.tag}</a></strong>
				</td>
				<td style="text-align:center;">
					{$tag.popcant}
				</td>
				<td style="text-align:center;">
					{if $gBitUser->hasPermission( 'p_tags_edit' ) }
						{smartlink ititle="Edit" ifile="edit.php" ibiticon="icons/accessories-text-editor" tag_id=$tag.tag_id}
					{/if}

					{if $gBitUser->hasPermission( 'p_tags_remove' )}
						{smartlink ititle="Remove" ibiticon="icons/edit-delete" action=remove tag_id=$tag.tag_id status_id=$smarty.request.status_id}
					{/if}
				</td>
			</tr>		
		{/foreach}
	{else}
		<tr class="norecords">
			<td colspan="5">
				{tr}No tags found{/tr}
			</td>
		</tr>
	{/if}
</table><!-- end .data -->
{/strip}



