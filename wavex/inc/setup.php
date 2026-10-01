<?php
/**
 * Theme setup.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme supports and menu locations.
 */
function wavex_setup() {
	load_theme_textdomain( 'wavex', WAVEX_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_post_type_support( 'page', 'excerpt' );

	add_image_size( 'wavex-card', 720, 450, true );

	register_nav_menus( array(
		'footer' => __( 'Footer Links', 'wavex' ),
	) );
}
add_action( 'after_setup_theme', 'wavex_setup' );

/**
 * Content width.
 */
function wavex_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'wavex_content_width', 0 );

/**
 * Body classes.
 *
 * @param string[] $classes Classes.
 * @return string[]
 */
function wavex_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-home';
	}
	return $classes;
}
add_filter( 'body_class', 'wavex_body_classes' );

/**
 * Remove the generator tag and emoji scripts to keep the front end light.
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
