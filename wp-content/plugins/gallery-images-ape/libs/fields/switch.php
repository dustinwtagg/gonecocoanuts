<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function jt_cmb2_switch_field( $metakey, $post_id = 0 ) {
	echo jt_cmb2_get_switch_field( $metakey, $post_id );
}

function jt_cmb2_render_switch_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	if( empty($value) ) $value = $field->args('default');

	$onText = $field->args('onText');
	$offText = $field->args('offText');

	if($field->args('showhide')){
		$onText='Show';
		$offText='Hide';
	}

	$onStyle = 'success';
	$offStyle= 'default';

	$invert = $field->args('invert');
	if($invert){
		$tempOnText = $onText;
		$onText = $offText;
		$offText = $tempOnText;

		$tempOnStyle = $onStyle;
		$onStyle = $offStyle.' active ';
		$offStyle = $tempOnStyle;
	}


if( $field->args('level') ) echo '<div class="ape_premium wpape-block-premium"> <p>'.WPAPE_GALLERY_BUTTON_PREMIUM.'</p></div>';
?>
<div class="form-horizontal">
	<div class="form-group">
	    <label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id(); ?>'">
	    	<?php echo $field->args('name'); ?>
	    </label>
	    <div class="col-sm-10">
	<?php 
			$class= '';
			if( $field->args('depends') ) $class .= ' wpape_action_element';
			
			 echo
				'<input type="checkbox" class="'.$class.'" data-toggle="toggle" '
				.'data-onstyle="'.$onStyle.'" '
				.'data-offstyle="'.$offStyle.'" '
				.($onText?' data-on="'.$onText.'" ':'')
				.($offText?' data-off="'.$offText.'" ':'')
				.' name="'.$field_type_object->_name(  ).'" '
				.' id="'. $field_type_object->_id( ).'" '
				.($field->args('depends')?'data-depends="'.$field->args('depends').'" ':'')
				.( $value==1 ?'checked="checked" ':'')
				.'value="1"> <span class="wpape_desc">'.$field->args('desc').'</span>';
			?> 
 		</div>
	</div>
	<?php if($field->args('info')){ ?>
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-2">
				<p class="description"><?php echo $field->args('info'); ?></p>
			</div>
		</div>
	<?php } ?>
</div>
<?php
}
add_filter( 'cmb2_render_switch', 'jt_cmb2_render_switch_field_callback', 10, 5 );