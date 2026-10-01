<?php
/**
 * Home page.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/sections/hero' );
get_template_part( 'template-parts/sections/services-grid' );
get_template_part( 'template-parts/sections/areas' );
get_template_part( 'template-parts/sections/work' );
get_template_part( 'template-parts/sections/approach' );
get_template_part( 'template-parts/sections/why' );
get_template_part( 'template-parts/sections/faq-teaser' );
get_template_part( 'template-parts/sections/contact-split' );

get_footer();
