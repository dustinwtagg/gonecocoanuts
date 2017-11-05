<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

function wpape_size_get_font_params_row( $value,  $text, $name, $curent = '', $demoId  ) {
	$html = '';
	$html .= '<label class="btn btn-success '.($value==$curent?'active':'').'">';
	 	$html .= '<input type="checkbox" autocomplete="off" name="'.$name.'" '
	 		.($value==$curent?' checked ':'').' '
	 		.' value="'.$value.'"> ';
	 	$html .= $text ;
	$html .= '</label>';
	return $html;
}


function jt_cmb2_font_field( $metakey, $post_id = 0 ) {
	echo jt_cmb2_get_font_field( $metakey, $post_id );
}

function jt_cmb2_render_font_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	$default = $field->args('default');

	$value = wp_parse_args( $value, array(
		'enabled'		=> isset($default['enabled']) 		? $default['enabled'] 				:'0',
		'fontSize' 		=> isset($default['fontSize']) 		? $default['fontSize'] 				:'12',

		'fontLineHeight'=> isset($default['fontLineHeight'])? $default['fontLineHeight'] 		:'88',
		
		'fontBold' 		=> isset($default['fontBold']) 		? $default['fontBold'] 				:'normal',
		'fontItalic' 	=> isset($default['fontItalic']) 	? $default['fontItalic'] 			:'normal',
		'fontUnderline' => isset($default['fontUnderline']) ? $default['fontUnderline'] 		:'none',
		'iconSelect'	=> isset($default['iconSelect']) 	? $default['iconSelect'] 			:'glyphicon-new-window',
		'borderSize'	=> 0,
		
		'color' 		=> isset($default['color']) 		? $default['color'] 				:'#ffffff',
		'colorHover'	=> isset($default['colorHover']) 	? $default['colorHover'] 			:'#ffffff',
		'colorBg'		=> isset($default['colorBg']) 		? $default['colorBg'] 				:'#e54028',
		'colorBgHover'	=> isset($default['colorBgHover']) 	? $default['colorBgHover'] 			:'#b73725',
	) );
	if( $field->args('level') ) echo '<div class="ape_premium wpape-block-premium"> <p>'.WPAPE_GALLERY_BUTTON_PREMIUM.'</p></div>';
?>
<div class="form-horizontal">

	<div class="form-group">
	    <label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id( 'enabled' ); ?>'">
	    	<?php wpApeGalleryHelperClass::_te( $field->args('label_enable') ); ?>
	    </label>
	     <div class="col-sm-10">
	     	<?php
			echo 
				'<input type="checkbox" data-toggle="toggle" data-onstyle="success" class="wpape_action_element" '
				.'data-on="'.wpApeGalleryHelperClass::_t('Show').'" data-off="'.wpApeGalleryHelperClass::_t('Hide').'"' 
				.' name="'.$field_type_object->_name('[enabled]').'" '
				.' id="'. $field_type_object->_id('enabled').'" '
				.( $value['enabled'] ? ' checked ' : '' )
				.'value="1" '
				.'data-depends=".'.$field_type_object->_id( 'optionsBlok' ).'" '
				.'>';
			 ?>
	    </div>
	</div>

	<div class="<?php echo $field_type_object->_id( 'optionsBlok' );?>">

	<?php if( $field->args('icon') ){ ?>
	  	<div class="form-group">
	    	<label class="col-xs-6 col-sm-2 control-label" for="<?php echo $field_type_object->_id( 'iconSelect' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'font_icon_text', 'Icon Options' ) ); ?></label>
	    	<div class="col-xs-2  col-sm-2 col-md-2 col-lg-2">
				<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Icon'); ?></span>
					<button class="btn btn-default form-control" role="iconpicker" data-icon="<?php echo $value['iconSelect'];?>" data-inputid="<?php echo $field_type_object->_id('iconSelect');?>" data-search="false"></button>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
				<?php echo $field_type_object->input( array(
						'name'  => $field_type_object->_name('[iconSelect]'),
						'id'    => $field_type_object->_id('iconSelect'),
						'value' => $value['iconSelect'],
						'type'  => 'text',
						'class'	=> 'form-control'
					) ); 
				?>
			</div>
			<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Border'); ?></span>
					<?php echo $field_type_object->input( array(
							'name'  			=> $field_type_object->_name( '[borderSize]' ),
							'id'    			=> $field_type_object->_id( 'borderSize' ),
							'value' 			=> (int) $value['borderSize'],
							'data-slider-value' => (int) $value['borderSize'],
							'type'  			=> 'text',
							'class' 			=> 'form-control',
						) ); 
					?>
					<span class="input-group-addon">px</span>
				</div>
			</div>
	  	</div>

	<?php } else {   ?>
		<div class="form-group">
		    <label class="col-sm-2 control-label" for="<?php echo $field_type_object->_id( '_hfont' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'font_hfont_text', 'Font Options' ) ); ?></label>
		    <div class="col-sm-10">
		    	<div class="btn-group " data-toggle="buttons">
				<?php
					echo wpape_size_get_font_params_row( 'bold',  		'Bold',			$field_type_object->_name('[fontBold]'), 		$value['fontBold'] , 		$field_type_object->_id( 'demo' ));
					echo wpape_size_get_font_params_row( 'italic',  	'Italic', 		$field_type_object->_name('[fontItalic]'), 		$value['fontItalic'], 		$field_type_object->_id( 'demo' ) );
					echo wpape_size_get_font_params_row( 'underline',  	'Underline',	$field_type_object->_name('[fontUnderline]'), 	$value['fontUnderline'], 	$field_type_object->_id( 'demo' ) );
				 ?>
				</div>
		    </div>
		</div>
	
	<?php }   ?>

	  	<div class="form-group">
	    	<div class="col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Font size'); ?></span>
			      	<?php echo $field_type_object->input( array(
								'name'  			=> $field_type_object->_name( '[fontSize]' ),
								'id'    			=> $field_type_object->_id( 'fontSize' ),
								'value' 			=> (int) $value['fontSize'],
								'type'  			=> 'text',
								'class' 			=> 'form-control',
						) ); 
					?>
					<span class="input-group-addon">px</span>
				</div>
			</div>
			<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
		    		<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Line height'); ?></span>
				      <?php echo $field_type_object->input( array(
									'name'  			=> $field_type_object->_name( '[fontLineHeight]' ),
									'id'    			=> $field_type_object->_id( 'fontLineHeight' ),
									'value' 			=> (int) $value['fontLineHeight'],
									'type'  			=> 'text',
									'class' 			=> 'form-control',
							) ); 
						?>
					<span class="input-group-addon">%</span>
				</div>
			</div>
	  	</div>

		<div class="form-group">
	    	<div class="col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Color'); ?></span>
					 <?php 
						echo  $field_type_object->input( array(
							'name'  		=> $field_type_object->_name( '[color]' ),
							'id'    		=> $field_type_object->_id( 'color' ),
							'class'         => 'form-control wpape_color wpape_font_color',
							'data-default' 	=> $value['color'],
							'data-alpha'    => 'true',
							'value' 		=> $value['color'],
						)); 
					?> 
				</div>
			</div>

			<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_t('Hover'); ?></span>
					<?php 
						echo  $field_type_object->input( array(
							'name'  		=> $field_type_object->_name( '[colorHover]' ),
							'id'    		=> $field_type_object->_id( 'colorHover' ),
							'class'         => 'form-control wpape_color wpape_font_color',
							'data-default' 	=> $value['colorHover'],
							'data-alpha'    => 'true',
							'value' 		=> $value['colorHover']
						)); 
					?> 
		    	</div>
		    </div>
	  	</div>

	<?php if( $field->args('icon') ){ ?>
		<div class="form-group">
	    	<div class="col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Background'); ?></span>

					<?php 
						echo  $field_type_object->input( array(
							'name'  		=> $field_type_object->_name( '[colorBg]' ),
							'id'    		=> $field_type_object->_id( 'colorBg' ),
							'class'         => 'form-control wpape_color wpape_font_color',
							'data-default' 	=> $value['colorBg'],
							'data-alpha'    => 'true',
							'value' 		=> $value['colorBg']
						)); 
					?> 
		    	</div>
			</div>

			<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">
		    	<div class="input-group">
					<span class="input-group-addon"><?php wpApeGalleryHelperClass::_te('Hover'); ?></span>
					<?php 
						echo  $field_type_object->input( array(
							'name'  		=> $field_type_object->_name( '[colorBgHover]' ),
							'id'    		=> $field_type_object->_id( 'colorBgHover' ),
							'class'         => 'form-control wpape_color wpape_font_color',
							'data-default' 	=> $value['colorBgHover'],
							'data-alpha'    => 'true',
							'value' 		=> $value['colorBgHover'],
						)); 
					?> 
		    	</div>
		    </div>
	  	</div>
	<?php } ?>
	</div>
</div>
<?php
}
add_filter( 'cmb2_render_font', 'jt_cmb2_render_font_field_callback', 10, 5 );