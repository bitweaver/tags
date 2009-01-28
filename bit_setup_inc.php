<?php
global $gBitSystem, $gBitUser, $gBitThemes;

$registerHash = array(
	'package_name' => 'tags',
	'package_path' => dirname( __FILE__ ).'/',
	'service' => LIBERTY_SERVICE_TAGS,
);
$gBitSystem->registerPackage( $registerHash );

if( $gBitSystem->isPackageActive( 'tags' ) && $gBitUser->hasPermission( 'p_tags_view' )) {
	// load css file
	$gBitThemes->loadCss( TAGS_PKG_PATH.'templates/tags.css' );

	require_once( TAGS_PKG_PATH.'LibertyTag.php' );

	$menuHash = array(
		'package_name'  => TAGS_PKG_NAME,
		'index_url'     => TAGS_PKG_URL.'index.php',
		'menu_template' => 'bitpackage:tags/menu_tags.tpl',
	);
	$gBitSystem->registerAppMenu( $menuHash );

	$gLibertySystem->registerService( LIBERTY_SERVICE_TAGS, TAGS_PKG_NAME, array(
			'content_display_function' 	=> 'tags_content_display',
			'content_edit_function' 	=> 'tags_content_edit',
			'content_list_sql_function' => 'tags_content_list_sql',
			'content_store_function'  	=> 'tags_content_store',
			'content_preview_function'  => 'tags_content_preview',
			'content_expunge_function'  => 'tags_content_expunge',
			'content_edit_mini_tpl'		=> 'bitpackage:tags/edit_tags_mini_inc.tpl',
			'content_view_tpl'          => 'bitpackage:tags/view_tags_view.tpl',
			'content_nav_tpl'           => 'bitpackage:tags/view_tags_nav.tpl',
			'content_body_tpl'          => 'bitpackage:tags/view_tags_body.tpl',
			'users_expunge_function'	=> 'tags_user_expunge',
			'content_search_tpl'		=> 'bitpackage:tags/search_inc.tpl'
	) );
}
?>
