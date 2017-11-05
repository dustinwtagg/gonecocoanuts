<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function jt_cmb2_wpapetext_field( $metakey, $post_id = 0 ) {
	echo jt_cmb2_get_wpapetext_field( $metakey, $post_id );
}

function jt_cmb2_render_wpapetext_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	
//$value =  $value ? $value : $field->args('default') ;

$sizeClass1 = 'col-sm-8';
$sizeClass2 = 'col-sm-2';
if($field->args('small')){
	$sizeClass1 = 'col-sm-4';
	$sizeClass2 = 'col-sm-6';
}
if($field->args('small')=='xs'){
	$sizeClass1 = 'col-sm-2';
	$sizeClass2 = 'col-sm-8';
}

if($field->args('level')) echo '<div class="ape_premium wpape-block-premium"> <p>'.WPAPE_GALLERY_BUTTON_PREMIUM.'</p></div>';
?>
<div class="form-horizontal">
	<div class="form-group">
	    <label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id(); ?>"><?php echo esc_html(  $field->args('name') ); ?></label>
	    <div class="<?php echo $sizeClass1; ?>">
		    <?php echo $field_type_object->input( array(
				'name'  		=> $field_type_object->_name( ),
				'id'    		=> $field_type_object->_id( ),
				'value' 		=> $value,
				'data-default' 	=> $field->args('data-default'),
				'data-alpha' 	=> $field->args('data-alpha'),
				'class' 		=> 'form-control '.$field->args('class') ,
			)); 
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
add_filter( 'cmb2_render_wpapetext', 'jt_cmb2_render_wpapetext_field_callback', 10, 5 );