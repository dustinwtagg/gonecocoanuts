<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class wpApeGalleryHelperClass {

	static function load( $filesList, $folder='' ){
		if(empty($filesList)) return;
		if(!$folder)$folder=WPAPE_GALLERY_INCLUDES_PATH;
		if(!is_array($filesList)) $filesList=array($filesList);
		for( $j=0;$j<count($filesList);$j++){ 
			$fileName = $filesList[$j];
			if(!$fileName) next();
			if(file_exists($folder.$fileName))require_once $folder.$fileName;
		}
	}
	
    static function check_new_edit_page($new_edit = null){
        global $pagenow;
        if( !is_admin() )return false;
        if( $new_edit=="list" ) return in_array( $pagenow, array( 'edit.php',  ) );
            elseif( $new_edit=="edit" ) return in_array( $pagenow, array( 'post.php' ) );
                elseif($new_edit == "new") return in_array( $pagenow, array( 'post-new.php' ) );
                    else  return in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit.php' ) );
    }

    static function getLicenceFile(){
		$premiumPath 	= '';
		$key_dir  	= 'wpapegallerylicence';
		$key_file 	= 'wpape-licence.php';
		$premiumPath = WPAPE_GALLERY_PATH.$key_file;
		if( file_exists($premiumPath) ) return $premiumPath;
		for($i=-1;$i<6;$i++){ 
			$premiumPath = WP_PLUGIN_DIR.'/'.$key_dir.($i!=-1?'-'.$i:'').'/'.$key_file;
			if ( file_exists($premiumPath) ) return $premiumPath;
		}
		for($i=0;$i<6;$i++){ 
			$premiumPath = WP_PLUGIN_DIR.'/'.$key_dir.$i.'/'.$key_file;
			if ( file_exists($premiumPath) ) return $premiumPath;
		}
		return false;
	}

	static function initAfterInstall(){
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		delete_option( 'ApeGalleryInstall' );
	}

	static function defaultValue($default){
		return wpApeGalleryHelperClass::check_new_edit_page('edit')?'':($default?(string)$default:'');
	}

	static function _t( $text = '', $langDoamin = '' ){
		return __( $text, isset($langDoamin) && $langDoamin  ? $langDoamin :'gallery-images-ape');
	}

	static function _te( $text = '', $langDoamin = ''){
		echo wpApeGalleryHelperClass::_t($text , $langDoamin );
	}

	static function clearString( $str1 = '' ){
		if($str1){
			$str1 = str_replace( 
						array(
						 	'"', "'", '\\', '/', '|', '?',  '!', '@', '#', '<', '>', '&', '^', '%',  '$',  ':', ';', '{', '}', '[', ']',  
						), '', $str1 );
		}
		return $str1;
	}
}