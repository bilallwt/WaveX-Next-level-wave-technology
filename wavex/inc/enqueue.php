<?php
/**
 * Scripts and styles.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Front-end assets. No external requests: the font stack is system-based.
 */
function wavex_enqueue_assets() {
	$css = WAVEX_DIR . '/assets/css/main.css';
	$js  = WAVEX_DIR . '/assets/js/navigation.js';

	wp_enqueue_style(
		'wavex-main',
		WAVEX_URI . '/assets/css/main.css',
		array(),
		file_exists( $css ) ? filemtime( $css ) : WAVEX_VERSION
	);

	wp_enqueue_script(
		'wavex-navigation',
		WAVEX_URI . '/assets/js/navigation.js',
		array(),
		file_exists( $js ) ? filemtime( $js ) : WAVEX_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_front_page() || is_page_template( 'template-service.php' ) ) {
		$studio = WAVEX_DIR . '/assets/js/studio.js';
		wp_enqueue_script(
			'wavex-studio',
			WAVEX_URI . '/assets/js/studio.js',
			array(),
			file_exists( $studio ) ? filemtime( $studio ) : WAVEX_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}

	if ( is_page_template( 'template-service.php' ) ) {
		$guide = WAVEX_DIR . '/assets/js/guide.js';
		wp_enqueue_script(
			'wavex-guide',
			WAVEX_URI . '/assets/js/guide.js',
			array(),
			file_exists( $guide ) ? filemtime( $guide ) : WAVEX_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}

	if ( is_page_template( 'template-services.php' ) ) {
		$sv = WAVEX_DIR . '/assets/js/services.js';
		wp_enqueue_script(
			'wavex-services',
			WAVEX_URI . '/assets/js/services.js',
			array(),
			file_exists( $sv ) ? filemtime( $sv ) : WAVEX_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}

	$vis = WAVEX_DIR . '/assets/js/visuals.js';
	wp_enqueue_script(
		'wavex-visuals',
		WAVEX_URI . '/assets/js/visuals.js',
		array(),
		file_exists( $vis ) ? filemtime( $vis ) : WAVEX_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wavex_enqueue_assets' );
