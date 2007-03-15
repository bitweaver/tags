<?php
require_once( "../bit_setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

$tag = new LibertyTag();

$listHash = $_REQUEST;
$listData = $tag->getList( $listHash );

if( isset($_REQUEST['listcontent']) ){
	$gBitSmarty->assign( 'taggedcontent', $listData["data"] );
	$gBitSystem->display( 'bitpackage:tags/list_content.tpl', tra( 'Tagged Content' ) );
}elseif( isset($_REQUEST['tags']) ){
}else{
	$gBitSmarty->assign( 'tagData', $listData["data"] );
	$gBitSystem->display( 'bitpackage:tags/list_tags.tpl', tra( 'Tags' ) );
}
?>