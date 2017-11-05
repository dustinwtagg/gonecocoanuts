<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

$interface_metabox = new_cmb2_box( array(
    'id' 			=> WPAPE_GALLERY_NAMESPACE . 'hover_metabox',
    'title' 		=> wpApeGalleryHelperClass::_t( 'Interface', 'gallery-images-ape' ), 
    'object_types' 	=> array( WPAPE_GALLERY_POST ),
    'show_names'	=> false,
    'context' 		=> 'normal',
));

$interface_metabox->add_field( array(
	'name' 			=> 	wpApeGalleryHelperClass::_t('Click event', 'gallery-images-ape' ),
	'id' 			=> 	WPAPE_GALLERY_NAMESPACE . 'thumbClick',
	'type' 			=> 	'switch',
	'default'		=> 	wpApeGalleryHelperClass::defaultValue(1),
	

	'before_row'	=> '
<div class="apeGalleryDiv"> <br />',
));

$interface_metabox->add_field( array(
	'name' 			=> 	wpApeGalleryHelperClass::_t('Hover mode', 'gallery-images-ape' ),
	'id' 			=> 	WPAPE_GALLERY_NAMESPACE . 'hover',
	'type' 			=> 	'switch',
	'default'		=> 	wpApeGalleryHelperClass::defaultValue(1),
	
	'depends' 		=> '.wpape_gallery_hover_options_blok', /* .wpape_gallery_hover_blok,  */
	'after_row'	=> '
	<div class="wpape_gallery_hover_options_blok">',
));

$interface_metabox->add_field( array(
    'name'    		=> wpApeGalleryHelperClass::_t( 'Fill', 'gallery-images-ape' ),
    'id'   			=> WPAPE_GALLERY_NAMESPACE.'background',
    'type' 			=> 'wpapetext',
    'class'			=> 'form-control wpape_color wpape_hover_bg_color',
    'data-default' 	=>  'rgba(7, 7, 7, 0.5)',
    'default'  		=> 'rgba(7, 7, 7, 0.5)',
	'data-alpha'    => 'true',
	'data-css-style'=> 'backgroundColor',
    'small'			=> 1,
    'level'			   => !WPAPE_GALLERY_PREMIUM,
));

$interface_metabox->add_field( array(
	'name'             => wpApeGalleryHelperClass::_t('Animation', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'overlayEffect',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'direction-aware-fade',
	'options'          => array(
		 'push-up' 				=> wpApeGalleryHelperClass::_t( 'push-up' ),
		 'push-down'	 		=> wpApeGalleryHelperClass::_t( 'push-down' ),
		 'push-up-100%' 		=> wpApeGalleryHelperClass::_t( 'push-up-100%' ),
		 'push-down-100%' 		=> wpApeGalleryHelperClass::_t( 'push-down-100%' ),
		 'reveal-top'			=> wpApeGalleryHelperClass::_t( 'reveal-top' ),
		 'reveal-bottom' 		=> wpApeGalleryHelperClass::_t( 'reveal-bottom' ),
		 'reveal-top-100%' 		=> wpApeGalleryHelperClass::_t( 'reveal-top-100%' ),
		 'reveal-bottom-100%' 	=> wpApeGalleryHelperClass::_t( 'reveal-bottom-100%' ),
		 'direction-aware' 		=> wpApeGalleryHelperClass::_t( 'direction-aware' ),
		 'direction-aware-fade' => wpApeGalleryHelperClass::_t( 'direction-aware-fade' ),
		 'direction-right' 		=> wpApeGalleryHelperClass::_t( 'direction-right' ),
		 'direction-left' 		=> wpApeGalleryHelperClass::_t( 'direction-left' ),
		 'direction-top' 		=> wpApeGalleryHelperClass::_t( 'direction-top' ),
		 'direction-bottom' 	=> wpApeGalleryHelperClass::_t( 'direction-bottom'),
		 'fade' 				=> wpApeGalleryHelperClass::_t( 'fade' )
	),
	'after_row'		=> '
	</div>
		'
));

$saveAccord = '';
if(isset($_GET['post']) && (int)$_GET['post']  ){ 
	$saveAccord  = get_post_meta( (int) $_GET['post'], WPAPE_GALLERY_NAMESPACE.'saveAccord', true );
}
   
$interface_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Title', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'showTitle',
	'type' 			=> 'font',
	'label_enable'	=> 'Title text',
    'default'		=> array(
    	'enabled'	=> wpApeGalleryHelperClass::defaultValue(1),
    	'color'		=> 'rgb(255, 255, 255)',
    	'colorHover'=> 'rgb(255, 255, 255)',
    	'fontBold'  => 'bold',
    	'fontSize'  => '12',
    ),
    'before_row'=> 	'
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		
			<div class="panel panel-default wpape_gallery_hover_options_blok">
			    <div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a class="collapsed headingLinkClear" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<span class="glyphicon glyphicon-text-width" aria-hidden="true"></span> '.wpApeGalleryHelperClass::_t('Image Title text styling', 'gallery-images-ape' ).'
						</a>
					</h4>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse '.($saveAccord=='collapseOne'?'in':'').'" role="tabpanel" aria-labelledby="headingOne">
			      	<div class="panel-body">
			       ',

	'after_row'		=> '

			      	</div>
			    </div>
			</div>'
));


$interface_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Show description', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'showDesc',
	'type' 			=> 'font',
	'label_enable'=> 'Description text',
	'level'			   => !WPAPE_GALLERY_PREMIUM,
    'default'		=> array(
    	'enabled'	=> wpApeGalleryHelperClass::defaultValue(0),
    	'color'		=> '#000000',
    	'colorHover'=> '#000000',
    	'fontSize'  => '24',
    ),
    'before_row'=> 	'
			<div class="panel panel-default wpape_gallery_hover_options_blok">
			    <div class="panel-heading" role="tab" id="headingFontPanel4">
			      	<h4 class="panel-title">
			        	<a class="collapsed headingLinkClear" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFontPanel4" aria-expanded="false" aria-controls="collapseFontPanel4">
			         		<span class="glyphicon glyphicon-text-width" aria-hidden="true"></span> '.wpApeGalleryHelperClass::_t('Image Description text styling', 'gallery-images-ape' ).'
			        	</a>
			      	</h4>
			    </div>
			    <div id="collapseFontPanel4" class="panel-collapse collapse '.($saveAccord=='collapseFontPanel4'?'in':'').'" role="tabpanel" aria-labelledby="headingFontPanel4">
			      	<div class="panel-body">
				       ',
	'after_row'		=> '
				    </div>
				</div>
			</div>'

));

$interface_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Link icon', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'linkIcon',
	'type' 			=> 'font',
	'label_enable'=> 'Link button',
    'default'		=> array(
    	'enabled'	=> wpApeGalleryHelperClass::defaultValue(0),
    	'iconSelect'=> 'fa-link',
    	'color'		=> '#ffffff',
    	'colorHover'=> '#ffffff',
    	'colorBg'	=> 'rgba(0, 0, 0, 0)',
    	'colorBgHover'	=> 'rgba(0, 0, 0, 0)',  //'rgb(0, 161, 203)',
    	'fontSize'  => '22'
    ),
    'icon'			=> 1,
    'before_row'	=> '
			<div class="panel panel-default wpape_gallery_hover_options_blok">
			    <div class="panel-heading" role="tab" id="headingTwo">
			    	<h4 class="panel-title">
				        <a class="collapsed headingLinkClear" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          <span class="glyphicon glyphicon-check" aria-hidden="true"></span> '.wpApeGalleryHelperClass::_t('Hover Link button styling', 'gallery-images-ape' ).'
				        </a>
			      	</h4>
			    </div>
			    <div id="collapseTwo" class="panel-collapse collapse '.($saveAccord=='collapseTwo'?'in':'').'" role="tabpanel" aria-labelledby="headingTwo">
			    	<div class="panel-body">
   ', 
'after_row'		=> '
			    	</div>
			    </div>
			</div>'
));

$interface_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Zoom icon', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'zoomIcon',
	'type' 			=> 'font',
	'label_enable'	=> 'Zoom button',
    'default'		=> array(
    	'enabled'	=> wpApeGalleryHelperClass::defaultValue(1),
    	'iconSelect'=> 'fa-plus',
    	'color'		=> '#ffffff',
    	'colorHover'=> '#ffffff',
    	'colorBg'	=> 'rgba(0, 0, 0, 0)',
    	'colorBgHover'	=> 'rgba(0, 0, 0, 0)', //rgb(0, 161, 203)
    	'borderSize'	=> '0',
    	'fontSize'  => '22',
    ),
    'icon'			=> 1,
    'before_row'	=> '
			<div class="panel panel-default wpape_gallery_hover_options_blok">
			    <div class="panel-heading" role="tab" id="headingThree">
			      	<h4 class="panel-title">
			        	<a class="collapsed headingLinkClear" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			         		<span class="glyphicon glyphicon-check" aria-hidden="true"></span> '.wpApeGalleryHelperClass::_t('Hover Zoom buttons styling', 'gallery-images-ape' ).'
			        	</a>
			      	</h4>
			    </div>
			 	<div id="collapseThree" class="panel-collapse collapse '.($saveAccord=='collapseThree'?'in':'').'" role="tabpanel" aria-labelledby="headingThree">
			      	<div class="panel-body">
			        	',
'after_row'		=> '
			      	</div>
			    </div>
			</div>
		
',
));

$interface_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Polaroid', 'gallery-images-ape' ),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'polaroidOn',
	'type' 			=> 'switch',
	'default'		=> wpApeGalleryHelperClass::defaultValue(0),
	'depends' 		=> '.wpape_polaroid_block',
    'before_row' 	=> '
		<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingFive">
		    	<h4 class="panel-title">
			        <a class="collapsed headingLinkClear" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
			          <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> '.wpApeGalleryHelperClass::_t('Polaroid style', 'gallery-images-ape' ).'
			        </a>
		      	</h4>
		    </div>
		    <div id="collapseFive" class="panel-collapse collapse '.($saveAccord=='collapseFive'?'in':'').'" role="tabpanel" aria-labelledby="headingFive">
		    	<div class="panel-body">
       ', 
	'after_row'		=> '
					<div class="wpape_polaroid_block">',
));
    
$interface_metabox->add_field(array(
	'name'             => wpApeGalleryHelperClass::_t('Text', 'gallery-images-ape' ),
	'id'               => WPAPE_GALLERY_NAMESPACE . 'polaroidSource',
	'type'             => 'ape_select',
	'show_option_none' => false,
	'default'          => 'desc',
	'options'          => array(
		'title'		=> wpApeGalleryHelperClass::_t( 'from title ' , 'gallery-images-ape' ),
		'desc'		=> wpApeGalleryHelperClass::_t( 'from description' , 'gallery-images-ape' ),
		'caption'	=> wpApeGalleryHelperClass::_t( 'from caption' , 'gallery-images-ape' )
	),
));

$interface_metabox->add_field( array(
    'name'    		=> wpApeGalleryHelperClass::_t( 'Color', 'gallery-images-ape' ),
    'id'   			=> WPAPE_GALLERY_NAMESPACE.'polaroidBackground',
    'type' 			=> 'wpapetext',
    'class'			=> 'form-control wpape_color',
    'data-default' 	=>  '#ffffff',
	'data-alpha'    => 'true',
    'small'			=> 1,
    'default'  		=> '#ffffff',
));

$interface_metabox->add_field( array(
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
				</div>
			</div>	
		</div>
'
));

$interface_metabox->add_field(array(
	'name' 			=> wpApeGalleryHelperClass::_t('Pre-load','gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'lazyLoad',
	'type' 			=> 'switch',
	'default'		=> wpApeGalleryHelperClass::defaultValue(1),
	'before_row' 	=> '
		<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingSix">
		    	<h4 class="panel-title">
			        <a class="collapsed headingLinkClear" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
			          <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> '.wpApeGalleryHelperClass::_t('Pagination options', 'gallery-images-ape' ).'
			        </a>
		      	</h4>
		    </div>
		    <div id="collapseSix" class="panel-collapse collapse '.($saveAccord=='collapseSix'?'in':'').'" role="tabpanel" aria-labelledby="headingFive">
		    	<div class="panel-body">
       ', 
));

$interface_metabox->add_field( array(
	'name' 			=> wpApeGalleryHelperClass::_t('Start Images','gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'boxesToLoadStart',
	'type' 			=> 'wpapetext',
	'default'		=> 12,
	'small'			=> 'xs',
));
$interface_metabox->add_field(array(
	'name' 			=> wpApeGalleryHelperClass::_t('Load step','gallery-images-ape'),
	'id' 			=> WPAPE_GALLERY_NAMESPACE . 'boxesToLoad',
	'type' 			=> 'wpapetext',
	'default'		=> 8,
	'small'			=> 'xs',
));


$interface_metabox->add_field( array(
    'name'    		=> wpApeGalleryHelperClass::_t('Color','wpape_gallery'),
    'id'	  		=> WPAPE_GALLERY_PREFIX .'loadingBgColor',
    'type'    		=> 'wpapetext', 
    'small'			=> 1,
	'default'  		=> '#ffffff',
	'data-default' 	=> '#ffffff',
    'class'			=> 'form-control wpape_color wpape_hover_bg_color',
   // 'desc'			=> 'fff',
    'info'		=> wpApeGalleryHelperClass::_t("this is background color for the image. You'll see images filled by this color during images pre-load", 'gallery-images-ape'),
    'after_row'		=>' '
));


$interface_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('Load','gallery-images-ape'),
    'default' => 'Gallery images loading',
    'id'	  => WPAPE_GALLERY_NAMESPACE .'LoadingWord',
    'type'    => 'wpapetext',
    'before_row' => '
		<div class="alert alert-info" role="alert">
  			'.wpApeGalleryHelperClass::_t("Customize gallery load labels below", 'gallery-images-ape' )
  		.'</div>',
));

$interface_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('Load more','gallery-images-ape'),
    'default' => 'More images',
    'id'	  => WPAPE_GALLERY_NAMESPACE .'loadMoreWord',
    'type'    => 'wpapetext'
));

$interface_metabox->add_field( array(
    'name'    => wpApeGalleryHelperClass::_t('No images','gallery-images-ape'),
    'default' => 'No images',
    'id'	  => WPAPE_GALLERY_NAMESPACE .'noMoreEntriesWord',
    'type'    => 'wpapetext',
    'after_row'		=>'
				</div>
			</div>
		</div>
	</div>
</div>'
));


$interface_metabox->add_field( array(
    'default' => '',
    'id'	  => WPAPE_GALLERY_NAMESPACE .'saveAccord',
    'type'    => 'hidden',
));