<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$menu_metabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'button_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t( 'Menu', 'gallery-images-ape' ),
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'show_names' 	=> false,
    'context' 		=> 'normal',
));

$menu_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Menu', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'menu',
	'type' 			=> 'switch',
	'level'			   => !WPAPE_GALLERY_PREMIUM,
	'default'		=> wpApeGalleryHelperClass::defaultValue(1),
	'showhide'		=> 1,
	'depends' 		=> 	'.wpape_menu_options',
	'before_row'	=> '
<div class="apeGalleryDiv"><br/>',
	'after_row'		=> '
	<div class="wpape_menu_options">',
));

$menu_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Output mode', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'menuSelfImages',
	'default'		=> wpApeGalleryHelperClass::defaultValue(1),
	'type' 			=> 'ape_select',
	'options'          => array(
		'0' => wpApeGalleryHelperClass::_t( 'subcategory' , 	'gallery-images-ape' ),
		'1'	=> wpApeGalleryHelperClass::_t( 'images + subcategory' , 	'gallery-images-ape' ),
	),
	'offText'		=> 'subcategory',
	'desc'			=> 'when you enable this output mode gallery do not show images from current category',
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Home button', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'menuHome',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'depends' => array(
		'icon' => '.ape_menu_home_icon',
		'label' => '.ape_menu_home_label',
		'iconlabel' => '.ape_menu_home_label, .ape_menu_home_icon',
	),
	'default'          => 'iconlabel',
	'options'          => array(
		'hide' 		=> wpApeGalleryHelperClass::_t( 'Hide' , 			'gallery-images-ape' ),
		'label'	=> wpApeGalleryHelperClass::_t( 'Label' , 			'gallery-images-ape' ),
		'icon' 	=> wpApeGalleryHelperClass::_t( 'Icon' , 			'gallery-images-ape' ),
		'iconlabel' 	=> wpApeGalleryHelperClass::_t( 'Icon and Label' , 	'gallery-images-ape' ),
	),
	'after_row'		=> '
		<div class="ape_menu_home_icon">',
	'before_row'		=> '
		<div class="alert alert-info" role="alert">
  			'.wpApeGalleryHelperClass::_t('Home menu button settings', 'gallery-images-ape' )
  		.'</div>',
));

$menu_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('Home icon','gallery-images-ape'),
    'default' => wpApeGalleryHelperClass::defaultValue('fa-home'),
    'id'	  => WPAPE_GALLERY_NAMESPACE .'menuRootIcon',
    'type'    => 'apeicon',
   	'after_row'		=> ' 
   		</div>
   		<div class="ape_menu_home_label">',
));

$menu_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('Home label','gallery-images-ape'),
    'default' => wpApeGalleryHelperClass::defaultValue('Home'),
    'id'	  => WPAPE_GALLERY_NAMESPACE .'menuRootLabel',
    'type'    => 'wpapetext',
    'after_row'		=> '
		</div>',
));



$menu_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Current button', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'menuSelf',
	'default'		=> wpApeGalleryHelperClass::defaultValue(1),
	'type' 			=> 'switch',
	'depends' 		=> 	'.ape_menu_category_icon',
	'showhide'		=> 1,
	'before_row'		=> '
		<div class="alert alert-info" role="alert">
  			'.wpApeGalleryHelperClass::_t("Category icon, for current gallery in top menu. Icon it's alternative for label on button.", 'gallery-images-ape' )
  		.'</div>',
	'after_row'			=> '
		<div class="ape_menu_category_icon">',
));

$menu_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('Category icon','gallery-images-ape'),
    'default' => '',
    'id'	  => WPAPE_GALLERY_NAMESPACE .'menuLabel',
    'type'    => 'apeicon',
   	'info'		=> wpApeGalleryHelperClass::_t("here you can define icon for top categories menu. This icon replace title on button. <br/>If this icon do not defined then you'll have just gallery title on button", 'gallery-images-ape'),
));

$menu_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('Category Label','gallery-images-ape'),
    'default' => '',
    'id'	  => WPAPE_GALLERY_NAMESPACE .'menuLabelText',
    'type'    => 'wpapetext',
   	'info'		=> wpApeGalleryHelperClass::_t("here you can define custom label for top categories menu. This label replace gallery title on button.<br />If this label do not defined then you'll have just gallery title on button by default", 'gallery-images-ape'),
   	 'after_row'		=> '
		</div>',
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Style', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonFill',
	'type'             => 'ape_radiobutton',
	'show_option_none' => false,
	'level'			   => !WPAPE_GALLERY_PREMIUM,
	'default'          => 'flat',
	'options'          => array(
		'flat' 			=> wpApeGalleryHelperClass::_t( 'Flat' , 	'gallery-images-ape' ),
		'3d'			=> wpApeGalleryHelperClass::_t( '3D' , 		'gallery-images-ape' ),
		'border' 		=> wpApeGalleryHelperClass::_t( 'Border' , 	'gallery-images-ape' ),
		'borderless' 	=> wpApeGalleryHelperClass::_t( 'Borderless','gallery-images-ape' ),
	),
	'before_row'		=> '
		<div class="alert alert-info" role="alert">'.wpApeGalleryHelperClass::_t("Menu interface configuration options", 'gallery-images-ape' ).'</div>',
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Effect', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonEffect',
	'type'             => 'ape_radiobutton',
	'show_option_none' => false,
	'default'          => '',
	'options'          => array(
		 'glow' 	=> wpApeGalleryHelperClass::_t( 'Glow' , 	 'gallery-images-ape' ),
		 'raised' 	=> wpApeGalleryHelperClass::_t( 'Raised', 'gallery-images-ape' ),
		 ''			=> wpApeGalleryHelperClass::_t( 'Off' , 		 'gallery-images-ape' ),
	),
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Shadow', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonShadow',
	'type'             => 'ape_radiobutton',
	'show_option_none' => false,
	'default'          => '',
	'options'          => array(
			'' 					=> wpApeGalleryHelperClass::_t( 'Hide', 	'gallery-images-ape' ),
			'longshadow-right' 	=> wpApeGalleryHelperClass::_t( 'Right' ,'gallery-images-ape' ),
			'longshadow-left' 	=> wpApeGalleryHelperClass::_t( 'Left', 	'gallery-images-ape' ),
	),
	
));



$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Color', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonColor',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'level'			   => !WPAPE_GALLERY_PREMIUM,
	'default'          => 'blue',
	'options'          => array(
		'black' 	=> wpApeGalleryHelperClass::_t( 'Black' , 'gallery-images-ape' ),
		'dark' 		=> wpApeGalleryHelperClass::_t( 'Dark' , 'gallery-images-ape' ),
		'gray' 		=> wpApeGalleryHelperClass::_t( 'Gray' , 'gallery-images-ape' ),
		'blue' 		=> wpApeGalleryHelperClass::_t( 'Blue' , 'gallery-images-ape' ),
		'green' 	=> wpApeGalleryHelperClass::_t( 'Green' , 'gallery-images-ape' ),
		'orange' 	=> wpApeGalleryHelperClass::_t( 'Orange' , 'gallery-images-ape' ),
		'red' 		=> wpApeGalleryHelperClass::_t( 'Red' , 'gallery-images-ape' ),
	),
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Rounds', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonType',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'normal',
	'options'          => array(
		'normal' 	=> wpApeGalleryHelperClass::_t( 'Normal' , 	'gallery-images-ape' ),
		'rounded' 	=> wpApeGalleryHelperClass::_t( 'Rounded' , 	'gallery-images-ape' ),
		'pill' 		=> wpApeGalleryHelperClass::_t( 'Pill' , 	'gallery-images-ape' ),
		'circle' 	=> wpApeGalleryHelperClass::_t( 'Circle ' , 	'gallery-images-ape' ),
		'box' 		=> wpApeGalleryHelperClass::_t( 'Box ' , 	'gallery-images-ape' ),
		'square' 	=> wpApeGalleryHelperClass::_t( 'Square ' , 	'gallery-images-ape' ),
	),
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Size', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonSize',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'normal',
	'options'          => array(
		'giant' 	=> wpApeGalleryHelperClass::_t( 'Giant' , 	'gallery-images-ape' ),
		'jumbo' 	=> wpApeGalleryHelperClass::_t( 'Jumbo' , 	'gallery-images-ape' ),
		'large' 	=> wpApeGalleryHelperClass::_t( 'Large' , 	'gallery-images-ape' ),
		'normal' 	=> wpApeGalleryHelperClass::_t( 'Normal' , 	'gallery-images-ape' ),
		'small' 	=> wpApeGalleryHelperClass::_t( 'Small' , 	'gallery-images-ape' ),
		'tiny' 		=> wpApeGalleryHelperClass::_t( 'Tiny ' , 	'gallery-images-ape' ),
	),
));

$menu_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t( 'Align', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'buttonAlign',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'left',
	'options'          => array(
		'left' 	=> wpApeGalleryHelperClass::_t( 'Left' , 	'gallery-images-ape' ),
		'center'=> wpApeGalleryHelperClass::_t( 'Center' , 	'gallery-images-ape' ),
		'right' => wpApeGalleryHelperClass::_t( 'Right' , 	'gallery-images-ape' ),
	),
));

$menu_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Spacing', 'gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'paddingMenu',
	'type' 			=> 'space',
	'default'		=> array( 
			'left'=>  wpApeGalleryHelperClass::defaultValue(5),  
			'bottom'=>wpApeGalleryHelperClass::defaultValue(10)
	),
	'after_row'		=> '
    </div>
</div>'
));