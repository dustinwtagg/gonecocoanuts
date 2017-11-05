<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

if(!function_exists('wpape_border_get_state_options')){
	function wpape_border_get_state_options( $value = false ) {
	    $state_list = array( 
	    	'none'=>'none',
	    	'dotted'=>'dotted',
	    	'dashed'=>'dashed',
	    	'solid'=>'solid',
	    	'double'=>'double',
	    	'groove'=>'groove',
	    	'ridge'=>'ridge',
	    	'inset'=>'inset',
	    	'outset'=>'outset',
	    	'hidden'=>'hidden'
	    );

	    $state_options = '';
	    foreach ( $state_list as $abrev => $state ) {
	        $state_options .= '<option value="'. $abrev .'" '. selected( $value, $abrev, false ) .'>'. $state .'</option>';
	    }

	    return $state_options;
	}
}

if(!function_exists('jt_cmb2_border_field')){
	function jt_cmb2_border_field( $metakey, $post_id = 0 ) {
		echo jt_cmb2_get_border_field( $metakey, $post_id );
	}
}

function wpape_border_render_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	$value = wp_parse_args( $value, array(
		'color' => 'rgb(27, 154, 247)',
		'style' => 'solid',
		'width' => '3'
	) );

	?>
<div class="form-horizontal">

	<div class="form-group" >
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" for="<?php echo $field_type_object->_id( '_width' ); ?>'">
	    	<?php echo $field->args('name'); ?>
	    </label>
	    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    <div class="input-group">
      			<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Width'); ?></span>
			    <?php echo $field_type_object->input( array(
								'name'  => $field_type_object->_name( '[width]' ),
								'id'    => $field_type_object->_id( '_width' ),
								'value' => (int) $value['width'],
								'type'  => 'text',
								'class' => 'form-control',
							) ); 
				?>
				<span class="input-group-addon">px</span>
		    </div>
		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    <div class="input-group">
      			<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Style'); ?></span>
			    <?php echo $field_type_object->select( array(
							'name'  => $field_type_object->_name( '[style]' ),
							'id'    => $field_type_object->_id( '_style' ),
							'class'   => 'form-control',
							'options' => wpape_border_get_state_options( $value['style'] ),
							'desc'    => $field_type_object->_desc( true )
						) ); 
				?>
		    </div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		    <div class="input-group">
      			<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Color'); ?></span>
					<?php  echo  $field_type_object->input( array(
								'name'  			=> $field_type_object->_name( '[color]' ),
								'id'    			=> $field_type_object->_id( '_color' ),
								'class'             => 'form-control wpape_color',
								'data-default' 		=>  $value['color']  ,
								'data-alpha'        => 'true',
								'value' 			=> $value['color'] 
							)); 
					?>
		    </div>
		</div>
	</div>
</div>
<?php
}
add_filter( 'cmb2_render_border', 'wpape_border_render_field_callback', 10, 5 );