<div class="form-group">
	{formlabel label="Tags:" for="tags"}
	{forminput}
		<input type="text" name="tags" id="search_tags" value="{$listInfo.tags}" />
		<div class="formhelp">{jspopup class="popup_link" href=$smarty.const.TAGS_PKG_URL title="View all tags" width="null" height="null"}</div>
	{/forminput}
</div>
