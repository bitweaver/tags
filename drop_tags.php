<?php
/**
 * @version $Header: /cvsroot/bitweaver/_bit_tags/drop_tags.php,v 1.3 2009/10/01 13:45:49 wjames5 Exp $
 * @package tags
 * @subpackage functions
 * 
 * @copyright Copyright (c) 2004-2006, bitweaver.org
 * All Rights Reserved. See copyright.txt for details and a complete list of authors.
 * Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See http://www.gnu.org/copyleft/lesser.html for details.
 */

/**
 * required setup
 */
require_once( "../bit_setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

require_once( LIBERTY_PKG_PATH.'lookup_content_inc.php' );

if (!$gContent || !$gContent->isValid()) {
	$gBitSystem->fatalError( 'The content is not valid.' );
}

if (!($gBitUser->hasPermission('p_tags_admin') || $gContent->isOwner())) {
	$gBitSystem->fatalError( 'You do not have permission to remove tags.' );
}

if (empty($_REQUEST['tag_id'])) {
	$gBitSystem->fatalError('You must select some tags.');
}

if( isset( $_REQUEST["confirm"] ) ) {
	$tag = new LibertyTag();
	$tag->expungeTags($_REQUEST['content_id'], explode(",", $_REQUEST['tag_id']));
	header("location: ".$gContent->getDisplayUrl());
}

$gBitSystem->setBrowserTitle( tra( 'Confirm drop of tags from: ' ).$gContent->getTitle() );
$formHash['tag_id'] = implode(",", $_REQUEST['tag_id']);
$formHash['content_id'] = $_REQUEST['content_id'];
foreach($_REQUEST['tag_id'] as $id) {
	$tags[] = $_REQUEST['tag_'.$id];
}
$msgHash = array(
	'label' => tra( 'Drop Tags' ),
	'confirm_item' => implode("<br>", $tags),
	'warning' => tra( 'These tags will be dropped from this content.<br />This cannot be undone!' ),
	);
$gBitSystem->confirmDialog( $formHash,$msgHash );



?>