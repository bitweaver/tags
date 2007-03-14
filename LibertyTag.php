<?php

require_once( KERNEL_PKG_PATH.'BitBase.php' );

class LibertyTag extends LibertyBase {
	var $mContentId;

	function LibertyTag( $pContentId=NULL ) {
		LibertyBase::LibertyBase();
		$this->mContentId = $pContentId;
	}


	/* Delete when package complete! -wjames5
	 * methods needed
	 *
	 * get all tags limited by content_id		<- load
	 * get all tags								<- getList
	 * get all content for tag_id				<- getContentList
	 * get tags by map use count				<- getList with map refs count
	 * get tags	sorted by tagged date			<- getList sorted by map tagged date
	 *
	 * store new tags from tags array
	 * store new tag-content map for content_id
	 * expunge tag and all tag-content maps
	 * expunge tag-content map for content_id
	 *
	 */


	/**
	* Load all the tags for a given ContentId
	* @param pParamHash be sure to pass by reference in case we need to make modifcations to the hash
	**/
	function load() {
		if( $this->isValid() ) {
			$query = "
					SELECT tgc.*, tg.* 
					FROM `".BIT_DB_PREFIX."tags_content_map` tgc
						INNER JOIN `".BIT_DB_PREFIX."tags` tg ON tg.`tag_id` = tgc.`tag_id`
					WHERE tgc.`content_id`=?";					
			$this->mInfo = $this->mDb->getRow( $query, array( $this->mContentId ) );
		}
		return( count( $this->mInfo ) );
	}

	/**
	* Make sure the data is safe to store
	* @param array pParams reference to hash of values that will be used to store the page, they will be modified where necessary
	* @return bool TRUE on success, FALSE if verify failed. If FALSE, $this->mErrors will have reason why
	* @access private
	**/
	function verify( &$pParamHash ) {
		$pParamHash['tag_store'] = array();

		// we're not doing anything if no tag is passed
		if(!empty( $pParamHash['tag'])){	
			$pParamHash['tag_store']['tag'] = $pParamHash['tag'];			
		} else {
			$this->mErrors['tag'] = "No tag given.";
		}
		if( isset( $pParamHash['tagged_on']) ){	
			$pParamHash['tag_store']['tagged_on'] = $pParamHash['tagged_on'];			
		} else {
			$pParamHash['tag_store']['tagged_on'] = $gBitSystem->getUTCTime();
		}
		if( @$this->verifyId( $pParamHash['content_id']) ){	
			$pParamHash['tag_store']['content_id'] = $pParamHash['content_id'];			
		} else {
			$this->mErrors['content_id'] = "No content id specified.";
		}
		// is this the best way to associate a user_id? should it even be included? -wjames5
		if( @$this->verifyId( $pParamHash['user_id']) ){	
			$pParamHash['tag_store']['tagger_id'] = $pParamHash['user_id'];			
		} else {
			$this->mErrors['user_id'] = "No user id specified.";
		}
		
		return( count( $this->mErrors )== 0 );
	}
	
	/**
	* @param array pParams hash of values that will be used to store the page
	* @return bool TRUE on success, FALSE if store could not occur. If FALSE, $this->mErrors will have reason why
	* @access public
	**/
	function store( &$pParamHash ) {
		if( $this->verify( $pParamHash ) ) {
			$this->mDb->StartTrans();
			if (!empty($pParamHash['tag_store'])) {
				$pParamHash['tag_store']['tag_id'] = $this->mTagId;
				$tagtable = BIT_DB_PREFIX."tags"; 
				$maptable = BIT_DB_PREFIX."tags_content_map";
				$this->mDb->StartTrans();				
				
				if( $this->mTagId ) {
						$this->mDb->associateInsert( $maptable, $pParamHash['tag_store'] );
				} else {
					$pParamHash['tag_store']['tag_id'] = $this->mDb->GenID( 'tags_tag_id_seq' );
					if ( $this->mDb->associateInsert( $tagtable, $pParamHash['tag_store'] ) ){
						$this->mDb->associateInsert( $maptable, $pParamHash['tag_store'] );
						$this->mTagId = $pParamHash['tag_store']['tag_id'];
					}
				}
			}
			$this->mDb->CompleteTrans();
			// since we use store generally in a loop of several tags we should not load here
			//$this->load();
		}
		return( count( $this->mErrors )== 0 );
	}


	/* make tag data is safe to store
	 */
	function verifyTagsMap( &$pParamHash ) {
		global $gBitUser, $gBitSystem;

		$pParamHash['map_store'] = array();
		
		//this is to set the time we add content to a tag.
		$timeStamp = $gBitSystem->getUTCTime();
		
		$tagMixed = $pParamHash['tags']; //need to break up this string
		if( !empty( $tagMixed )){
			if (!is_array( $tagMixed ) && !is_numeric( $tagMixed ) ){
				$tagIds = explode( ",", $tagMixed );
			}else if ( is_array( $tagMixed ) ) {
				$tagIds = $tagMixed;
			}else if ( is_numeric( $tagMixed ) ) {
				$tagIds = array( $tagMixed );
			}
		}
	
		foreach( $tagMixed as $value ) {
			//how do we sanitize tags here? -wjames5
			if( !empty($value) ) {
				array_push( $pParamHash['map_store'], array( 
					'tag' => $value, 
					'tagged_on' => $timeStamp,
					'content_id' => $this->$mContentId, 
					'user_id' => $this->$mUserId, 
				));
			} else {
				$this->mErrors[$value] = "Invalid tag.";
			}
		}		

		return ( count( $this->mErrors ) == 0 );
	}
	
	
	/**
	* @param array pParams hash includes mix of tags that will be storeded and associated with a ContentId used by service
	* @return bool TRUE on success, FALSE if store could not occur. If FALSE, $this->mErrors will have reason why
	* @access public
	**/
	function storeTags( &$pParamHash ){
		global $gBitSystem;
		if( $this->verifyTagsMap( $pParamHash ) ) {
			if( $this->isValid() ) {
				foreach ( $pParamHash['map_store'] as $value) {
					$result = $this->store( $value );					
				}
				$this->load();
			}
		}
		return ( count( $this->mErrors ) == 0 );
	}


	/**
	* check if the mContentId is set and valid
	*/
	function isValid() {
		return( @BitBase::verifyId( $this->mContentId ) );
	}

	/**
	* This function removes a tag entry
	**/
	function expunge( $tag_id ) {
		$ret = FALSE;
		if( $this->isValid() ) {
			$query = "DELETE FROM `".BIT_DB_PREFIX."tags` WHERE `tag_id` = ?";
			$result = $this->mDb->query( $query, array( $tag_id ) );
			
			// remove all references to tag in tags_content_map
			$query_map = "DELETE FROM `".BIT_DB_PREFIX."tags_content_map` WHERE `tag_id` = ?";			
			$result = $this->mDb->query( $query_map, array( $tag_id ) );			
		}
		return $ret;
	}

	/**
	* This function removes all references to contentid from tags_content_map
	**/
	function expungeContentFromTagMap(){
		$ret = FALSE;
		if( $this->isValid() ) {
			$query_map = "DELETE FROM `".BIT_DB_PREFIX."tags_content_map` WHERE `content_id` = ?";			
			$result = $this->mDb->query( $query_map, array( $this->mContentId ) );			
		}
		return $ret;
	}
	
	/**
	* This function gets a list of tags
	**/
	function getList( &$pParamHash ) {
		global $gBitUser, $gBitSystem;

		$sort_mode_prefix = 'lc';
		if( empty( $pListHash['sort_mode'] ) ) {
			$pListHash['sort_mode'] = 'title_desc';
		}

		/**
		* @TODO this all needs to go in in some other getList type method
		* and these are just sketches - need to be different kinds of queries in most cases
		**/
		/*
		// get all tags limited by content_id
		if( @$this->verifyId( $pParamHash['content_id'] ) ) {
			$selectSql =,"tgc.*, lc.*";
			$joinSql .=	" 
						INNER JOIN `".BIT_DB_PREFIX."tags_content_map` tgc ON tg.`tag_id`= tgc.`tag_id`
						INNER JOIN      `".BIT_DB_PREFIX."liberty_content`       lc ON lc.`content_id`         = tgc.`content_id`";
			$whereSql .= " AND tgc.`content_id` = ? ";
			$bindVars[] = $pParamHash['content_id'];
		} 
		
		// get tags by most hits on content
		if ($pParamHash['sort_mode'] == 'hits_desc') {
			$joinSql .=	"LEFT OUTER JOIN `".BIT_DB_PREFIX."liberty_content_hits` lch ON lc.`content_id`         = lch.`content_id`";
		}
		// get tags by map use count
		if ($pParamHash['sort_mode'] == 'cant_desc') {
			$sort_mode_prefix = 'tgc';
		}	
		// get tags	sorted by tagged date			<- getList sorted by map tagged date
		if ($pParamHash['sort_mode'] == 'tagged_on_desc') {
			$sort_mode_prefix = 'tgc';
		}	
		*/

		$sort_mode = $sort_mode_prefix . '.' . $this->mDb->convertSortmode( $pListHash['sort_mode'] ); 

		// get all tags
		$query = "
			SELECT tg.*
				$selectSql
			FROM `".BIT_DB_PREFIX."tags` tg
				$joinSql
			ORDER BY $sort_mode";

		$query_cant = "
			SELECT COUNT( * ) 
			FROM `".BIT_DB_PREFIX."tags` tg
				$joinSql";
		
		$result = $this->mDb->query($query,$bindVars,$pParamHash['max_records'],$pParamHash['offset']);
		$cant = $this->mDb->getOne($query_cant,$bindVars);
		$ret = array();

		$comment = &new LibertyComment();
		while ($res = $result->fetchRow()) {
		}
		
		$pParamHash["data"] = $ret;
		$pParamHash["cant"] = $cant;

		return $pParamHash;
	}	
	
}

/********* SERVICE FUNCTIONS *********/

function tags_content_load_sql() {
	global $gBitSystem;
	$ret = array();
	/* this isnt right -wjames5
	$ret['select_sql'] = " , tgc.`tag_id`, tgc.`tagger_id`, tgc.`tagged_on`, tg.`tag`";
	$ret['join_sql'] = " 
			LEFT JOIN `".BIT_DB_PREFIX."tags_content_map` tgc ON ( lc.`content_id`=tgc.`content_id` )
			LEFT JOIN `".BIT_DB_PREFIX."tags` tg ON ( tg.`tag_id`=tgc.`tag_id` )";
	*/
	return $ret;
}
/**
 * @param
 **/
function tags_content_list_sql( &$pObject, $pParamHash=NULL ) {
	global $gBitSystem;
	$ret = array();
	/* this isnt right -wjames5
	$ret['select_sql'] = " , tag.`lat`, tag.`lng`, tag.`amsl`, tag.`amsl_unit`"; 
	$ret['join_sql'] = " LEFT JOIN `".BIT_DB_PREFIX."tag` tag ON ( lc.`content_id`=tag.`content_id` )";
	if (isset($pParamHash['up_lat']) && isset($pParamHash['right_lng']) && isset($pParamHash['down_lat']) && isset($pParamHash['left_lng']) ) {	
	  if ($pParamHash['left_lng'] < $pParamHash['right_lng']){	
		  $ret['where_sql'] = ' AND tag.`lng` >= ? AND tag.`lng` <= ? AND tag.`lat` <= ? AND tag.`lat` >= ? ';
		}else{
		  $ret['where_sql'] = ' AND ( tag.`lng` >= ? OR tag.`lng` <= ? ) AND tag.`lat` <= ? AND tag.`lat` >= ? ';
    }
		$ret['bind_vars'][] = $pParamHash['left_lng'];
		$ret['bind_vars'][] = $pParamHash['right_lng'];
		$ret['bind_vars'][] = $pParamHash['up_lat'];
		$ret['bind_vars'][] = $pParamHash['down_lat'];
	}
    if (isset($pParamHash['tag_notnull'])){
		$ret['where_sql'] = ' AND tag.`lng` IS NOT NULL AND tag.`lng` IS NOT NULL ';
    }
    */
	return $ret;
}

/**
 * @param includeds a string or array of 'tags' and contentid for association.
 **/
function tags_content_store( &$pObject, &$pParamHash ) {
	global $gBitSystem;
	$errors = NULL;
	// If a content access system is active, let's call it
	if( $gBitSystem->isPackageActive( 'tags' ) ) {
		$tag = new LibertyTag( $pObject->mContentId );
		if ( !$tag->storeTags( $pParamHash ) ) {
			$errors=$tag->mErrors;
		}
	}
	return( $errors );
}

function tags_content_preview( &$pObject) {
	global $gBitSystem;
	if ( $gBitSystem->isPackageActive( 'tags' ) ) {		
		if (isset($_REQUEST['tags'])) {
			$pObject->mInfo['tags'] = $_REQUEST['tags'];
		}
	}
}

function tags_content_expunge( &$pObject ) {
	$tag = new LibertyTag( $pObject->mContentId );
	$tag->expungeContentFromTagMap();
}
?>
