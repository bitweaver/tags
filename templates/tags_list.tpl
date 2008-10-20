{strip}
<table class="data">
	<tr>
		<th style="width:80%;">{tr}Tag{/tr}</th>
		<th style="width:10%;">{tr}Use Count{/tr}</th>
		<th style="width:10%;">{tr}Action{/tr}</th>
	</tr>
	{if $tagData}
		{cycle values="even,odd" print=false}
		{foreach item=tag from=$tagData}
			<tr class="{cycle}">
				<td>
					<strong><a href="{$tag.tag_url}" rel="tag">{$tag.tag}</a></strong>
				</td>
				<td style="text-align:center;">
					{$tag.popcant}
				</td>
				<td class="actionicon">
					{if $gBitUser->hasPermission( 'p_tags_create' ) }
						{smartlink ititle="Edit" ifile="edit.php" ibiticon="icons/accessories-text-editor" tag_id=$tag.tag_id}
					{/if}
					{if $gBitUser->hasPermission( 'p_tags_moderate' )}
						{smartlink ititle="Remove" ibiticon="icons/edit-delete" action=remove tag_id=$tag.tag_id status_id=$smarty.request.status_id}
					{/if}
				</td>
			</tr>
		{/foreach}
	{else}
		<tr class="norecords">
			<td colspan="3">
				{tr}No tags found{/tr}
			</td>
		</tr>
	{/if}
</table><!-- end .data -->
{/strip}
