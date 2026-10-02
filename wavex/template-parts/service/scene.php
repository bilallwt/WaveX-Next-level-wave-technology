<?php
/**
 * Service page "See how it works" panel. Args: slug, group_id.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug     = isset( $args['slug'] ) ? $args['slug'] : '';
$group_id = isset( $args['group_id'] ) ? $args['group_id'] : 'web';
?>
	<section class="studio studio--single" id="svc-how" aria-labelledby="svc-how-title">
		<div class="studio__inner">
			<header class="studio__head studio__head--left">
				<p class="eyebrow"><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
				<h2 class="section__title" id="svc-how-title"><?php esc_html_e( 'What happens behind the scenes', 'wavex' ); ?></h2>
				<p><em><?php esc_html_e( 'An illustration of the process.', 'wavex' ); ?></em></p>
			</header>
			<div class="sx sx--single" data-studio-single>
				<div class="studio__main">
					<?php get_template_part( 'template-parts/components/scene-panel', null, array( 'slug' => $slug, 'gkey' => $group_id, 'single' => true ) ); ?>
				</div>
			</div>
		</div>
	</section>
