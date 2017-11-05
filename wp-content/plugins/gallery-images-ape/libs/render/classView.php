<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class wpApeGalleryViewClass extends Gallery_Images_Ape{

	public function hooks(){
		add_shortcode( 'ape-gallery', array($this, 'Shortcode') );

		add_filter( 'the_content', array($this, 'ActionShortcode') );

		if( get_option( WPAPE_GALLERY_NAMESPACE.'sourceGalleryEnable', 0 ) ){
			add_action( 'wp_loaded', array($this, 'OverwriteShortCode') ) ;
		}
	}


	public function OverwriteShortCode($attr){
		remove_shortcode('gallery');
		add_shortcode( 'gallery', array($this, 'ShortCodeFromIds') );

		if( $shortcode = wpApeGalleryHelperClass::clearString( get_option(WPAPE_GALLERY_NAMESPACE.'shortcode', '') )  ){
			$shortcode = explode( ',', $shortcode);
			for ($i=0; $i < count($shortcode); $i++) { 
				$shortcode[$i] = trim($shortcode[$i]);
				if($shortcode[$i]) add_shortcode( $shortcode[$i] , array($this, 'ShortCodeFromIds') );
			}
		}
	} 
	

	public function ShortCodeFromIds( $attr ) {
	 	$retHTML = '';
		if( isset($attr) && isset($attr['ids']) ){
			//print_r($attr);
			$gallery = new apeGallery( $attr, $attr['ids'] );
			$retHTML = $gallery->getGallery();
		} else $retHTML = wpApeGalleryHelperClass::_t('ApeGallery shortcode is incorrect');
		return  $retHTML;
	}

	public function Shortcode( $attr ) {
	 	$retHTML = '';
		if( isset($attr) && ( isset($attr['id']) || isset($attr[0]) )  ){
			$gallery = new apeGallery($attr);
			$retHTML = $gallery->getGallery();
		} else $retHTML = wpApeGalleryHelperClass::_t('ApeGallery shortcode is incorrect');
		return  $retHTML;
	}



	public function ActionShortcode($content){
	    global $post;
	    if ( post_password_required() ) return $content;
	    $retHTML = '';
	    if( is_main_query() && get_post_type() == WPAPE_GALLERY_POST) $retHTML = do_shortcode("[ape-gallery id={$post->ID}]");
		return $content.$retHTML;
	}
}

$classView = new wpApeGalleryViewClass();


if(!function_exists('apeGallery')){
	function apeGallery( $id = 0, $noEcho = 0 ) {
		$id = (int) $id;
		if(!$id  ) return ;
	 	$retHTML = '';
	 	$attr = array( 'id' => $id );
		$gallery = new apeGallery($attr);
		$retHTML = $gallery->getGallery();
		if(!$noEcho){
			echo $retHTML;
			$retHTML = '';
		}
		return  $retHTML;
	}
}


