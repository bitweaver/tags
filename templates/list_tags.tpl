<div class="floaticon">{bithelp}</div>

{strip}
<div class="listing tags">
	<div class="header">
		<h1>{tr}Tags{/tr}</h1>
	</div>

	<div class="body">
	
		<div class="navbar">
		{* Not sure what we want here yet
			<ul>
				<li>{biticon ipackage="icons" iname="emblem-symbolic-link" iexplain="sort by"}</li>
				{if $gBitSystem->isFeatureActive( 'articles_list_title' )}
					<li>{smartlink ititle='Title' isort='title' offset=$offset type=$find_type topic=$find_topic}</li>
				{/if}
			</ul>
		*}
		<a href="{$smarty.const.TAGS_PKG_URL}index.php?sort=mostpopular">Sort by most popular</a>
		<a href="{$smarty.const.TAGS_PKG_URL}index.php">Sort alphabeticaly</a>
		</div>

		<div class="clear"></div>

		<div class="data">
			<h2>{tr}All Tags{/tr}</h2>
			{foreach item=tag from=$tagData}
				<a href="{$smarty.const.TAGS_PKG_URL}index.php?tags={$tag.tag}">{$tag.tag}</a>&nbsp;
			{foreachelse}
				<div class="norecords">
						{tr}No tags found{/tr}
				</div>
			{/foreach}
		</div><!-- end .data -->
	</div><!-- end .body -->
</div><!-- end .tags -->
{/strip}
