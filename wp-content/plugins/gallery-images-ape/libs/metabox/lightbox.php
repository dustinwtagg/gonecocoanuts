<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$lightbox_metabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'lightbox_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t( 'Lightbox', 'gallery-images-ape' ),
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'show_names' 	=> false,
    'context' 		=> 'normal',
));



$lightbox_metabox->add_field( array(
    'name'    		=> wpApeGalleryHelperClass::_t( 'Text', 'gallery-images-ape' ),
    'id'   			=> WPAPE_GALLERY_NAMESPACE.'lightboxColor',
    'type' 			=> 'wpapetext',
    'class'			=> 'form-control wpape_color',
    'data-default' 	=>  '#F3F3F3',
	'data-alpha'    => 'true',
    'small'			=> 1,
    'default'  		=> '#F3F3F3',
    'before_row' 	=> '
<div class="apeGalleryDiv"><br/>',
));

$lightbox_metabox->add_field( array(
    'name'    		=> wpApeGalleryHelperClass::_t( 'Background', 'gallery-images-ape' ),
    'id'   			=> WPAPE_GALLERY_NAMESPACE.'lightboxBackground',
    'type' 			=> 'wpapetext',
    'class'			=> 'form-control wpape_color',
    'data-default' 	=>  'rgba(11, 11, 11, 0.8)',
	'data-alpha'    => 'true',
	'level'			=> !WPAPE_GALLERY_PREMIUM,
    'small'			=> 1,
    'default'  		=> 'rgba(11, 11, 11, 0.8)',
   
));

$lightbox_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Swipe', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'lightboxSwipe',
	'type' 			=> 'switch', 
	'default'		=> wpApeGalleryHelperClass::defaultValue(1),
	'level'			=> !WPAPE_GALLERY_PREMIUM,
));

$lightbox_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Social Button', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'social',
	'type' 			=> 'social', 
	'default'		=> array('twitter' => 0, 'facebook'=>0, 'googleplus'=>0),
));


$lightbox_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Arrows', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'arrows',
	'type' 			=> 'switch',
	'showhide'		=> 1,
	'invert'		=> 1,
	'onText'		=> wpApeGalleryHelperClass::_t('Hide', 'gallery-images-ape' ),
	'offText'		=> wpApeGalleryHelperClass::_t('Show', 'gallery-images-ape' ),

	'default'		=> wpApeGalleryHelperClass::defaultValue(1),

'after_row'		=> '
</div> '
));


	