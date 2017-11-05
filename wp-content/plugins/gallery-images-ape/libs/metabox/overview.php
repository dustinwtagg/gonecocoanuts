<?php 
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$overviewMetabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'overview_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t('Interface Overview' , 'gallery-images-ape' ),
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'cmb_styles' 	=> false,
    'show_names'	=> false,
    'context' 		=> 'normal',
    'priority' 		=> 'high',
));

$overviewMetabox->add_field( array(
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'overview',
	'type' 			=> 'title',
	'before_row' 	=> ' <br />
<div class="apeGalleryDiv">
	<div class="row">
		<img class="col-xs-10 col-sm-10 col-md-8 col-lg-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-2  col-lg-offset-3" src="'.WPAPE_GALLERY_URL.'/assets/gallery_interface_overview.jpg">
	</div>
	<p><span class="label label-success">1</span> - 	'.wpApeGalleryHelperClass::_t("top gallery menu. It's contain embedded categories. Styles of this could be edited in menu section", 'gallery-images-ape').'</p>
	<p><span class="label label-success">2</span> - 	'.wpApeGalleryHelperClass::_t("gallery thumbnail. Thumbnails could take different amount of columns as result gallery have different layout", 'gallery-images-ape').'</p>
	<p><span class="label label-success">3</span> - 	'.wpApeGalleryHelperClass::_t("hover effect background. Color and transparency of the hover background could be fully customized", 'gallery-images-ape').'</p>
	<p><span class="label label-success">4</span> - 	'.wpApeGalleryHelperClass::_t("hover effect title. It's title of the image. Title could have different size, style, color", 'gallery-images-ape').'</p>
	<p><span class="label label-success">5</span> - 	'.wpApeGalleryHelperClass::_t("hover link button. Configurable hover and default background and border colors, icon, icon size", 'gallery-images-ape').'</p>
	<p><span class="label label-success">6</span> - 	'.wpApeGalleryHelperClass::_t("hover zoom button. Configurable hover and default background and border colors, icon, icon size", 'gallery-images-ape').'</p>
	<p><span class="label label-success">7</span> - 	'.wpApeGalleryHelperClass::_t("hover description text. It's description of the image. Description could have different size, style, color", 'gallery-images-ape').'</p>
	<p><span class="label label-success">8</span> - 	'.wpApeGalleryHelperClass::_t("another thumbnails which take only one column", 'gallery-images-ape').'</p>
	<p><span class="label label-success">9</span> - 	'.wpApeGalleryHelperClass::_t("every thumbnails have customizable border and shadow ", 'gallery-images-ape').'</p>
	<p><span class="label label-success">10</span> - 	'.wpApeGalleryHelperClass::_t("load more button. It's load more style pagination navigation button", 'gallery-images-ape').'</p>

	<p class="text-center">
		<button id="wpape_hide_overview" class=" button">'.wpApeGalleryHelperClass::_t("Hide Block", 'gallery-images-ape').'</button>
	</p>
</div>


<div style="dispay: none;">',
	'after_row' 	=> '</div>'
));