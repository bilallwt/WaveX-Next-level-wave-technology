<?php
/**
 * 404 page.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	'eyebrow' => '404',
	'title'   => __( 'Page not found', 'wavex' ),
	'text'    => __( 'The page you are looking for does not exist or has moved.', 'wavex' ),
) );
?>
<div class="wrap wrap--narrow not-found">
	<?php get_search_form(); ?>
	<div class="hero__actions">
		<?php wavex_button( __( 'Home', 'wavex' ), home_url( '/' ), 'primary' ); ?>
		<?php wavex_button( __( 'Services', 'wavex' ), wavex_url( 'services' ), 'ghost' ); ?>
		<?php wavex_button( __( 'Our Work', 'wavex' ), wavex_url( 'our-work' ), 'ghost' ); ?>
		<?php wavex_button( __( 'Contact', 'wavex' ), wavex_url( 'contact' ), 'ghost' ); ?>
	</div>
</div>
<?php
get_footer();
