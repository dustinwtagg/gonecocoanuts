<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$shortcode_metabox = new_cmb2_box( array(
    'id'            => WPAPE_GALLERY_NAMESPACE.'shortcode_metabox',
    'title'         => wpApeGalleryHelperClass::_t('Shortcode','gallery-images-ape'),
    'object_types'  => array( WPAPE_GALLERY_POST ),
    'context'       => 'side',
    'priority'      => 'low',
));

if(isset($_GET['post'])){
	$shortcode_metabox->add_field( array(
	    'id'            => WPAPE_GALLERY_NAMESPACE.'shortcode',
	    'type'          => 'title',
	    'before_row'    => '<div class="wpape_shortcode">[ape-gallery '.$_GET['post'].']</div>',
	    'after_row'     => '<div class="desc">'.wpApeGalleryHelperClass::_t('shortcode for post/page/widget','gallery-images-ape')."</div>",
	));
}