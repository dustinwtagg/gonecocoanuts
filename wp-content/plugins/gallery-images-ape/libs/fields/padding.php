<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function wpape_padding_field( $metakey, $post_id = 0 ) {
	echo get_wpape_padding_field( $metakey, $post_id );
}

function wpape_padding_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	$default = $field->args('default');
	if(!is_array($default))  $default = array();

	if(!isset($default['left'])) 		$default['left'] 	= 0;
	if(!isset($default['top'])) 		$default['top']		= 0;
	if(!isset($default['right'])) 		$default['right']	= 0;
	if(!isset($default['bottom'])) 		$default['bottom']	= 0;
	
	
	$value = wp_parse_args( $value, array( 
		 'left' 	=> $default['left'], 
		 'top' 		=> $default['top'],
		 'right' 	=> $default['right'],
		 'bottom' 	=> $default['bottom'],
	));
?>
<div class="form-horizontal">
	<div class="form-group">
	    <label class="col-xs-2 col-sm-2 control-label" for="<?php echo $field_type_object->_id(); ?>"><?php echo esc_html(  $field->args('name') ); ?></label>

	    <div class="col-xs-6 col-sm-4"> 
	    	<div class="input-group">
      			<div class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Left'); ?></div>
			    <?php 
			    echo $field_type_object->input( array(
					'name'  		=> $field_type_object->_name('[left]' ),
					'id'    		=> $field_type_object->_id('[left]' ),
					'value' 		=> $value['left'],
					'class' 		=> 'form-control '.$field->args('class') ,
				)); 
			   ?>
			   <div class="input-group-addon">px</div>
			</div>
		</div>

		<div class="col-xs-6 col-sm-4"> 
	    	<div class="input-group">
      			<div class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Top'); ?></div>
			    <?php 
			    echo $field_type_object->input( array(
					'name'  		=> $field_type_object->_name('[top]' ),
					'id'    		=> $field_type_object->_id('[top]' ),
					'value' 		=> $value['top'],
					'class' 		=> 'form-control '.$field->args('class') ,
				)); 
			   ?>
			   <div class="input-group-addon">px</div>
			</div>
		</div>

	</div>
	<div class="form-group">
		<div class="col-xs-2 col-sm-2 "></div>

		<div class="col-xs-6 col-sm-4"> 
	    	<div class="input-group">
      			<div class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Right'); ?></div>
			    <?php 
			    echo $field_type_object->input( array(
					'name'  		=> $field_type_object->_name('[right]' ),
					'id'    		=> $field_type_object->_id('[right]' ),
					'value' 		=> $value['right'],
					'class' 		=> 'form-control '.$field->args('class') ,
				)); 
			   ?>
			   <div class="input-group-addon">px</div>
			</div>
		</div>

		<div class="col-xs-6 col-sm-4"> 
	    	<div class="input-group">
      			<div class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Bottom'); ?></div>
			    <?php 
			    echo $field_type_object->input( array(
					'name'  		=> $field_type_object->_name('[bottom]' ),
					'id'    		=> $field_type_object->_id('[bottom]' ),
					'value' 		=> $value['bottom'],
					'class' 		=> 'form-control '.$field->args('class') ,
				)); 
			   ?>
			   <div class="input-group-addon">px</div>
			</div>
		</div>
	</div>
</div>
	<?php
	echo $field_type_object->_desc( true );

}
add_filter( 'cmb2_render_padding', 'wpape_padding_field_callback', 10, 5 );
