<?php
require_once( "../bit_setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

$gBitSystem->verifyPermission('p_tags_view');

$tag = new LibertyTag();

$_REQUEST['max_records'] = !empty( $_REQUEST['max_records'] ) ? $_REQUEST['max_records'] : NULL;
$listHash = $_REQUEST;
$tagHash = $_REQUEST;

$gBitSmarty->assign( 'cloud', TRUE );

if( isset($_REQUEST['tags']) ){
	$listData = $tag->assignContentList( $listHash );
	$tagData = $tag->getList( $tagHash );
	$gBitSmarty->assign( 'tagData', $tagData["data"] );
	$gBitSmarty->assign( 'tagsReq', $_REQUEST['tags'] );
	$gBitSystem->display( 'bitpackage:tags/list_content.tpl', tra( 'Tagged Content' ) , array( 'display_mode' => 'display' ));
}else{
	$listData = $tag->getList( $listHash );
	$gBitSmarty->assign( 'tagData', $listData["data"] );
	$gBitSystem->display( 'bitpackage:tags/list_tags.tpl', tra( 'Tags' ) , array( 'display_mode' => 'display' ));
	
}
?>
