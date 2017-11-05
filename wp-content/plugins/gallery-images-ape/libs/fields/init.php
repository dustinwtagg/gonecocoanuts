<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class wpApeGalleryFieldsInit {

	private $dialogPremium = 0;
	private $countGallery = 0;
	private $newPost = 0;
	private $openDialog = 0;

	function __construct(){
		$this->dialogPremium = !WPAPE_GALLERY_PREMIUM ;
		$this->newPost = wpApeGalleryHelperClass::check_new_edit_page('new') && !isset( $_GET['post'] );
		$this->hooks();
	}

	public function hooks() {

		add_action( 'admin_enqueue_scripts', array( $this, 'wpape_setup_admin_scripts' ) );
		if(!WPAPE_GALLERY_PREMIUM) add_action( 'in_admin_header', array( $this, 'wpape_setup_admin_header' ) );
		add_action( 'in_admin_header', array( $this, 'wpape_setup_admin_script' ) );

		add_filter( 'body_class', array( $this, 'addBodyClass' ) );

		if($this->newPost && $this->dialogPremium) add_action( 'wp_loaded', array( $this, 'show_dialog' ) );
	}

	function show_dialog(){
		$all_wp_pages = wp_count_posts (WPAPE_GALLERY_POST );
		$this->countGallery = 	$all_wp_pages->publish + $all_wp_pages->draft + $all_wp_pages->future + 
								$all_wp_pages->pending + $all_wp_pages->private;// + $all_wp_pages->trash;
		$this->countGallery++;		
		$n = 4;
		if( $this->countGallery >= ++$n &&  ( ($this->countGallery % $n) == 0 ) ) $this->openDialog = 1;
	}
	
	public function wpape_setup_admin_script(){
		echo '<script>'
			.'var WPAPE_GALLERY_PREMIUM = '.WPAPE_GALLERY_PREMIUM.';'
		.'</script>';
	}

	
	function addBodyClass( $classes ) {
	    $classes[] = ' wpape_edit ';
	    return $classes;
	}

	public function wpape_setup_admin_header(){
		echo '<div id="wpape_showInformation">'
					.wpApeGalleryHelperClass::_t("We're really appreciate if You update gallery to").' '.WPAPE_GALLERY_BUTTON_PREMIUM.'.'
					.wpApeGalleryHelperClass::_t("It's gonna help us to create more wonderful functions.")
				.'</div>';
	}

	public function wpape_setup_admin_scripts() {

		wp_enqueue_media();
		wp_enqueue_style("wp-jquery-ui-dialog");
		wp_enqueue_script('jquery-ui-dialog');

		if(!WPAPE_GALLERY_PREMIUM){
			wp_register_script('wpape-gallery-info', 		WPAPE_GALLERY_URL.'assets/js/admin/gallery-info.js', array( 'jquery', 'jquery-ui-dialog' ), WPAPE_GALLERY_VERSION, true ); 
			wp_localize_script( 'wpape-gallery-info', 'ape_gallery_js_text', array(
				'title' 	=> __('Gallery Ape', 'gallery-images-ape').' :: '.WPAPE_GALLERY_BUTTON_PREMIUM,
				'close' 	=> wpApeGalleryHelperClass::_t('Continue with free version'),
				'info' 		=> wpApeGalleryHelperClass::_t('Get').' '.WPAPE_GALLERY_BUTTON_PREMIUM,
				'open' 		=> $this->openDialog  ,
			));
			wp_enqueue_script( 'wpape-gallery-info' ); 
		}

		wp_enqueue_script( 	'ape-gallery-bootstrap', 		WPAPE_GALLERY_URL.'assets/vendor/bootstrap/js/bootstrap.min.js', 		array('jquery'), WPAPE_GALLERY_VERSION, false);
		wp_enqueue_style ( 	'ape-gallery-bootstrap', 		WPAPE_GALLERY_URL.'assets/vendor/bootstrap/css/bootstrap.css',			array(), WPAPE_GALLERY_VERSION, 'all');

		wp_enqueue_script( 'ape-gallery-toggles-js', 		WPAPE_GALLERY_URL.'assets/vendor/toggles/js/bootstrap-toggle.js', 		array( 'jquery', 'ape-gallery-bootstrap' ), WPAPE_GALLERY_VERSION, false );
		wp_enqueue_style(  'ape-gallery-toggles-css',		WPAPE_GALLERY_URL.'assets/vendor/toggles/css/bootstrap-toggle.css', 	array(), WPAPE_GALLERY_VERSION, 'all' );

		wp_enqueue_script( 	'ape-gallery-iconset', 			WPAPE_GALLERY_URL.'assets/vendor/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.1.0.min.js', 		array( 'jquery', 'ape-gallery-bootstrap' ), WPAPE_GALLERY_VERSION, true );
		wp_enqueue_script( 	'ape-gallery-icon', 			WPAPE_GALLERY_URL.'assets/vendor/bootstrap-iconpicker/js/bootstrap-iconpicker.js', 							array( 'jquery', 'ape-gallery-bootstrap', 'ape-gallery-iconset' ), WPAPE_GALLERY_VERSION, true );		
		wp_enqueue_style( 	'ape-gallery-icon-css', 		WPAPE_GALLERY_URL.'assets/vendor/bootstrap-iconpicker/css/bootstrap-iconpicker.css', 						array(), WPAPE_GALLERY_VERSION, 'all' );
		wp_enqueue_style( 	'ape-gallery-icon-fonts', 		WPAPE_GALLERY_URL.'assets/vendor/bootstrap-iconpicker/icon-fonts/font-awesome-4.1.0/css/font-awesome.css', 	array(), WPAPE_GALLERY_VERSION, 'all' );
			
		wp_enqueue_script( 	'ape-gallery-color-tinycolor', 	WPAPE_GALLERY_URL.'assets/vendor/color/bootstrap.colorpickersliders.tinycolor.js', 	array( 'jquery', 'ape-gallery-bootstrap' ), WPAPE_GALLERY_VERSION, false );
		wp_enqueue_script( 	'ape-gallery-color', 			WPAPE_GALLERY_URL.'assets/vendor/color/bootstrap.colorpickersliders.js', 			array( 'jquery', 'ape-gallery-bootstrap' ), WPAPE_GALLERY_VERSION, false );
		wp_enqueue_style( 	'ape-gallery-color', 			WPAPE_GALLERY_URL.'assets/vendor/color/bootstrap.colorpickersliders.css', 			array(), WPAPE_GALLERY_VERSION, 'all' );

		wp_enqueue_script( 'ape-gallery-admin-editor', 		WPAPE_GALLERY_URL.'assets/js/admin/gallery.editor.js', 	array( 'jquery' ), WPAPE_GALLERY_VERSION, true );
		wp_enqueue_style ( 	'ape-gallery-admin-editor', 	WPAPE_GALLERY_URL.'assets/css/admin/edit.style.css' );
	}

}
$wpape_fields_init = new wpApeGalleryFieldsInit();
