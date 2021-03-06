<?php
if (!class_exists('FmPostMeta')):

    /**
     *
     */
    class FmPostMeta
    {

        function __construct() {
	        add_action( 'admin_enqueue_scripts', array($this,'admin_enqueue_scripts' ));
            add_action('add_meta_boxes', array($this, 'food_menu_meta_boxs'));
            add_action('save_post', array($this, 'save_food_meta_data'), 10, 3);
	        add_action( 'edit_form_after_title', array($this, 'food_menu_after_title') );
        }
	    function admin_enqueue_scripts(){
		    global $pagenow, $typenow, $TLPfoodmenu;
		    // validate page
		    if ( ! in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit.php' ) ) ) {
			    return;
		    }

		    if ( $typenow != $TLPfoodmenu->post_type ) {
			    return;
		    }

		    wp_enqueue_style( array('wp-color-picker','fm-select2','fm-admin'));
		    wp_enqueue_script(array('wp-color-picker','fm-select2','fm-admin'));
		    $nonce = wp_create_nonce( $TLPfoodmenu->nonceText() );
		    wp_localize_script( 'fm-admin', 'tpl_fm_var', array('tlp_fm_nonce' => $nonce) );
	    }
	    function food_menu_after_title($post){
		    global $TLPfoodmenu;
		    if( $TLPfoodmenu->post_type !== $post->post_type) {
			    return;
		    }
		    $html = null;
		    $html .= '<div class="postbox" style="margin-bottom: 0;"><div class="inside">';
		    $html .= '<p style="text-align: center;"><a style="color: red; text-decoration: none; font-size: 14px;" href="https://www.radiustheme.com/food-menu-pro-wordpress/" target="_blank">Please check the pro features</a></p>';
		    $html .= '</div></div>';

		    echo $html;
	    }

        function food_menu_meta_boxs() {
            global $TLPfoodmenu;
            add_meta_box('tlp_food_menu_meta_details', __('Food Details', 'tlp-food-menu'), array($this, 'food_menu_meta_option'), $TLPfoodmenu->post_type, 'normal', 'high');
        }

        function food_menu_meta_option($post) {
            global $TLPfoodmenu;
            wp_nonce_field($TLPfoodmenu->nonceText(), 'tlp_fm_nonce');
            $meta = get_post_meta($post->ID);
            $price = !isset($meta['price'][0]) ? '' : $meta['price'][0];

            ?>
			<table class="form-table">

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="price"><?php _e('Price', 'tlp-food-menu'); ?></label>
					</td>
					<td colspan="4">
                        <input min="0" step="0.01" type="number" name="price" id="price" class="tlpfield" value="<?php echo sprintf("%.2f",$price); ?>">
						<p class="description"><?php _e('Insert the price, leave blank if it is free', 'tlp-food-menu'); ?></p>
					</td>
				</tr>
			</table>
			<?php
        }


        function save_food_meta_data($post_id, $post, $update) {

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

            global $TLPfoodmenu;

            if (!wp_verify_nonce(@$_REQUEST['tlp_fm_nonce'], $TLPfoodmenu->nonceText())) return;

            // Check permissions

            if ($TLPfoodmenu->post_type != $post->post_type) return;

            $meta['price'] = (isset($_POST['price']) ? sprintf("%.2f",floatval(sanitize_text_field(esc_attr($_POST['price'])))) : null);

            foreach ($meta as $key => $value) {
                update_post_meta($post->ID, $key, $value);
            }
        }
    }
endif;
