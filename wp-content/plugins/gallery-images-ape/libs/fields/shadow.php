<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function jt_cmb2_shadow_field( $metakey, $post_id = 0 ) {
	echo jt_cmb2_get_shadow_field( $metakey, $post_id );
}

function jt_cmb2_render_shadow_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	$value = wp_parse_args( $value, array(
		'color' 	=> 'rgba(34, 25, 25, 0.4)',
		'hshadow' 	=> '0',
		'vshadow' 	=> '5',
		'bshadow'	=> '7',
	) );
?>
<div class="form-horizontal">
	
	<div class="form-group" >
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2  control-label" for="<?php echo $field_type_object->_id( '_hshadow' ); ?>'">
	    	<?php echo $field->args('name'); ?>
	    </label>

		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			<div class="input-group">
				<span class="input-group-addon">X <?php wpApeGalleryHelperClass::_te('Shadow'); ?></span>
			    <?php echo $field_type_object->input( array(
							'name'  => $field_type_object->_name( '[hshadow]' ),
							'id'    => $field_type_object->_id( '_hshadow' ),
							'value' => (int) $value['hshadow'],
							'type'  => 'text',
							'class' => 'form-control',
						) ); 
				?>
				<span class="input-group-addon">px</span>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			<div class="input-group">
				<span class="input-group-addon">Y <?php wpApeGalleryHelperClass::_te('Shadow'); ?></span>
				<?php echo $field_type_object->input( array(
					'name'  => $field_type_object->_name( '[vshadow]' ),
					'id'    => $field_type_object->_id( '_vshadow' ),
					'value' => (int) $value['vshadow'],
					'type'  => 'text',
					'class' => 'form-control',
					) ); 
				?>
				<span class="input-group-addon">px</span>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			<div class="input-group">
				<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Blur'); ?></span>
				<?php echo $field_type_object->input( array(
						'name'  => $field_type_object->_name( '[bshadow]' ),
						'id'    => $field_type_object->_id( '_bshadow' ),
						'value' => (int) $value['bshadow'],
						'type'  => 'text',
						'class' => 'form-control',

					) ); 
			?>
			<span class="input-group-addon">px</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="input-group">
				<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Color'); ?></span>
				<?php 
					echo  $field_type_object->input( array(
						'name'  		=> $field_type_object->_name( '[color]' ),
						'id'    		=> $field_type_object->_id( '_color' ),
						'class'         => 'form-control wpape_color',
						'data-default' 	=>  $value['color'] ,
						'data-alpha'    => 'true',
						'value' 		=>  $value['color'], 
					)); 
				?> 
			</div>
		</div>
	</div>

</div>
<?php
}
add_filter( 'cmb2_render_shadow', 'jt_cmb2_render_shadow_field_callback', 10, 5 );