<?php
/**
 * WaveX Technology theme bootstrap.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WAVEX_VERSION', '1.0.0' );
define( 'WAVEX_DIR', get_template_directory() );
define( 'WAVEX_URI', get_template_directory_uri() );

require_once WAVEX_DIR . '/inc/helpers.php';
require_once WAVEX_DIR . '/inc/data.php';
require_once WAVEX_DIR . '/inc/studio-data.php';
require_once WAVEX_DIR . '/inc/pages-data.php';
require_once WAVEX_DIR . '/inc/service-content.php';
require_once WAVEX_DIR . '/inc/seo.php';
require_once WAVEX_DIR . '/inc/forms.php';
require_once WAVEX_DIR . '/inc/setup.php';
require_once WAVEX_DIR . '/inc/enqueue.php';
require_once WAVEX_DIR . '/inc/post-types.php';
require_once WAVEX_DIR . '/inc/customizer.php';
require_once WAVEX_DIR . '/inc/seed-content.php';
require_once WAVEX_DIR . '/inc/seed.php';
