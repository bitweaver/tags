<?php
require_once( "../kernel/includes/setup_inc.php" );
require_once( TAGS_PKG_CLASS_PATH.'LibertyTag.php' );

$gBitSystem->verifyPackage( 'tags' );

$gBitSystem->verifyPermission('p_tags_view');

$tag = new LibertyTag();

$_REQUEST['max_records'] = !empty( $_REQUEST['max_records'] ) ? $_REQUEST['max_records'] : NULL;
$listHash = $_REQUEST;
$tagHash = $_REQUEST;

$gBitSmarty->assign( 'cloud', TRUE );

if( isset($_REQUEST['tags']) ){
	$pageTitle = tra( 'Tagged Content' );
	if( $listData = $tag->assignContentList( $listHash ) ) {
		$pageTitle .= ' '.tra( 'with' ).' '.$_REQUEST['tags'];
		$gBitSystem->setCanonicalLink( $tag->getDisplayUrlWithTag( $_REQUEST['tags'] ) );
	} else {
		$gBitSystem->setHttpStatus( HttpStatusCodes::HTTP_GONE );
	}
	$tagData = $tag->getList( $tagHash );
	$gBitSmarty->assign( 'tagData', $tagData["data"] );
	$gBitSmarty->assign( 'tagsReq', $_REQUEST['tags'] );
	$gBitSystem->display( 'bitpackage:tags/list_content.tpl', $pageTitle, array( 'display_mode' => 'display' ));
}else{
	$listData = $tag->getList( $listHash );
	$gBitSmarty->assign( 'tagData', $listData["data"] );
	$gBitSystem->display( 'bitpackage:tags/list_tags.tpl', tra( 'Tags' ) , array( 'display_mode' => 'display' ));
	
}
