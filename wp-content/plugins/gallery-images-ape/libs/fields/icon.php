<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }


function cmb2_render_apeicon_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	$default = $field->args('default');
	if( empty($value) ) $value = $field->args('default');
?>
<div class="form-horizontal">
	<div class="form-group">	
		<label class="col-sm-2 col-xs-2 col-md-2 control-label" for="<?php echo $field_type_object->_id(); ?>'"><?php echo $field->args('name'); ?></label>
		<div class="col-sm-1">
			<button class="btn btn-default" role="iconpicker" data-icon="<?php echo $value;?>" data-inputid="<?php echo $field_type_object->_id();?>" data-search="false"></button>
		</div>
		<div class="col-sm-4 col-xs-4 col-md-4">
			 <?php echo $field_type_object->input( array(
						'name'  => $field_type_object->_name(),
						'id'    => $field_type_object->_id(),
						'value' => $value,
						'type'  => 'text',
						'class'	=> 'form-control col-sm-2'
					) ); 
				?>
		</div>
	</div>
	<?php if($field->args('info')){ ?>
		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-2">
				<p class="description"><?php echo $field->args('info'); ?></p>
			</div>
		</div>
	<?php } ?>
</div>
<?php
}
add_filter( 'cmb2_render_apeicon', 'cmb2_render_apeicon_field_callback', 10, 5 );