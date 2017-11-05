<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

define( 'WPAPE_GALLERY_MANAGE_URL', plugin_dir_url( __FILE__ ) );

function wpape_gallery_manage_field( $field, $meta ) {
	wp_enqueue_script( 'wpape_gallery_manage_init', WPAPE_GALLERY_MANAGE_URL.'js/script.js', array( 'jquery' ), null );
	wp_enqueue_style( 'wpape_gallery_manage_style', WPAPE_GALLERY_MANAGE_URL.'css/style.css', array(), '', 'all' );

	$autoOpen = 0;
	if( isset($_GET['ape_media_show']) ) $autoOpen = 1;

	if ( empty( $meta ) || $meta == ' ' || $meta == '' || !is_array($meta) ) $meta = ' ';
		else $meta = implode( ',', $meta );

	echo '<div class="wpape-gallery-manage apeGalleryDiv " '.($autoOpen?' data-open="1"':'').'>';
	echo '	<input type="hidden" class="wpape-gallery-manage-value" id="' . $field->args( 'id' ) . '" name="' . $field->args( 'id' ) . '" value="' . $meta . '" />';
	echo '	<button class="btn btn-success btn-lg "><span class="glyphicon glyphicon glyphicon-th" aria-hidden="true"></span> ' . wpApeGalleryHelperClass::_t( 'Gallery Resources' ) . ' </button>';
	echo '</div>';
	echo '<p class="cmb2-metabox-description">'.wpApeGalleryHelperClass::_t('Open gallery resources by click on Images button. Upload and configure gallery images here.') . '</p>';
}
add_filter( 'cmb2_render_wpape_gallery_manage', 'wpape_gallery_manage_field', 10, 2 );

function wpape_gallery_manage_field_sanitise( $meta_value, $field ) {
	if ( empty( $meta_value ) ) {
		$meta_value = '';
	} else {
		$meta_value = explode( ',', $meta_value );
	}
	return $meta_value;
}