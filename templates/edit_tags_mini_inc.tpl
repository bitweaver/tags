{if $gBitSystem->isPackageActive('tags') && $gBitUser->hasPermission('p_tags_create') }
  {include file='bitpackage:tags/edit_tags.tpl' tagData=$tagData}
{/if}
