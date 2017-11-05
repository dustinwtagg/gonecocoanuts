<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function wpApe_field_social_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	$value = wp_parse_args( $value, array(
		 'twitter' =>  0, 
		 'facebook' => 0,
		 'googleplus' => 0,
	) );

	$onText='Show';
	$offText='Hide';

?>
<div class="form-horizontal">
	<div class="form-group">
	    <label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id(); ?>'">
	    	<?php echo $field->args('name'); ?>
	    </label>
	    <div class="col-sm-10 ">
	    	<div class="col-sm-3">
	    		Twitter
		    	<?php
					echo 
						'<input type="checkbox" data-toggle="toggle" data-onstyle="success" ' 
						.($onText?' data-on="'.wpApeGalleryHelperClass::_t( 'Show').'" ':'')
						.($offText?' data-off="'.wpApeGalleryHelperClass::_t( 'Hide').'" ':'')
						.'name="'.$field_type_object->_name( '[twitter]' ).'" '
						.'id="'. $field_type_object->_id( '_twitter' ).'" '
						.( isset($value['twitter']) && $value['twitter']==1 ?' checked ':'')
						.'value="1" '
						.'>';
				?>
			</div>
			<div class="col-sm-4">
				Facebook
		    	<?php
					echo 
						'<input type="checkbox" data-toggle="toggle" data-onstyle="success" ' 
						.($onText?' data-on="'.$onText.'" ':'')
						.($offText?' data-off="'.$offText.'" ':'')
						.'name="'.$field_type_object->_name( '[facebook]' ).'" '
						.'id="'. $field_type_object->_id( '_facebook' ).'" '
						.( isset($value['facebook']) && $value['facebook']==1 ?' checked ':'')
						.'value="1" '
						.'>';
				?>
			</div>
			<div class="col-sm-4">
				Google+
		    	<?php
					echo 
						'<input type="checkbox" data-toggle="toggle" data-onstyle="success" ' 
						.($onText?' data-on="'.$onText.'" ':'')
						.($offText?' data-off="'.$offText.'" ':'')
						.'name="'.$field_type_object->_name( '[googleplus]' ).'" '
						.'id="'. $field_type_object->_id( 'googleplus' ).'" '
						.( isset($value['googleplus']) && $value['googleplus']==1 ?' checked ':'')
						.'value="1" '
						.'>';
				?>
			</div>
			
		</div>
	</div>
</div>
	<?php
	echo $field_type_object->_desc( true );

}
add_filter( 'cmb2_render_social', 'wpApe_field_social_callback', 10, 5 );
