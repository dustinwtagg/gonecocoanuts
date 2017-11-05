<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$polaroid_metabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'polaroid_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t( 'Polaroid', 'gallery-images-ape' ),
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'show_names' 	=> false,
    'context' 		=> 'normal',
));

$polaroid_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Polaroid', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'polaroidOn',
	'type' 			=> 'switch',
	'default'		=> wpApeGalleryHelperClass::defaultValue(0),
	'depends' 		=> '.wpape_polaroid_block',
    'before_row' 	=> '
<div class="apeGalleryDiv"><br/>',
	'after_row'		=> '
	<div class="wpape_polaroid_block">',
));
    
$polaroid_metabox->add_field(array(
	'name'             => wpApeGalleryHelperClass::_t('Source', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'polaroidSource',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'desc',
	'options'          => array(
		'title'		=> wpApeGalleryHelperClass::_t( 'Title' , 'gallery-images-ape' ),
		'desc'		=> wpApeGalleryHelperClass::_t( 'Description' , 'gallery-images-ape' ),
		'caption'	=> wpApeGalleryHelperClass::_t( 'Caption' , 'gallery-images-ape' )
	),
));

$polaroid_metabox->add_field( array(
    'name'    		=> wpApeGalleryHelperClass::_t( 'Color', 'gallery-images-ape' ),
    'id'   			=> WPAPE_GALLERY_NAMESPACE.'polaroidBackground',
    'type' 			=> 'wpapetext',
    'class'			=> 'form-control wpape_color',
    'data-default' 	=>  '#ffffff',
	'data-alpha'    => 'true',
    'small'			=> 1,
    'default'  		=> '#ffffff',
));

$polaroid_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t('Alignment', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'polaroidAlign',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'center',
	'options'          => array(
		'left' 		=> wpApeGalleryHelperClass::_t( 'Left' , 	'gallery-images-ape' ),
		'right' 	=> wpApeGalleryHelperClass::_t( 'Right' , 	'gallery-images-ape' ),
		'center' 	=> wpApeGalleryHelperClass::_t( 'Center' , 	'gallery-images-ape' ),
	),
    'after_row'		=> '
    </div>
</div>'
));


	