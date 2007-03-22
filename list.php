<?php
require_once( "../bit_setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

if( !empty( $_REQUEST['action'] ) ) {
	if( $_REQUEST['action'] == 'remove' && !empty( $_REQUEST['tag_id'] ) ) {
		if ( !$gBitUser->hasPermission('p_tags_remove') ){
			$gBitSystem->fatalError( 'You do not have permission to remove Tags' );
		}
		
		$tmpTag = new LibertyTag();
		$tmpTag->loadTag($_REQUEST);
		
		if( isset( $_REQUEST["confirm"] ) ) {
			if( $tmpTag->expunge( $tmpTag->mInfo['tag_id'] ) ) {
				header( "Location: ".TAGS_PKG_URL.'list.php?status_id='.( !empty( $_REQUEST['status_id'] ) ? $_REQUEST['status_id'] : '' ) );
				die;
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
			'label' => 'Remove Tag',
			'confirm_item' => $tmpTag->mInfo['tag'],
			'warning' => 'This will remove the above tag. This cannot be undone.',
		);
		$gBitSystem->confirmDialog( $formHash, $msgHash );
	}
}

$tag = new LibertyTag();

$listHash = $_REQUEST;
$tagHash = $_REQUEST;

if( isset($_REQUEST['tags']) ){
	$listData = $tag->getContentList( $listHash );
	$tagData = $tag->getList( $tagHash );
	$gBitSmarty->assign( 'tagData', $tagData["data"] );
	$gBitSmarty->assign( 'tagsReq', $_REQUEST['tags'] );
	$gBitSystem->display( 'bitpackage:tags/list_content.tpl', tra( 'Tagged Content' ) );
}else{
	$listData = $tag->getList( $listHash );
	$gBitSmarty->assign( 'tagData', $listData["data"] );
	$gBitSystem->display( 'bitpackage:tags/list_tags.tpl', tra( 'Tags' ) );
}
?>