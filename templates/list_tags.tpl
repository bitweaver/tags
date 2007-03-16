<div class="floaticon">{bithelp}</div>

{strip}
<div class="listing tags">
	<div class="header">
		<h1>{tr}Tags{/tr}</h1>
	</div>

	<div class="body">
	
		<div class="navbar">
			<ul><li>Sort by:
				</li>				
				<li>
					<a href="{$smarty.const.TAGS_PKG_URL}index.php?sort=mostpopular">Popularity</a>
				</li>
				<li>
					<a href="{$smarty.const.TAGS_PKG_URL}index.php">Alphabeticaly</a>
				</li>
			</ul>
		</div>

		<div class="clear"></div>
		{include file="bitpackage:tags/tags_cloud.tpl"}
	</div><!-- end .body -->
</div><!-- end .tags -->
{/strip}
