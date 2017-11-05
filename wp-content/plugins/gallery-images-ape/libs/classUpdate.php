<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class ApeGalleryUpdate {

	public $runUpdate = 1;
	public $installVersion = false;
	public $newVersion = false;

	public function __construct(){
		$this->installVersion = get_option( 'wpApeGalleryInstallVersion' );
		if(!$this->installVersion) $this->installVersion = 0;
		$this->newVersion = WPAPE_GALLERY_VERSION;
		if( $this->installVersion && $this->installVersion == $this->newVersion )  $this->runUpdate = false;
		if( $this->runUpdate ){
			
			delete_option("wpApeGalleryInstallVersion");
			add_option( "wpApeGalleryInstallVersion", WPAPE_GALLERY_VERSION );
			
			delete_option("ApeGalleryInstall");
			add_option( 'ApeGalleryInstall', 'now' );

			if( !get_option( 'ApeGalleryOptionVersion' ) ) add_option( 'ApeGalleryOptionVersion', '1' );
		}
	}
}
