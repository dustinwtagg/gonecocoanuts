<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function _cmb2_render_thumboption_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	$value = wp_parse_args( $value, array(
		'radius' 	=> wpApeGalleryHelperClass::defaultValue('5'),
		'xspace' 	=> wpApeGalleryHelperClass::defaultValue('15'),
		'yspace'	=> wpApeGalleryHelperClass::defaultValue('15'),
	) );
?>
<div class="form-horizontal">
	
	<div class="form-group">
	<?php if($field->args('name')){ ?>
	   <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2  control-label" for="<?php echo $field_type_object->_id( '_radius' ); ?>'">
	    	<?php echo $field->args('name'); ?>
	    </label>
	<?php } ?>
		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 col-sm-offset-2">
			<div class="input-group">
				<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Radius'); ?></span>
			    <?php echo $field_type_object->input( array(
							'name'  => $field_type_object->_name( '[radius]' ),
							'id'    => $field_type_object->_id( '_radius' ),
							'value' => (int) $value['radius'],
							'type'  => 'text',
							'class' => 'form-control',
						) ); 
				?>
				<span class="input-group-addon">px</span>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			<div class="input-group">
				<span class="input-group-addon">X <?php wpApeGalleryHelperClass::_te('space'); ?></span>
				<?php echo $field_type_object->input( array(
					'name'  => $field_type_object->_name( '[xspace]' ),
					'id'    => $field_type_object->_id( '_xspace' ),
					'value' => (int) $value['xspace'],
					'type'  => 'text',
					'class' => 'form-control',
					) ); 
				?>
				<span class="input-group-addon">px</span>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			<div class="input-group">
				<span class="input-group-addon">Y <?php wpApeGalleryHelperClass::_te('space'); ?></span>
				<?php echo $field_type_object->input( array(
						'name'  => $field_type_object->_name( '[yspace]' ),
						'id'    => $field_type_object->_id( '_yspace' ),
						'value' => (int) $value['yspace'],
						'type'  => 'text',
						'class' => 'form-control',

					) ); 
			?>
			<span class="input-group-addon">px</span>
			</div>
		</div>
	</div>
</div>
<?php
}
add_filter( 'cmb2_render_thumboption', '_cmb2_render_thumboption_field_callback', 10, 5 );