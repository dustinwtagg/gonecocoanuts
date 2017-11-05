<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function wpape_ape_select_get_options( $options, $value = false, $content=array() ) {
    $state_options = '';
    foreach ( $options as $abrev => $state ) {
        $state_options .= 
       	'<option value="'. $abrev .'" '
        	.(isset($content[$abrev])?' data-content="'.$state.' '.str_replace('"', "'", $content[$abrev]).'"':'')
        	.($value==$abrev?' selected="selected"':'') 
        .'>'. $state .'</option>';
    }
    return $state_options;
}

function jt_cmb2_render_ape_select_field_callback( $field, $value, $object_id, $object_type, $field_type_object ){
	$value =  $value?$value:$field->args('default');
	if( $field->args('level') ) echo '<div class="ape_premium wpape-block-premium"> <p>'.WPAPE_GALLERY_BUTTON_PREMIUM.'</p></div>';
?>
	<div class="form-horizontal">
		<div class="form-group">
	    	<label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id(); ?>"><?php echo esc_html( $field->args( 'name' ) ); ?></label>
		    <div class="col-sm-10">
		      <?php
		      	echo $field_type_object->select(array(
					'name'  		=> $field_type_object->_name(),
					'id'    		=> $field_type_object->_id(),
					'class'   		=> 'wpape_select form-control selectpicker'.($field->args('depends') && count($field->args('depends'))?' wpape_action_element_select':''),
					'options' 		=> wpape_ape_select_get_options( $field->args('options'),  $value, $field->args('content') ),
					'data-depends'	=> $field->args('depends') && count($field->args('depends')) ? 1 : 0 ,
					'desc'    		=> $field_type_object->_desc( true ),
				));

				if( $field->args('depends') && count($field->args('depends')) ){
				?>
				<script type="text/javascript">
					var  <?php echo $field_type_object->_id(); ?>_depends = <?php echo json_encode($field->args('depends')); ?>;
				</script>
				<?php } ?>
		    </div>
	  	</div>
	</div>
<?php
}
add_filter( 'cmb2_render_ape_select', 'jt_cmb2_render_ape_select_field_callback', 10, 5 );