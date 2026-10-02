<?php
/**
 * Inner-page banner (the single H1 of the page).
 *
 * Args: title, text (optional), eyebrow (optional), crumbs (bool, default true).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args( isset( $args ) ? $args : array(), array(
	'title'   => '',
	'text'    => '',
	'eyebrow' => '',
	'crumbs'  => true,
) );
?>
<header class="bn bn--page">
	<div class="bn__bg" aria-hidden="true"><i class="bn__orb bn__orb--1"></i><i class="bn__orb bn__orb--2"></i><span class="bn__rings"></span></div>
	<div class="bn__inner">
		<?php
		if ( $args['crumbs'] ) {
			get_template_part( 'template-parts/components/breadcrumbs' );
		}
		?>
		<?php if ( $args['eyebrow'] ) : ?>
			<p class="bn__eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
		<?php endif; ?>
		<h1 class="bn__title"><?php echo esc_html( $args['title'] ); ?></h1>
		<?php if ( $args['text'] ) : ?>
			<p class="bn__text"><?php echo esc_html( $args['text'] ); ?></p>
		<?php endif; ?>
	</div>
</header>
