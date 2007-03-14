<?php
$tables = array(
  'tags' => "
    tag_id I4 NOTNULL,
    tag C(64) NOTNULL
  ",

  'tags_content_map' => "
    tag_id I4 NOTNULL,
    content_id I4 NOTNULL,
    tagger_id I4 NOTNULL,
    tagged_on I8 NOTNULL
    CONSTRAINT ', CONSTRAINT `tags_content_map_tag_ref` FOREIGN KEY (`tag_id`) REFERENCES `".BIT_DB_PREFIX."tags`( `tag_id` )
                , CONSTRAINT `tags_content_map_content_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content`( `content_id` )
                , CONSTRAINT `tags_content_map_tagger_id_ref` FOREIGN KEY (`tagger_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content`( `content_id` )'
  "
);

global $gBitInstaller;

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( TAGS_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageInfo( TAGS_PKG_NAME, array(
	'description' => "A simple Liberty Service that any package can use to tag its content with key words.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
) );


// ### Sequences
$sequences = array (
  'tags_tag_id_seq' => array( 'start' => 1 ),
);
$gBitInstaller->registerSchemaSequences( TAGS_PKG_NAME, $sequences );
?>
