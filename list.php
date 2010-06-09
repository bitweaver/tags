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
require_once( "../kernel/setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

if( !empty( $_REQUEST['action'] ) ) {
	if( $_REQUEST['action'] == 'remove' && !empty( $_REQUEST['tag_id'] ) ) {
		if ( !$gBitUser->hasPermission('p_tags_moderate') ){
			$gBitSystem->fatalError( tra('You do not have permission to remove tags.') );
		}
		
		$tmpTag = new LibertyTag();
		$tmpTag->loadTag($_REQUEST);
		
		if( isset( $_REQUEST["confirm"] ) ) {
			if( $tmpTag->expunge( $tmpTag->mInfo['tag_id'] ) ) {
				bit_redirect( TAGS_PKG_URL.'list.php?status_id='.( !empty( $_REQUEST['status_id'] ) ? $_REQUEST['status_id'] : '' ) );
			} else {
				$feedback['error'] = $tmpTag->mErrors;
			}
		}
		$gBitSystem->setBrowserTitle( 'Confirm removal of '.$tmpTag->mInfo['tag'] );
		$formHash['remove'] = TRUE;
		$formHash['action'] = 'remove';
		$formHash['status_id'] = ( !empty( $_REQUEST['status_id'] ) ? $_REQUEST['status_id'] : '' );
		$formHash['tag_id'] = $_REQUEST['tag_id'];
		$msgHash = array(
			'label' => tra('Remove Tag'),
			'confirm_item' => $tmpTag->mInfo['tag'],
			'warning' => ('This will remove the above tag.'),
			'error' => tra('This cannot be undone!'),
		);
		$gBitSystem->confirmDialog( $formHash, $msgHash );
	}
}

$tag = new LibertyTag();

$listHash = $_REQUEST;
$tagHash = $_REQUEST;

if( isset($_REQUEST['tags']) ){
	$listData = $tag->assignContentList( $listHash );
	$tagData = $tag->getList( $tagHash );
	$gBitSmarty->assign( 'tagData', $tagData["data"] );
	$gBitSmarty->assign( 'tagsReq', $_REQUEST['tags'] );
	$gBitSystem->display( 'bitpackage:tags/list_content.tpl', tra( 'Tagged Content' ) , array( 'display_mode' => 'list' ));
}else{
	$listData = $tag->getList( $listHash );
	$gBitSmarty->assign( 'tagData', $listData["data"] );
	$gBitSystem->display( 'bitpackage:tags/list_tags.tpl', tra( 'Tags' ) , array( 'display_mode' => 'list' ));
}
?>
