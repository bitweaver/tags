<?php
// $Header: /cvsroot/bitweaver/_bit_tags/admin/admin_tags_inc.php,v 1.7 2009/10/01 14:17:05 wjames5 Exp $
// Copyright (c) 2005 bitweaver Tags
// All Rights Reserved. See below for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See http://www.gnu.org/copyleft/lesser.html for details.

$formTagsDisplayOptions = array(
	"tags_in_nav" => array(
		'label' => 'Nav',
		'note' => 'Shows the tags in the "nav" location',
		'type' => 'toggle',
	),
	"tags_in_body" => array(
		'label' => 'Body',
		'note' => 'Shows the tags in the "body" location',
		'type' => 'toggle',
	),
	"tags_in_view" => array(
		'label' => 'View',
		'note' => 'Shows the tags in the "view" location',
		'type' => 'toggle',
	),
);
$gBitSmarty->assign( 'formTagsDisplayOptions', $formTagsDisplayOptions );

/*
$formTagsOtherOptions = array(
	"tags_on_comments" => array(
		'label' => 'Allow Tags on Comments',
		'note' => 'Allows tags to be placed on comments',
		'type' => 'toggle',
	),
);
$gBitSmarty->assign( 'formTagsOtherOptions', $formTagsOtherOptions );
*/

$formTagsStripOptions = array(
	"tags_lowercase" => array(
		'label' => 'Lowercase Tags',
		'note' => 'Convert all Tags to lowercase',
		'type' => 'toggle',
	),
	"tags_strip_spaces" => array(
		'label' => 'Strip Spaces',
		'note' => 'Strip white space from tags',
		'type' => 'toggle',
	),
	"tags_strip_nonword" => array(
		'label' => 'Strip Non-Word',
		'note' => 'Strip non-word characters from tags',
		'type' => 'toggle',
	),
	"tags_strip_regexp" => array(
		'label' => 'Strip Custom',
		'note' => 'A regular expression used to strip. Be VERY careful with this expression. This should include the delimiters for the regular expression.',
		'type' => 'input',
	),
	"tags_strip_replace" => array(
		'label' => 'Strip Custom Replacement',
		'note' => 'The expresion used in the replacement made with the Strip Custom above. Leave blank to just strip any matches.',
		'type' => 'input',
	),
);
$gBitSmarty->assign( 'formTagsStripOptions', $formTagsStripOptions );

$formTagLists = array(
	"tags_list_id" => array(
		'label' => 'ID',
		'note' => 'Content ID',
		'type' => 'toggle',
	),
	"tags_list_title" => array(
		'label' => 'Title',
		'note' => 'content title',
		'type' => 'toggle',
	),
	"tags_list_type" => array(
		'label' => 'Type',
		'note' => 'content type',
		'type' => 'toggle',
	),
	"tags_list_author" => array(
		'label' => 'Author',
		'note' => 'author of tagged content',
		'type' => 'toggle',
	),
	"tags_list_editor" => array(
		'label' => 'Editor',
		'note' => 'last editor',
		'type' => 'toggle',
	),
	"tags_list_lastmodif" => array(
		'label' => 'last modified',
		'note' => 'modification date',
		'type' => 'toggle',
	),
	"tags_list_ip" => array(
		'label' => 'IP',
		'note' => 'editor\'s IP',
		'type' => 'toggle',
	),
);
$gBitSmarty->assign( 'formTagLists',$formTagLists );

// list of content types that can be tagged
// 'sample' is presented anyways, if sample package is installed
// 'bitcomment' (?) ... isFeatureActive('tags_on_comments')
$exclude = array( 'bituser', 'tikisticky', 'sample', 'bitcomment');
foreach( $gLibertySystem->mContentTypes as $cType ) {
	if( !in_array( $cType['content_type_guid'], $exclude ) ) {
		$formTaggable['guids']['tags_tag_'.$cType['content_type_guid']]  = $cType['content_description'];
	}
}

if( !empty( $_REQUEST['tags_preferences'] ) ) {
	$tags = array_merge($formTagsDisplayOptions, $formTagsStripOptions, $formTagLists);
	//	$tags = array_merge( $formTagsOptions );
	foreach( $tags as $item => $data ) {
		if( $data['type'] == 'numeric' ) {
			simple_set_int( $item, TAGS_PKG_NAME );
		} elseif( $data['type'] == 'toggle' ) {
			simple_set_toggle( $item, TAGS_PKG_NAME );
		} elseif( $data['type'] == 'input' ) {
			simple_set_value( $item, TAGS_PKG_NAME );
		}
	}
	foreach( array_keys( $formTaggable['guids'] ) as $taggable ) {
		$gBitSystem->storeConfig( $taggable, ( ( !empty( $_REQUEST['taggable_content'] ) && in_array( $taggable, $_REQUEST['taggable_content'] ) ) ? 'y' : NULL ), TAGS_PKG_NAME );
	}

}

// check the correct packages in the package selection
foreach( $gLibertySystem->mContentTypes as $cType ) {
	if( $gBitSystem->getConfig( 'tags_tag_'.$cType['content_type_guid'] ) ) {
		$formTaggable['checked'][] = 'tags_tag_'.$cType['content_type_guid'];
	}
}

$gBitSmarty->assign( 'formTaggable', $formTaggable );

?>