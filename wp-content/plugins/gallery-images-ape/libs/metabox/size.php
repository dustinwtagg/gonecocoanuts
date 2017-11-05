<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$size_metabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'size_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t('Size' , 'gallery-images-ape' ),
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'cmb_styles' 	=> false,
    'show_names'	=> false,
    'context' 		=> 'normal',
    'priority' 		=> 'high',
));

$size_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Width', 'gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'width-size',
	'type' 			=> 'multisize',
	'default'		=> array( 'width'=> 100, 'widthType'=>''),
	'before_row' 	=> ' <br />
<div class="apeGalleryDiv">',
));

$size_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Spacing', 'gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'paddingCustom',
	'type' 			=> 'padding',
	'default'		=> array( 'left'=> 0, 'top'=> 0, 'right'=> 0, 'bottom'=> 0),
));

$size_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Columns', 'gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'colums',
	'type' 			=> 'colums',
	'default'		=> wpApeGalleryHelperClass::defaultValue(1),
	'before_row' 	=> '<br />
		<div class="alert alert-info col-md-10 col-md-offset-1 " role="alert">Gallery layout configuration</div>
',
    'after_row' => '	
</div>',
));

