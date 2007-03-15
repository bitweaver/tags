{if count($tagData) > 0}
<div>
	<b>Tags:</b>
  		{section name=tag loop=$tagData}
			<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tagData[tag].tag}">{$tagData[tag].tag}</a>,&nbsp;
		{/section}
</div>		
{/if}
