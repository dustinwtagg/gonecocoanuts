<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }


$infowide_metabox = new_cmb2_box( array(
    'id'            => WPAPE_GALLERY_NAMESPACE.'infowide_metabox',
    'title'         => WPAPE_GALLERY_BUTTON_PREMIUM,
    'object_types'  => array( WPAPE_GALLERY_POST ),
    'context'       => 'normal',
));

$infowide_metabox->add_field( array(
    'id'            => WPAPE_GALLERY_NAMESPACE.'version_desc_block',
    'type'          => 'title',
    'before_row'    => '<div class="wpape_infoblock">'
    						.'<div class="wpape_version_desc wpape_getproversion_blank">'
    							.wpApeGalleryHelperClass::_t( 'more wonderful features, absolutely no restrictions for creativity' , 'gallery-images-ape' )
    						.'</div>'
    					.'</div>'
));