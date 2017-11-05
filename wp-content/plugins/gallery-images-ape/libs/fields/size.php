<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function jt_cmb2_render_size_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	$value = wp_parse_args( $value, array(
		'height'	=> 140,
		'width' 	=> 240,
	) );
?>
<div class="form-horizontal">
	
	<div class="form-group wpape_size_width"  style="display: none;"> 
		<?php if($field->args('name')){ ?>
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2  control-label" for="<?php echo $field_type_object->_id( '_width' ); ?>'">
		    	<?php echo esc_html(  $field->args('name') ); ?>
		    </label>
	    <?php } ?>
	    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 <?php if(!$field->args('name')){ echo " col-sm-offset-2";} ?>">
			<div class="input-group">
				<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Res. Width'); ?></span>
				<?php echo $field_type_object->input( array(
					'name'  => $field_type_object->_name( '[width]' ),
					'id'    => $field_type_object->_id( '_width' ),
					'value' => (int) $value['width'],
					'data-slider-value' => (int) $value['width'],
					'type'  => 'text',
					'class' => 'form-control',
				) ); ?>
			<span class="input-group-addon">px</span>
			</div>
		</div>
		<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
			<div class="input-group">
				<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Res. Height'); ?></span>
				<?php echo $field_type_object->input( array(
					'name'  => $field_type_object->_name( '[height]' ),
					'id'    => $field_type_object->_id( '_height' ),
					'value' => (int) $value['height'],
					'data-slider-value' => (int) $value['height'],
					'type'  => 'text',
					'class' => 'form-control',
				) ); ?>
				<span class="input-group-addon">px</span>
			</div>
		</div>
  	</div>
</div>
<?php echo $field_type_object->_desc( true );
}
add_filter( 'cmb2_render_size', 'jt_cmb2_render_size_field_callback', 10, 5 );
