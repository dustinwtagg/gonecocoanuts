<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function wpape_multisize_field( $metakey, $post_id = 0 ) {
	echo wpape_get_multisize_field( $metakey, $post_id );
}

function wpape_multisize_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	$default = $field->args('default');
	if(!is_array($default))  $default = array();

	if(!isset($default['width'])) 		$default['width'] 		= '100';
	if(!isset($default['widthType']))	$default['widthType'] 	= '';
	
	$value = wp_parse_args( $value, array( 
		 'width' 		=> $default['width'], 
		 'widthType' 	=> $default['widthType'],
	));
?>
<div class="form-horizontal">
	<div class="form-group">
	    <label class="col-xs-4 col-sm-2 control-label" for="<?php echo $field_type_object->_id(); ?>"><?php echo esc_html(  $field->args('name') ); ?></label>

	    <div class="col-xs-3 col-sm-2"> 
		    <?php 
		    echo $field_type_object->input( array(
				'name'  		=> $field_type_object->_name('[width]' ),
				'id'    		=> $field_type_object->_id('[width]' ),
				'value' 		=> $value['width'],
				'class' 		=> 'form-control '.$field->args('class') ,
			)); 
		   ?>
		</div>
		<div class="col-xs-3 col-sm-2"> 
		<?php
				echo 
					'<input type="checkbox" data-toggle="toggle"  data-on="px" data-off="%" data-onstyle="primary" data-offstyle="success" ' 
					.'name="'.$field_type_object->_name( '[widthType]' ).'" '
					.'id="'. $field_type_object->_id( 'widthType' ).'" '
					.( $value['widthType']==1 ?' checked ':'')
					.'value="1" '
					.'>';
			?> 
		</div>
	</div>
</div>
	<?php
	echo $field_type_object->_desc( true );

}
add_filter( 'cmb2_render_multisize', 'wpape_multisize_field_callback', 10, 5 );
