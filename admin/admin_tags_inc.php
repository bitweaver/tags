<?php
// $Header: /cvsroot/bitweaver/_bit_tags/admin/admin_tags_inc.php,v 1.2 2007/03/22 18:14:36 nickpalmer Exp $
// Copyright (c) 2005 bitweaver Tags
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

$formTagsDisplayOptions = array(
	"tags_in_view" => array(
		'label' => 'Tags In View',
		'note' => 'Shows the tags in the "view" location',
		'type' => 'toggle',
	),
	"tags_in_nav" => array(
		'label' => 'Tags In Nav',
		'note' => 'Shows the tags in the "nav" location',
		'type' => 'toggle',
	),
	"tags_in_body" => array(
		'label' => 'Tags In Body',
		'note' => 'Shows the tags in the "body" location',
		'type' => 'toggle',
	),
);
$gBitSmarty->assign( 'formTagsDisplayOptions', $formTagsDisplayOptions );

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

if( !empty( $_REQUEST['tags_preferences'] ) ) {
	$tags = array_merge($formTagsDisplayOptions, $formTagsStripOptions);
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
}

?>