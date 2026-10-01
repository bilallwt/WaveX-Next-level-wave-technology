<?php
/**
 * Inner-page heading block (the single H1 of the page).
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
<header class="page-hero">
	<?php
	if ( $args['crumbs'] ) {
		get_template_part( 'template-parts/components/breadcrumbs' );
	}
	?>
	<?php if ( $args['eyebrow'] ) : ?>
		<p class="page-hero__eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
	<?php endif; ?>
	<h1 class="page-hero__title"><?php echo esc_html( $args['title'] ); ?></h1>
	<?php if ( $args['text'] ) : ?>
		<p class="page-hero__text"><?php echo esc_html( $args['text'] ); ?></p>
	<?php endif; ?>
</header>
