<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class Gallery_Images_Ape_Init {
	private $premium = 0;
	private $premiumPath = '';

	function __construct(){
		$this->init();
	}

	function init(){
		$this->defineConstants();
		$this->checkLicence();
		$this->initPluginActivate();
		$this->load();
		$this->hooks();
	}

	function defineConstants(){
		define("WPAPE_GALLERY_NAMESPACE",     	'wpape_');
		define("WPAPE_GALLERY_PREFIX", 			WPAPE_GALLERY_NAMESPACE);

		define("WPAPE_GALLERY_POST",  			'wpape_gallery_type');
		define("WPAPE_GALLERY_FRONTEND_PATH", 	WPAPE_GALLERY_INCLUDES_PATH.'render/');
		define("WPAPE_GALLERY_METOBOX_PATH", 	WPAPE_GALLERY_INCLUDES_PATH.'metabox/');
		define("WPAPE_GALLERY_CMB_PATH", 		WPAPE_GALLERY_INCLUDES_PATH.'fieldsFramework/');
		define("WPAPE_GALLERY_CMB_FILEDS_PATH", WPAPE_GALLERY_INCLUDES_PATH.'fields/');
		define("WPAPE_GALLERY_OFFER", 			0); 
		define("WPAPE_GALLERY_BUTTON_PREMIUM",  __('Premium Version', 'gallery-images-ape'));
		define("WPAPE_GALLERY_EDIT_POST_URL", 	'edit.php?post_type='.WPAPE_GALLERY_POST);

		define("WPAPE_GALLERY_ASSET", 	'gallery-images-ape-file-');

	}

	function initPluginActivate(){
		register_activation_hook( __FILE__, 	array( $this, 'pluginActivate') 	);
		register_deactivation_hook( __FILE__, 	array( $this, 'pluginDeactivate') 	);
	}

	function pluginActivate(){
		wpApeGalleryHelperClass::load('classActivator.php');
		ApeGalleryActivator::activate();
	}

	function pluginDeactivate() {
		wpApeGalleryHelperClass::load('classActivator.php');
		ApeGalleryActivator::deactivate();
	}

	function load(){
		wpApeGalleryHelperClass::load( array( 'editor.button.php', 'gallery.copy.php', 'widget.php') );

		wpApeGalleryHelperClass::load('static.php');
	}

	function hooks(){
		add_action( 'init', 			array( $this, 'registerPostType') );
		
		add_action( 'plugins_loaded', 	array( $this, 'loadFiles') );
		add_action( 'admin_init', 		array( $this, 'optionsInit') );

		if($this->getCurrentScreen()==WPAPE_GALLERY_POST){
			if( !WPAPE_GALLERY_PREMIUM && wpApeGalleryHelperClass::check_new_edit_page('new')) add_action( 'load-post-new.php', array($this, 'redirect') );
			if( wpApeGalleryHelperClass::check_new_edit_page('new') || wpApeGalleryHelperClass::check_new_edit_page('edit') ) add_action('cmb2_init', array($this,'loadMetaBox'));
		}

		if ( is_admin()===true ) {
			add_action( 'wp_ajax_ape_gallery_save_hide_wizard', array( $this, 'hideWizard') );
			add_filter( 'plugin_action_links', 					array( $this, 'plugin_actions_links'), 10, 2 );
		}
	}
	
	public function plugin_actions_links( $links, $file ) {
		static $plugin;

		if( 
			( $file == 'gallery-images-ape/index.php' || $file == 'ape-gallery/index.php' ) && 
			current_user_can('manage_options') 
		){
			array_unshift(
				$links,
				sprintf( '<a href="%s">%s</a>', $this->settings_page_url(), __( 'Settings' ) )
			);
		}
		return $links;
	}

	private function settings_page_url() {
		return esc_attr( admin_url('edit.php?post_type=wpape_gallery_type&page=wpape-gallery-settings') );
	}

	function hideWizard(){
		//get_option( WPAPE_GALLERY_NAMESPACE.'hideWizard', 0) ;
		//delete_option( WPAPE_GALLERY_NAMESPACE.'hideWizard' );
		update_option( WPAPE_GALLERY_NAMESPACE.'hideWizard', 1 );
		echo 1;
		wp_die();
	}

	function checkLicence(){
		$this->premiumPath = wpApeGalleryHelperClass::getLicenceFile();
		if($this->premiumPath){
			define("WPAPE_GALLERY_PREMIUM", 1);
			define("WPAPE_GALLERY_LICENCE_PATH", $this->premiumPath );
		} else {
			define("WPAPE_GALLERY_PREMIUM", 0);
		}
	}

	function registerPostType(){
		wpApeGalleryHelperClass::load('classUpdate.php');
		$update = new ApeGalleryUpdate();
		
		register_post_type( WPAPE_GALLERY_POST, array(
	        'labels' => array(
				'name' => 'Gallery Ape',
				'singular_name' => __( 'Gallery Ape', 		'gallery-images-ape' ),
				'all_items'     => __( 'Overview', 			'gallery-images-ape' ),
				'add_new'       => __( 'New Gallery', 		'gallery-images-ape' ),
				'add_new_item'  => __( 'New Gallery', 		'gallery-images-ape' ),
				'edit_item'     => __( 'Edit Gallery', 		'gallery-images-ape' ),
	        ),
			'rewrite'         => array( 'slug' => 'ape_gallery', 'with_front' => true ),
			'public'=>true, 'has_archive'=>false, 'hierarchical'=>true,'supports'=>array('title','comments','page-attributes'),
			'menu_icon'=>'dashicons-palmtree',
	    ));

	    $this->initAfterInstall();
	}

	function initAfterInstall(){
		if(is_admin()&&get_option('ApeGalleryInstall')=='now') wpApeGalleryHelperClass::initAfterInstall();
	}


	function getCurrentScreen() {
        global $post, $typenow, $current_screen;
        if($post&&$post->post_type) return $post->post_type;
          elseif($typenow) return $typenow;
          elseif($current_screen && $current_screen->post_type ) return $current_screen->post_type;
          elseif(isset($_REQUEST['post_type'])) return sanitize_key( $_REQUEST['post_type'] );
          elseif(isset($_REQUEST['post'])&&get_post_type($_REQUEST['post']))return get_post_type($_REQUEST['post']);
        return null;
    }

    function redirect(){
		$page=1;$wpape_gallery=new WP_Query();++$page;
		$all_wp_pages=$wpape_gallery->query( array('post_type'=>WPAPE_GALLERY_POST, 'post_status' => array('any','trash')) );
		if(count($all_wp_pages)>=++$page){
			delete_option( 'gallery-images-ape-dialog' );
			add_option( 'gallery-images-ape-dialog', 1 );
			wp_redirect("edit.php?post_type=".WPAPE_GALLERY_POST."&dialogpremium=1");
		}
    }

	function loadFiles(){
		if($this->getCurrentScreen()==WPAPE_GALLERY_POST){
			if( wpApeGalleryHelperClass::check_new_edit_page('list') ) wpApeGalleryHelperClass::load('gallery.list.php');
			
			if(!WPAPE_GALLERY_PREMIUM) wpApeGalleryHelperClass::load('gallery.banner.php');
			
			if(  wpApeGalleryHelperClass::check_new_edit_page('new') || wpApeGalleryHelperClass::check_new_edit_page('edit') ){
				wpApeGalleryHelperClass::load('init.php', WPAPE_GALLERY_CMB_PATH);
				wpApeGalleryHelperClass::load('gallery.edit.php');
				wpApeGalleryHelperClass::load( array( 'init.php', 'gallery/wpape-gallery-manage.php','size.php','border.php','shadow.php','switch.php','select.php','colums.php','text.php','font.php', 'multisize.php', 'radiobutton.php', 'padding.php', 'icon.php', 'thumboption.php', 'space.php', 'social.php'), WPAPE_GALLERY_CMB_FILEDS_PATH);
			}
		}

		if(is_admin()) wpApeGalleryHelperClass::load(array('gallery.images.library.php', 'admin.menu.php' ));
		wpApeGalleryHelperClass::load(
			array(
				'classSource.php',
				'classRenderHelper.php',
				'Gallery_Images_Ape_Render.php',
				'classGallery.php',
				'classView.php'
			),WPAPE_GALLERY_FRONTEND_PATH);
	}

	function loadMetaBox(){
		wpApeGalleryHelperClass::load('resources.php', WPAPE_GALLERY_METOBOX_PATH);
	   	if(isset($_GET['post']))  wpApeGalleryHelperClass::load('shortcode.php',WPAPE_GALLERY_METOBOX_PATH);
	 	wpApeGalleryHelperClass::load( array(  'static.php', 'interface.php', 'size.php', 'thumbnails.php', 'menu.php'), WPAPE_GALLERY_METOBOX_PATH);
		/* 'overview.php', */
		if(!WPAPE_GALLERY_PREMIUM ) wpApeGalleryHelperClass::load('information.php', WPAPE_GALLERY_METOBOX_PATH); 
		wpApeGalleryHelperClass::load('lightbox.php',WPAPE_GALLERY_METOBOX_PATH);
	}

	function optionsInit() {
		register_setting( 'wpape_gallery_settings', WPAPE_GALLERY_NAMESPACE.'jqueryVersion' );
		/*register_setting( 'wpape_gallery_settings', WPAPE_GALLERY_NAMESPACE.'switchStyle' );*/
		register_setting( 'wpape_gallery_settings', WPAPE_GALLERY_NAMESPACE.'delay' );	

		register_setting( 'wpape_gallery_settings_clone', WPAPE_GALLERY_NAMESPACE.'copyPrefix' );	
		register_setting( 'wpape_gallery_settings_clone', WPAPE_GALLERY_NAMESPACE.'copySuffix' );
		register_setting( 'wpape_gallery_settings_clone', WPAPE_GALLERY_NAMESPACE.'copyDate' );
		register_setting( 'wpape_gallery_settings_clone', WPAPE_GALLERY_NAMESPACE.'emptySlug' );

		register_setting( 'wpape_gallery_settings_source', WPAPE_GALLERY_NAMESPACE.'sourceGalleryEnable' );	
		register_setting( 'wpape_gallery_settings_source', WPAPE_GALLERY_NAMESPACE.'sourceGallery' );	
		register_setting( 'wpape_gallery_settings_source', WPAPE_GALLERY_NAMESPACE.'shortcode' );	
	}
}

