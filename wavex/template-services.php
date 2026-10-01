<?php
/**
 * Template Name: Services Overview
 * Template Post Type: page
 *
 * Lists every service once per group at /services/.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/components/page-hero', null, array(
		'title' => get_the_title(),
		'text'  => has_excerpt() ? get_the_excerpt() : '',
	) );
endwhile;

$services = wavex_services();
?>
<div class="wrap">
	<?php foreach ( wavex_service_groups() as $group_slug => $group_label ) : ?>
		<section class="section section--flush" id="<?php echo esc_attr( $group_slug ); ?>" aria-labelledby="<?php echo esc_attr( $group_slug ); ?>-title">
			<h2 class="section__title" id="<?php echo esc_attr( $group_slug ); ?>-title"><?php echo esc_html( $group_label ); ?></h2>
			<div class="card-grid">
				<?php
				foreach ( $services as $slug => $service ) :
					if ( ! in_array( $group_slug, $service['groups'], true ) ) {
						continue;
					}
					?>
					<a class="service-card" href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>">
						<span class="service-card__icon"><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="service-card__text"><?php echo esc_html( $service['text'] ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endforeach; ?>
</div>
<?php
get_template_part( 'template-parts/sections/cta-bar' );
get_footer();
