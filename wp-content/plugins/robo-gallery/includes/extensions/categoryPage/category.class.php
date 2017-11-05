<?php
/*
*      Robo Gallery     
*      Version: 1.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2016, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class ROBO_GALLERY_CATEGORY_PAGE{
   
    protected $postType;

    protected $postTypeParams;

    protected $assetsUri;

    protected $currentPostOrder;

    public function __construct($postType){ //, array $postTypeParams
    
        $this->postType = $postType;
        $this->postTypeParams = array();
        //$this->postTypeParams = $postTypeParams;
        $this->assetsUri = plugin_dir_url(__FILE__);


        $this->enqueueScripts();
      //  add_action("wp_ajax_hierarchy_{$this->postType}_meta_box", array($this, 'ajaxMetaBoxAttributes'));

        //add_action("wp_ajax_hierarchy_{$this->postType}_dialog", array($this, 'ajaxDialog'));

        $this->ajaxDialog ();

        add_action("wp_ajax_hierarchy_{$this->postType}_dialog_save", array($this, 'ajaxDialogSave'));
	    
    }



    
    public function enqueueScripts(){ 
        wp_enqueue_style('wp-jquery-ui-dialog');
        wp_enqueue_style(
            'hierarchy-post-attributes-style',
            $this->assetsUri . 'css/style.css',
            array('wp-jquery-ui-dialog')
        );

        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script(
            'hierarchy-post-attributes-nestable-js',
            $this->assetsUri . 'js/jquery.nestable.js',
            array('jquery-ui-dialog'),
            false,
            true
        );
        wp_enqueue_script(
            'hierarchy-post-attributes-js',
            $this->assetsUri . 'js/script.js',
            array('jquery-ui-dialog', 'hierarchy-post-attributes-nestable-js'),
            false,
            true
        );

        $postTypeObject = get_post_type_object($this->postType);
       wp_localize_script(
            'hierarchy-post-attributes-js',
            'hierarchyPostAttributes',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'metaBox' => array(
                    'action' => array(
                        'get' => "hierarchy_{$this->postType}_meta_box"
                    )
                ),
                'dialog' => array(
                    'title' => __(sprintf('Edit hierarchy of %s', $postTypeObject->labels->name)),
                    'button' => array(
                        'save' => array(
                            'label' => __('Save')
                        ),
                        'cancel' => array(
                            'label' => __('Cancel')
                        )
                    ),
                    'action' => array(
                        'get' => "hierarchy_{$this->postType}_dialog",
                        'save' => "hierarchy_{$this->postType}_dialog_save",
                    ),
                ),
                'error' => array(
                    'title' => __('Error'),
                    'button' => array(
                        'ok' => array(
                            'label' => __('OK')
                        ),
                    )
                )
            )
        );
    }


   

    

    public function ajaxDialog() {
        $this->checkPermission();

        $postTree = $this->getPostTree(ROBO_GALLERY_TYPE_POST);
        ?>
        <p>
        	<button class="save_category button button-primary"> Save</button>
        </p>
        <div class="wrapper-nestable-list" >
            <div class="nestable-list dd">
                <?php $this->theNestableList($postTree); ?>
            </div>
            <div class="nestable-list-spinner">
                <img src="<?php echo admin_url('/images/spinner-2x.gif') ?>" />
            </div>
        </div>
        <button class="save_category button button-primary"> Save</button>
        <?php

        //wp_die();
    }

    public function ajaxDialogSave() {
        $this->checkPermission();

        if (!isset($_POST['hierarchy_posts'])) {
            header('HTTP/1.0 403 Forbidden');
            echo 'Empty posts hierarchy data for saving';
            die();
        }
        if (!is_array($_POST['hierarchy_posts'])) {
            header('HTTP/1.0 403 Forbidden');
            echo 'Wrong posts hierarchy data for saving';
            die();
        }

        $hierarchyPosts = $_POST['hierarchy_posts'];
        $this->currentPostOrder = 0;
        foreach ($hierarchyPosts as $order => $postData) {
            $this->updatePostHierarchy($postData);
        }
    }


    protected function getPostTree($postType){
        $args = array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $postMap = array();
        $postTree = array();

        foreach (get_posts($args) as $post) {
            if (isset($postMap[$post->ID])) {
                $postMap[$post->ID]['post'] = $post;
                $postData = &$postMap[$post->ID];
            } else {
                $postData = array('post' => $post, 'children' => array());
                $postMap[$post->ID] = &$postData;
            }
            if (0 == $post->post_parent) {
                $postTree["{$post->menu_order}-{$post->ID}"] = &$postData;
            } else {
                $postMap[$post->post_parent]['children'][$post->ID] = &$postData;
            }
            unset($postData);
        }
        
        // Adding children posts with lost parent to tree
        foreach ($postMap as &$postData) {
            if (!isset($postData['post']) && is_array($postData['children'])) {
                foreach ($postData['children'] as &$childPostData) {
                    $childPost = $childPostData['post'];
                    $postTree["{$childPost->menu_order}-{$childPost->ID}"] = &$childPostData;
                }
            }
        }
        asort($postTree);

        return $postTree;
    }


    protected function theNestableList(array $tree){
        ?>
            <ol class="dd-list">
            <?php foreach ($tree as $item) : ?>
                <li class="dd-item" data-id="<?php echo $item['post']->ID; ?>">
                    <div class="dd-handle">
                        <?php 
                        $title = esc_attr($item['post']->post_title);
                        echo "{$title} [{$item['post']->ID}: {$item['post']->post_name}]" ; ?>
                    </div>
                    <?php if (!empty($item['children'])) : ?>
                        <?php $this->theNestableList($item['children']); ?>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            </ol>
        <?php
    }


    protected function checkPermission(){
        $postTypeObject = get_post_type_object($this->postType);
        if (!current_user_can($postTypeObject->cap->edit_posts)) {
            header('HTTP/1.0 403 Forbidden');
            echo sprintf("You don't have permission for editing this %s", $postTypeObject->labels->name);
            die();
        }
    }


    protected function updatePostHierarchy($postData, $parentId = 0){
        $this->currentPostOrder++;
        wp_update_post(array(
            'ID' => absint($postData['id']),
            'post_parent' => absint($parentId),
            'menu_order' => $this->currentPostOrder
        ));

        if (!empty($postData['children'])) {
            foreach ($postData['children'] as $childPostData) {
                $this->updatePostHierarchy($childPostData, $postData['id']);
            }
        }
    }
}
