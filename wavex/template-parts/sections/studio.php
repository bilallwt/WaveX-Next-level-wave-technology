<?php
/**
 * Home: "See how it works". Pick an area, pick a service, watch it happen.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$groups   = wavex_studio_groups();
$first    = true;
?>
<section class="studio studio--home" id="studio" aria-labelledby="studio-title" data-studio>
	<div class="studio__inner">
		<header class="studio__head">
			<p class="eyebrow"><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
			<h2 class="section__title" id="studio-title"><?php esc_html_e( 'Watch every service come to life', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Choose an area, then a service, to see in a short animation what happens behind the scenes. These are illustrations of our process.', 'wavex' ); ?></p>
		</header>

		<div class="sx">
			<div class="sx__groups" role="group" aria-label="<?php esc_attr_e( 'Service areas', 'wavex' ); ?>">
				<?php foreach ( $groups as $gkey => $group ) : ?>
					<button class="sx__pill sx__pill--<?php echo esc_attr( $gkey ); ?>" type="button" data-group="<?php echo esc_attr( $gkey ); ?>" aria-pressed="false">
						<span class="sx__pill-count"><?php echo (int) count( $group['services'] ); ?></span>
						<?php echo esc_html( $group['label'] ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<div class="studio__nav" role="tablist" aria-label="<?php esc_attr_e( 'Services', 'wavex' ); ?>">
				<?php
				foreach ( $groups as $gkey => $group ) :
					foreach ( $group['services'] as $slug ) :
						$service = $services[ $slug ];
						?>
						<button class="studio__tab studio__tab--<?php echo esc_attr( $gkey ); ?> gtheme--<?php echo esc_attr( $gkey ); ?>" type="button" role="tab" data-group="<?php echo esc_attr( $gkey ); ?>" id="tab-<?php echo esc_attr( $slug ); ?>" aria-controls="panel-<?php echo esc_attr( $slug ); ?>" aria-selected="<?php echo $first ? 'true' : 'false'; ?>" tabindex="<?php echo $first ? '0' : '-1'; ?>">
							<span class="studio__tab-icon"><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="studio__tab-label"><?php echo esc_html( $service['title'] ); ?></span>
						</button>
						<?php
						$first = false;
					endforeach;
				endforeach;
				?>
			</div>

			<div class="studio__main">
				<?php
				$first = true;
				foreach ( $groups as $gkey => $group ) :
					foreach ( $group['services'] as $slug ) :
						get_template_part( 'template-parts/components/scene-panel', null, array( 'slug' => $slug, 'gkey' => $gkey, 'first' => $first ) );
						$first = false;
					endforeach;
				endforeach;
				?>
			</div>
		</div>

		<div class="studio__cta">
			<p><strong><?php esc_html_e( 'Have something in mind?', 'wavex' ); ?></strong> <?php esc_html_e( 'Tell us about it and we will talk it through.', 'wavex' ); ?></p>
			<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'a development project', 'wavex' ) ) ); ?>
		</div>
	</div>
</section>
