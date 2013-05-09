<?php
/**
 * @version
 * @package tags
 * @subpackage modules
 */

/**
 * required setup
 */
require_once( TAGS_PKG_PATH."LibertyTag.php" );

// moduleParams contains lots of goodies: extract for easier handling
extract( $moduleParams );

$listHash = array(
	'sort'		=>  ( !empty( $module_params['sort'] ) ? $module_params['sort'] : NULL ),
	'sort_mode'   => ( !empty( $module_params['sort_mode'] ) ? $module_params['sort_mode'] : 'tag_asc' ),
//	do not enable until getList can return max of most popular requires more sophisticated query
//	'max_records' => $module_rows,
	'user'        => ( !empty( $module_params['user'] ) ? $module_params['user'] : NULL ),
	'group_id'     => ( @BitBase::verifyId( $module_params['group_id'] ) ? $module_params['group_id'] : NULL ),
	'max_popular' =>  ( !empty( $module_params['max_popular'] ) ? $module_params['max_popular'] : NULL ),
);

$tag = new LibertyTag();

$listData = $tag->getList( $listHash );
$_template->tpl_vars['modTagData'] = new Smarty_variable( $listData["data"] );
?>
