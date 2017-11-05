<?php defined('ABSPATH') or die("No script kiddies please!");?>

<div class="wpfm-wrapper wpfm-clear wrap">
    <div class="wpfm-head">     
        <?php include(WPFM_FILE_ROOT_DIR. 'inc/backend/includes/wpfm-header.php');?> 
    </div> 
     <?php
    $options = get_option( WPFM_SETTINGS );
    if( isset( $_GET['message'] ) &&  $_GET['message']==1) { ?>
        <div class="wpfm-message notice notice-success is-dismissible">
            <p><?php 
                echo __( 'Menu Updated.', 'wp-floating-menu' );
                ?>
            </p>
        </div>
    <?php }else if( isset( $_GET['message'] ) &&  $_GET['message']==2) { ?>
        <div class="wpfm-message notice notice-success is-dismissible">
            <p><?php 
                echo __( 'No Changes Made.', 'wp-floating-menu' );
                ?>
            </p>
        </div>
    <?php }else if(isset($_GET['message']) && $_GET['message']==4){ ?>
        <div class="wpfm-message notice notice-success is-dismissible">
            <p>
            <?php 
              echo __( 'Menu Added And Saved Successfully.', 'wp-floating-menu' );
            ?>
            </p>
        </div>
    <?php } ?>          
<h2 class="nav-tab-wrapper">                             
        <a href="javascript:void(0)" id="wpfm-add-menu" class="wpfm-tabs-trigger nav-tab nav-tab-active"><?php _e( 'Menu Structure', 'wpfm-floating-menu' ); ?></a>
        <a href="javascript:void(0)" id="wpfm-display-setting" class="wpfm-tabs-trigger nav-tab"><?php _e( 'Display setting', 'wpfm-floating-menu' ); ?></a>
</h2>
<div class="wpfm-inner-wrapper" id="poststuff">
    <div id="post-body" class="metabox-holder columns-2">
        <div id="post-body-content">
            <div class="postbox" id="wpfm-post-box">
                <div class="wpfm-backend-wrapper clearfix" id="col-container">
                    <!-- Add Menu page -->                    
                    <div class='wpfm-tab-contents' id='tab-wpfm-add-menu'>   
                       <?php include('inner-fields/edit-menu-inner.php');?>                                               
                    </div>
                    
                    <!-- Edit Display option for menu page -->
                    <form action="<?php echo admin_url() . 'admin-post.php' ?>" method='post' class="wpfm-setting-form" style="display:none;">
                        <div class='wpfm-tab-contents' id='tab-wpfm-display-setting' style="display:none">                 
                            <?php include( 'inner-fields/wpfm-display-setting.php' ); ?>
                        </div>
                        <div class="wpfm-actions" id="wpfm-submit">
                            <input type="hidden" name="current_menu_id" value="<?php echo $_GET['id'];?>" />
                            <input type="hidden" name="action" value="wpfm_save_menu_options" />
                            <input type="submit" class="button-primary" name='wpfm_save_menu_settings' value="<?php _e( 'Save Settings', 'wpfm-floating-menu' ); ?>" />
                         <?php wp_nonce_field( 'wpfm_nonce_save_menu_settings', 'wpfm_add_nonce_save_menu_settings' ); ?>
                        </div>                      
                    </form>                
                </div><!--  .wpfm backend wrapper --> 
            </div><!-- .postbox -->
        </div><!-- #post-body-content -->
            <div id="postbox-container-1" class="postbox-container">
             <?php include(WPFM_FILE_ROOT_DIR. 'inc/backend/includes/wpfm-sidebar.php');?>
            </div> <!-- #postbox-container-1 .postbox-container -->
        </div><!-- .metabox-holder columns-2 #post-body -->
    </div><!-- .poststuff -->
</div>