<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$view_metabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'view_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t('Thumbnails', 'gallery-images-ape' ),
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'cmb_styles' 	=> false,
    'show_names'	=> false,
    'context'		=> 'normal',
    'priority' 		=> 'high',
));

$view_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Order', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'orderby',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'categoryD',
	'level'			   => !WPAPE_GALLERY_PREMIUM,
	'options'          => array(
		'categoryD' => wpApeGalleryHelperClass::_t( 'Category &darr;', 'gallery-images-ape' ),
		'categoryU' => wpApeGalleryHelperClass::_t( 'Category &uarr;', 'gallery-images-ape' ),

		'titleD' => wpApeGalleryHelperClass::_t( 'Title &darr;', 'gallery-images-ape' ),
		'titleU' => wpApeGalleryHelperClass::_t( 'Title &uarr;', 'gallery-images-ape' ),

		'dateD' => wpApeGalleryHelperClass::_t( 'Date &darr;', 'gallery-images-ape' ),
		'dateU' => wpApeGalleryHelperClass::_t( 'Date &uarr;', 'gallery-images-ape' ),

		'random' => wpApeGalleryHelperClass::_t( 'Random', 'gallery-images-ape' ),
	),

	'before_row'	=> '<br />
<div class="apeGalleryDiv">',
	'after_row'		=> '',
));

$view_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Source', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'source',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'medium',
	'level'			   => !WPAPE_GALLERY_PREMIUM,
	'options'          => array(
		'thumbnail' => wpApeGalleryHelperClass::_t( 'Thumbnail', 'gallery-images-ape' ),
		'medium' 	=> wpApeGalleryHelperClass::_t( 'Medium', 'gallery-images-ape' ),
		'large' 	=> wpApeGalleryHelperClass::_t( 'Large', 'gallery-images-ape' ),
		'full' 		=> wpApeGalleryHelperClass::_t( 'Full', 'gallery-images-ape' ),
	),
	'before_row'	=> '',
	'after_row'		=> '',
));

$view_metabox->add_field( array(
	'name' 			=> 	wpApeGalleryHelperClass::_t('Ratio', 'gallery-images-ape' ),
	'id' 			=> 	WPAPE_GALLERY_NAMESPACE . 'sizeType',
	'type' 			=> 	'switch',
	'depends' 		=> 	'.wpape_size_width, .wpape_size_height',
	'default'		=> 	wpApeGalleryHelperClass::defaultValue(0),
));

$view_metabox->add_field( array(
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'thumb-size-options',
	'type' 			=> 'size',
	'level'			=> !WPAPE_GALLERY_PREMIUM,
));

$view_metabox->add_field( array(
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'thumb-options',
	'type' 			=> 'thumboption',
	'after_row'		=> '<hr> ',
));

$view_metabox->add_field( array(
    'name'    	=> wpApeGalleryHelperClass::_t('Alignment','gallery-images-ape'),
    'default' 	=> '',
    'options'	=> array( 
    		'' 		=> 'Disable', 
    		'left' 		=> 'Left', 
    		'center'	=> 'Center', 
    		'right'		=> 'Right',
    	),
    'id'	  	=> WPAPE_GALLERY_NAMESPACE .'align',
    'type'    	=> 'ape_radiobutton',
    'after_row'		=> '<hr> ',
));

$view_metabox->add_field( array(
	'id'               => WPAPE_GALLERY_NAMESPACE . 'shadow',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'depends' => array(
		'1'=> '.wpape_thumb_shadow',
		'2' => '.wpape_thumb_shadow, .wpape_thumb_shadow_hover',
	),
	'default'          => wpApeGalleryHelperClass::defaultValue(1),
	'options'          => array(
		'' => wpApeGalleryHelperClass::_t( 'Disabled Shadow' , 				'gallery-images-ape' ),
		'1'=> wpApeGalleryHelperClass::_t( 'Enabled Shadow' , 				'gallery-images-ape' ),
		'2'=> wpApeGalleryHelperClass::_t( 'Enabled Shadow + Hover' , 'gallery-images-ape' ),
	),
	'after_row'		=> '
	<div class=" wpape_thumb_shadow"  style="display: none;">',
));

$view_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Shadow', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'shadow-options',
	'type' 			=> 'shadow',
	'after_row'		=> ' 
		<div class=" wpape_thumb_shadow_hover"  style="display: none;">',
));

$view_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Hover Shadow', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'hover-shadow-options',
	'type' 			=> 'shadow',
	'default'		=> array(
			'color' => 'rgba(34, 25, 25, 0.4)', 
			'hshadow' 	=> '1',
			'vshadow' 	=> '3',
			'bshadow'	=> '3',
		),
	'after_row'		=>'
		</div>
	</div>
	<hr>'
));

$view_metabox->add_field( array(
	'id'               => WPAPE_GALLERY_NAMESPACE . 'thumbBorder',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'depends' => array(
		'1'=> '.wpape_thumb_border',
		'2' => '.wpape_thumb_border, .wpape_thumb_border_hover',
	),
	'default'          => wpApeGalleryHelperClass::defaultValue(1),
	'options'          => array(
		'' => wpApeGalleryHelperClass::_t( 'Disabled Border' , 				'gallery-images-ape' ),
		'1'=> wpApeGalleryHelperClass::_t( 'Enabled Border' , 				'gallery-images-ape' ),
		'2'=> wpApeGalleryHelperClass::_t( 'Enabled Border + Hover' , 'gallery-images-ape' ),
	),
));
     
$view_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Border', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'border-options',
	'type' 			=> 'border',
	'before_row' 	=> '
	<div class="wpape_thumb_border"  style="display: none;">',
	'after_row' => '
		<div class="wpape_thumb_border_hover"  style="display: none;">',
));

$view_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Hover Border', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'hover-border-options',
	'type' 			=> 'border',
	'after_row'		=>'
		</div>
	</div>
</div>'
));