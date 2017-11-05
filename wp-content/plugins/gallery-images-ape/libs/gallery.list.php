<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class wpApeGalleryListingClass {

	private 	$dialogPremium = 0;
	private $wizard = 0;

	function __construct(){
		$this->dialogPremium = isset($_GET['dialogpremium']) && $_GET['dialogpremium'] && !WPAPE_GALLERY_PREMIUM ;
 		
		$this->wizard = !(int) get_option( WPAPE_GALLERY_NAMESPACE.'hideWizard', 0);

		$this->hooks();
	}

	function hooks(){
		add_action( 'init', 												array( $this, 'addCssFiles') );
		
		add_action( 'manage_'.WPAPE_GALLERY_POST.'_posts_custom_column', 	array( $this, 'addCols'), 10, 2 );
		add_filter( 'manage_'.WPAPE_GALLERY_POST.'_posts_columns' , 		array( $this, 'addTitleCols') );

		if( $this->dialogPremium ) 	add_action( 'in_admin_header', array( $this, 'infoBox') );
		if( $this->wizard ) 		add_action( 'in_admin_header', array( $this, 'wizard') 	);
	}

	function addCssFiles(){
		wp_enqueue_style ('wpape-gallery-listing-style', WPAPE_GALLERY_URL.'assets/css/admin/list.style.css', array( ), WPAPE_GALLERY_VERSION );
	}

	function addCols( $column, $post_id ) {
		switch ( $column ) {
			case 'wpape_gallery_images' :
				//global $post;
				$images = get_post_meta( $post_id, WPAPE_GALLERY_NAMESPACE.'galleryImages', true);
				if(count($images)){
					if( isset($images[0]) && trim($images[0])!='' ){
						echo '<a href="post.php?post='.$post_id.'&action=edit&ape_media_show=1" title="">';
							echo '<span class="dashicons-before dashicons-format-gallery"> '.count($images).'</span>'; 	
						echo '</a>';
					}
				}		    
			break;

		   	case 'wpape_gallery' :
			    echo '<span>[ape-gallery '.$post_id.']</span>'; 
			break;

		   	case 'wpape_gallery_code' :
			    echo '<span>apeGallery( '.$post_id.' ); </span>'; 
			break;
	    }
	}


	function addTitleCols($columns) { 
		return array_merge( $columns, 
			array( 
				'wpape_gallery_images' 	=> __('Images', 	'gallery-images-ape') ,
				'wpape_gallery' 		=> __('Shortcode', 	'gallery-images-ape'), 
				'wpape_gallery_code' 	=> __('PHP Code', 	'gallery-images-ape'), 
			) 
		); 
	}

	function infoBox(){
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-ui-dialog' );

		

		if(!WPAPE_GALLERY_PREMIUM){
			wp_register_script('wpape-gallery-info', 		WPAPE_GALLERY_URL.'assets/js/admin/gallery-info.js', array( 'jquery', 'jquery-ui-dialog' ), WPAPE_GALLERY_VERSION, true ); 
			wp_localize_script( 'wpape-gallery-info', 'ape_gallery_js_text', array(
				'title' 	=> __('Gallery Ape', 'gallery-images-ape').' :: '.WPAPE_GALLERY_BUTTON_PREMIUM,
				'close' 	=> __('Continue with free version'),
				'info' 		=> __('Get').' '.WPAPE_GALLERY_BUTTON_PREMIUM,
				'open' 		=> get_option( 'gallery-images-ape-dialog' , 0) ? 1 : 0 ,
			));
			wp_enqueue_script( 'wpape-gallery-info' ); 
			delete_option( 'gallery-images-ape-dialog' );
		}

		echo '<div id="wpape_showInformation" style="display: none;">'
				.__('Only 3 galleries in FREE version.', 'wpape_gallery')
				.'<br />'
				.__("We're really appreciate if You update your gallery to Premium version. It's gonna help us to create more wonderful functions :-)", 'wpape_gallery')
			.'</div>';
	}

	function wizard(){
		wp_enqueue_style( 'wp-jquery-ui-dialog');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('wpape-gallery-wizard', WPAPE_GALLERY_URL.'assets/js/admin/wizard.js', array( 'jquery', 'jquery-ui-dialog' ), WPAPE_GALLERY_VERSION, true ); 
		echo '<div id="wpape_showWizard" style="display: none;" '
					.'data-open="1" '
					.'data-title="'.__('Gallery Ape', 'gallery-images-ape').' :: '.__('New functionality', 'gallery-images-ape').'" '
					.'data-close="'.__('Close', 'gallery-images-ape').'" '
					.'data-info="'.__('Options', 'gallery-images-ape').'" '
				.'>'
				.'<h4>'
				.__('New possibility to speed up  WordPress gallery. You can find this option in gallery settings.', 'gallery-images-ape')
				.'</h4>'

				.'<p style="text-align:center; ">'
				.'<img src="'.WPAPE_GALLERY_URL.'assets/static-gallery.png" alt="option: Replace default gallery shortcode" style="width: 550px;" />'
				.'</p>'
			.'</div>';
	}
}

$wpApeGalleryListingClass = new wpApeGalleryListingClass();

/*if(isset($_GET['test'])){
	delete_option( WPAPE_GALLERY_NAMESPACE.'hideWizard' );
}*/
