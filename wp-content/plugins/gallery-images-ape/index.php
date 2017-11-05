<?php

/*
Plugin Name: Gallery Images Ape
Plugin URI: https://wpape.net/gallery-wordpress
Description: Gallery Images Ape - image gallery grid with lightbox gallery and video gallery modes. Easy to use as photo gallery for portfolios
Version: 1.6.0
Author: galleryape
Author URI: https://wpape.net/#demos
License: GPL2
Text Domain: gallery-images-ape
Domain Path: /languages
*/

if( !defined('WPINC') || !defined("ABSPATH") ) die();

define("WPAPE_GALLERY", 1); 
define("WPAPE_GALLERY_VERSION", '1.6.0'); 
define("WPAPE_GALLERY_PATH", plugin_dir_path( __FILE__ ));


define("WPAPE_GALLERY_URL", plugin_dir_url( __FILE__ ));
define("WPAPE_GALLERY_INCLUDES_PATH", 	WPAPE_GALLERY_PATH.'libs/');

add_action( 'plugins_loaded', 'wpape_gallery_load_textdomain' );
function wpape_gallery_load_textdomain() {
	load_plugin_textdomain( 'gallery-images-ape', false, dirname( plugin_basename( __FILE__ ) ).'/languages' ); 
}

if( file_exists(WPAPE_GALLERY_INCLUDES_PATH.'classHelper.php') ){
	require_once WPAPE_GALLERY_INCLUDES_PATH.'classHelper.php';
}

wpApeGalleryHelperClass::load( array( 'gallery-images-ape-class.php', 'libs.php') );

$Gallery_Images_Ape_Init = new Gallery_Images_Ape_Init();