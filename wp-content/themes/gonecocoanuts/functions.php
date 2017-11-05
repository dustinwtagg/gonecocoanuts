<?php

function gonecocoanuts_resources() {
	wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'gonecocoanuts_resources');

// Customize excerpt word count length
function custom_excerpt_length() {
	return 50;
}
add_filter('excerpt_length', 'custom_excerpt_length');

// Theme setup
function gonecocoanuts_setup() {
	// Navigation menues
	register_nav_menus(array(
		'primary' => __('Primary Menu'),
		'footer' => __('Footer Menu'),
		'global' => __('Global Menu'),
	));

	// Add featured image support 
	add_theme_support('post-thumbnails');
	//param: name, width, height, crop type (hard or soft)
	add_image_size('small-thumbnail', 140, 80, true);
	//can define segmant of cropped image to view
	add_image_size('banner-image', 920, 210, array('left','top'));
}
add_action('after_setup_theme', 'gonecocoanuts_setup');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Float Left Sidebar',
		'id'            => 'sidebar',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
/*
function menuDisplay() {
	$('directory').toggleClass('directory_show_toggle');
	//$('#frame').toggleClass('color');
	if($('directory').hasClass('directory_show_toggle'))
	{
		document.getElementById('img_open').style.display = 'none';
		document.getElementById('img_close').style.display = 'block';
	}
	else
	{
		document.getElementById('img_open').style.display = 'block';
		document.getElementById('img_close').style.display = 'none';
	}
}
function toggleMenu() {
	$('#frame').toggleClass('color');
	/*if ($('.div_content').hasClass('move')) {
        $('.div_content :input').attr('disabled', true);
    } else {
        $('.div_content :input').removeAttr('disabled');
    }   *//*
}
function removeMenu() {
	//$('#frame').on('click', function () {
            //if ($('#directory').hasClass('directory_show_toggle')) {
				//$('#frame').removeClass('color')
				$('#directory').removeClass('directory_show_toggle');
				//$('.div_content :input').attr('disabled', false);
            
   // });	
}*/