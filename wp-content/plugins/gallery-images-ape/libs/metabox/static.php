<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$gallery_static_metabox = new_cmb2_box( array(
    'id'            => WPAPE_GALLERY_NAMESPACE . 'static_metabox',
    'title'         => __( 'Static Content', 'gallery-images-ape' ),
    'object_types'  => array( WPAPE_GALLERY_POST ),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'	=> false,
));

$gallery_static_metabox->add_field( array(
	'name' 			=> 	__('Static Gallery', 'gallery-images-ape' ),
	'id' 			=> 	WPAPE_GALLERY_NAMESPACE . 'static',
	'type' 			=> 	'switch',
	'default'		=> 	wpApeGalleryHelperClass::defaultValue(0),
	'info'			=> 	__('Static gallery help you to make your gallery load faster and speed up page with gallery in general. When this option enabled your page will have better load time and saved resources of the server.', 'gallery-images-ape'),
	'before_row'	=> '
<div class="apeGalleryDiv"> <br />',
	'after_row'		=> '
</div>
	'
));