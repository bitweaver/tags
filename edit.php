<?php
require_once( "../bit_setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

if ( !$gBitUser->hasPermission('p_tags_edit') ){
	$gBitSystem->fatalError( 'You do not have permission to edit Tags' );
}

$tag = new LibertyTag();

if ( $tag->loadTag ( $_REQUEST ) ){
	$gBitSmarty->assign( 'tagData', $tag->mInfo );	
}

if( !empty( $_REQUEST["save"] ) ) {
	if( $tag->storeOneTag( $_REQUEST ) ) {
		header ( "location: " . TAGS_PKG_URL. "index.php?tags=".$tag->mInfo['tag'] );
	}
}

$gBitSystem->display( 'bitpackage:tags/edit_tag.tpl', tra( "Edit Tag" ) );
?>