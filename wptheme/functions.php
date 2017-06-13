<?php
/**
 *
 * DO NOT EDIT THIS FILE
 * Any changes you make to this file will be lost
 * To customise things, create a file at wp-content/themes/fishpig/local.php
 * This file will not be deleted or overwritten and is automatically included at the end of this file
 *
 */

if (!function_exists('fishpig_setup')) {
	function fishpig_setup() {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(9999, 9999);

		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		));
	}
}

add_action( 'after_setup_theme', 'fishpig_setup' );

function fishpig_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Main Sidebar', 'fishpig' ),
		'id' => 'sidebar-main',
		'description' => 'Add widgets here to appear in your main Magento sidebar.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

add_action( 'widgets_init', 'fishpig_widgets_init' );

remove_filter('template_redirect', 'redirect_canonical');

add_filter('preview_post_link', 'fishpig_preview_post_link', 10, 2);

function fishpig_preview_post_link($previewLink, $post) {
	return $previewLink . '&fishpig=' . time();
}

@include(__DIR__ . DIRECTORY_SEPARATOR . 'cpt.php');

/* Include local.php*/
$localFile = __DIR__ . DIRECTORY_SEPARATOR . 'local.php';

if (is_file($localFile)) {
	include($localFile);
}
