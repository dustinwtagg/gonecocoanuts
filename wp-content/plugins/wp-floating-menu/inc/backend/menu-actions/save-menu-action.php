<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" );

global $wpdb; 
/** Query to save current menu structure setting into database table */
if(isset($_POST['wpfm_add_nonce_save_menu_fields']) && isset($_POST['wpfm_save_menu_fields']) && wp_verify_nonce($_POST['wpfm_add_nonce_save_menu_fields'], 'wpfm_nonce_save_menu_fields' ) && current_user_can('manage_options'))
{
foreach($_POST as $key=>$val)
{
if($key == 'menu_structure'){
	$$key = $val;
    } else {
		$$key = sanitize_text_field( $val );
	}
}
    /** Sanitizing each form fields for Menu field added */
	$menu_structure_temp = array();
	foreach ( $menu_structure as $key => $val ) {
		$menu_structure_temp[$key] = array();
		foreach ( $val as $k => $v ) {
			if ( !is_array( $v ) ) {
				$menu_structure_temp[$key][$k] = sanitize_text_field( $v );
			} else {
				$menu_structure_temp[$key][$k] = array_map( 'sanitize_text_field', $v );
			}
		}
	}
	$menu_structure = $menu_structure_temp;
    $menu_settings = array();
    $menu_settings = isset( $menu_structure ) ? $menu_structure : array(); 
    $current_menu_name = sanitize_text_field($_POST['wpfm_save_menu_name']);
    $current_menu_id = $_POST['current_menu_id'];
    $table_name = $wpdb->prefix . "wp_floating_menu_details";    
    $update = $wpdb->update(
        $table_name, 
        array(
            'menu_name'    => $current_menu_name, 
            'menu_details' => maybe_serialize($menu_settings)            
            ),
             array( 
                'ID' => $current_menu_id 
                ),
                array( 
                     '%s',
                     '%s'                     
                      ),
                      array( 
                        '%d' 
                ));
    if($update){  
        wp_redirect( admin_url() . 'admin.php?page=wpfm-admin&action=wpfm-edit-menu&id='.$current_menu_id.'&message=1' );
    }else{  
        wp_redirect( admin_url() . 'admin.php?page=wpfm-admin&action=wpfm-edit-menu&id='.$current_menu_id.'&message=2' );
       }
}
/** Query to save current menu display setting values */
else if(isset($_POST['wpfm_add_nonce_save_menu_settings']) && isset($_POST['wpfm_save_menu_settings']) && wp_verify_nonce($_POST['wpfm_add_nonce_save_menu_settings'], 'wpfm_nonce_save_menu_settings') && current_user_can('manage_options')) 
{
 foreach($_POST as $key=>$val)
{
if ($key == 'menu_design'){
        $$key = $val;
	} else {
		$$key = sanitize_text_field( $val );
	}
}
    $menu_settings = array();
    $menu_settings['menu_design'] = array_map( 'sanitize_text_field', $menu_design );
    $current_menu_id = $_POST['current_menu_id'];   
    $table_name = $wpdb->prefix . "wp_floating_menu_details";    
    $update = $wpdb->update($table_name, 
        array(
            'menu_display_setting_details' => maybe_serialize($menu_settings)            
            ),
             array( 
                'ID' => $current_menu_id 
                ),
                array(
                     '%s'                     
                      ),
                      array( 
                        '%d' 
                ));
    if($update){
        wp_redirect( admin_url() . 'admin.php?page=wpfm-admin&action=wpfm-edit-menu&id='.$current_menu_id.'&message=1');
    }else{
        wp_redirect( admin_url() . 'admin.php?page=wpfm-admin&action=wpfm-edit-menu&id='.$current_menu_id.'&message=2' );
    }   
  }
else{
    die( 'No script kiddies please!' );
}