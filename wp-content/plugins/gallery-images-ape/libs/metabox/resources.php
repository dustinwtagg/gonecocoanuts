<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$gallery_images_metabox = new_cmb2_box( array(
    'id'            => WPAPE_GALLERY_NAMESPACE . 'images_metabox',
    'title'         => wpApeGalleryHelperClass::_t( 'Gallery Resources', 'gallery-images-ape' ),
    'object_types'  => array( WPAPE_GALLERY_POST ),
    'context'       => 'side',
    'priority'      => 'high',
    'show_names'	=> false,
));

$gallery_images_metabox->add_field(array(
    'name' => wpApeGalleryHelperClass::_t( 'Manage Images', 'gallery-images-ape' ),
    'id'   => WPAPE_GALLERY_NAMESPACE . 'galleryImages', 
    'type' => 'wpape_gallery_manage',
    'sanitization_cb' => 'wpape_gallery_manage_field_sanitise'
));