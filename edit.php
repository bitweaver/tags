<?php
/**
 * @version $Header$
 * @package tags
 * @subpackage functions
 * 
 * @copyright Copyright (c) 2004-2006, bitweaver.org
 * All Rights Reserved. See below for details and a complete list of authors.
 * Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See http://www.gnu.org/copyleft/lesser.html for details.
 */

/**
 * required setup
 */
require_once( "../kernel/includes/setup_inc.php" );
require_once( TAGS_PKG_CLASS_PATH.'LibertyTag.php' );

$gBitSystem->verifyPackage( 'tags' );

if ( !$gBitUser->hasPermission('p_tags_admin') ){
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

$gBitSystem->display( 'bitpackage:tags/edit_tag.tpl', tra( "Edit Tag" ) , array( 'display_mode' => 'edit' ));
?>
