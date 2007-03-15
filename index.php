<?php
require_once( "../bit_setup_inc.php" );
require_once( TAGS_PKG_PATH."LibertyTag.php" );

$gBitSystem->verifyPackage( 'tags' );

$tag = new LibertyTag();

$listHash = $_REQUEST;
$taggedContent = $tag->getList( $listHash );

$gBitSmarty->assign( 'listInfo', $_REQUEST['listInfo'] );
$gBitSmarty->assign( 'taggedcontent', $taggedContent["data"] );
$gBitSystem->display( 'bitpackage:tags/list_content.tpl', tra( 'Tagged Content' ) );
?>