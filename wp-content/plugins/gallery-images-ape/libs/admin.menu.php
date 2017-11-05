<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class wpApeGalleryAdminMenuClass extends  Gallery_Images_Ape{

	public function hooks(){
		add_action( 'admin_menu', 		array($this, 'addMenu') );
		add_action( 'in_admin_header', 	array($this, 'includeFiles') );
		add_action( 'init', 			array($this, 'menuRedirect') );
	}

	public function includeFiles(){
		wp_enqueue_script( WPAPE_GALLERY_ASSET.'admin-menu-js', WPAPE_GALLERY_URL.'assets/js/admin/menu.fix.js', array( 'jquery' ), WPAPE_GALLERY_VERSION, true ); 
		wp_enqueue_style ( WPAPE_GALLERY_ASSET.'admin-menu-css',  WPAPE_GALLERY_URL.'assets/css/admin/menu.style.css' );
	}

	public function addMenu() {
		add_submenu_page( 
			WPAPE_GALLERY_EDIT_POST_URL,
			'Gallery Ape Options', 
			'Options', 'manage_options', 
			'wpape-gallery-settings', 
			array( $this, 'contentSetting' )
		);

		add_submenu_page( 
			WPAPE_GALLERY_EDIT_POST_URL, 
			'Gallery Ape Demo', 
			'Demos', 
			'manage_options', 
			'wpape-gallery-demo', 
			array( $this, 'emptyContent' )
		);

		add_submenu_page( 
			WPAPE_GALLERY_EDIT_POST_URL, 
			'Our Team', 
			'Our Team', 
			'manage_options', 
			'wpape-gallery-team', 
			array( $this, 'contentTeam' )
		);

		add_submenu_page( 
			WPAPE_GALLERY_EDIT_POST_URL, 
			'Gallery Ape Support', 
			'Support', 
			'manage_options', 
			'wpape-gallery-support', 
			array( $this, 'emptyContent' )
		);
	}

	public function emptyContent(){}

	public function menuRedirect(){
		if( 
			isset($_GET['post_type']) && $_GET['post_type']== WPAPE_GALLERY_POST &&
			isset($_GET['page']) && $_GET['page']=='wpape-gallery-support' 
		) wp_redirect( "https://wpape.net/open.php?type=gallery&action=support" );

		if( 
			isset($_GET['post_type']) && $_GET['post_type']== WPAPE_GALLERY_POST &&
			isset($_GET['page']) && $_GET['page']=='wpape-gallery-demo' 
		) wp_redirect( "https://wpape.net/open.php?type=gallery&action=demo" );
	}

	public function contentTeam(){
		wpApeGalleryHelperClass::load('ourteam.php');
	}

	public function contentSetting(){
		wpApeGalleryHelperClass::load('setting.php');
	}
}

$menuAdmin = new wpApeGalleryAdminMenuClass();