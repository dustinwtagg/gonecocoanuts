<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function ape_radiobutton_getOptions( $options, $name, $value = false ) {
	if( !isset($options) || !count($options) )  return '';
    $state_options = '';
    foreach ( $options as $abrev => $state ) {
        $state_options .= 
        '<label class="btn btn-success '.($value==$abrev?'active':'').'">'
	 		.'<input type="radio" autocomplete="off" name="'.$name.'" '
		 			.($abrev==$value?' checked ':'').' '
		 			.' value="'.$abrev.'"'
	 			.'> '.$state
		.'</label>';
    }
    return $state_options;
}

function ape_radiobutton_field( $metakey, $post_id = 0 ) {
	echo get_ape_radiobutton_field( $metakey, $post_id );
}

function ape_radiobutton_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	$value =  $value?$value:$field->args('default');

if($field->args('level')) echo '<div class="ape_premium wpape-block-premium"> <p>'.WPAPE_GALLERY_BUTTON_PREMIUM.'</p></div>';
?>
<div class="form-horizontal">
	<div class="<?php echo $field_type_object->_id( 'optionsBlok' );?>">
		<div class="form-group">
		    <label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id( ); ?>'"><?php echo esc_html($field->args('name') ); ?></label>
		    <div class="col-sm-10">
		    	<div class="btn-group " data-toggle="buttons">
				<?php
					echo ape_radiobutton_getOptions( $field->args('options'),  $field_type_object->_name(),  $value );
				 ?>
				</div>
		    </div>
		</div>
	 </div>
</div>
<?php
}
add_filter( 'cmb2_render_ape_radiobutton', 'ape_radiobutton_field_callback', 10, 5 );