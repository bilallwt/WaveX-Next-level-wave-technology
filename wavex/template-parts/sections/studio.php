<?php
/**
 * Home: "See how it works". A workbench: explorer on the left, a live scene and
 * its code on the right. Pick a folder (area), pick a file (service), watch it run.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$groups   = wavex_studio_groups();
$first    = true;
$total    = 0;
foreach ( $groups as $group ) {
	$total += count( $group['services'] );
}
$g_icons = array( 'web' => 'layout', 'mobile' => 'mobile', 'seo' => 'search' );
?>
<section class="studio studio--home wbsec" id="studio" aria-labelledby="studio-title" data-studio>
	<div class="studio__inner">
		<header class="wbsec__head">
			<p class="eyebrow"><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
			<h2 class="section__title" id="studio-title"><?php esc_html_e( 'Open a service. Watch it get built.', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Pick an area, then a service. A short animation shows what happens behind the scenes, next to the kind of code involved. These are illustrations of our process.', 'wavex' ); ?></p>
		</header>

		<div class="wb">
			<aside class="wb__side">
				<div class="wb__side-head"><span><?php esc_html_e( 'Explorer', 'wavex' ); ?></span><em><?php echo esc_html( sprintf( /* translators: %d: number of services. */ _n( '%d service', '%d services', $total, 'wavex' ), $total ) ); ?></em></div>

				<div class="wb__folders" role="group" aria-label="<?php esc_attr_e( 'Service areas', 'wavex' ); ?>">
					<?php $o = 0; foreach ( $groups as $gkey => $group ) : ?>
						<button class="sx__pill sx__pill--<?php echo esc_attr( $gkey ); ?>" type="button" data-group="<?php echo esc_attr( $gkey ); ?>" aria-pressed="false" style="order: <?php echo (int) ( $o * 2 ); ?>;">
							<span class="wb__folder-icon"><?php echo wavex_icon( isset( $g_icons[ $gkey ] ) ? $g_icons[ $gkey ] : 'grid' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="wb__folder-name"><?php echo esc_html( $group['label'] ); ?></span>
							<span class="sx__pill-count"><?php echo (int) count( $group['services'] ); ?></span>
							<span class="wb__chev"><?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</button>
						<?php ++$o; ?>
					<?php endforeach; ?>
				</div>

				<div class="wb__lists studio__nav" role="tablist" aria-label="<?php esc_attr_e( 'Services', 'wavex' ); ?>">
					<?php $o = 0; foreach ( $groups as $gkey => $group ) : ?>
						<div class="wb__list" data-group="<?php echo esc_attr( $gkey ); ?>" style="order: <?php echo (int) ( $o * 2 + 1 ); ?>;">
							<?php foreach ( $group['services'] as $slug ) : $service = $services[ $slug ]; ?>
								<button class="studio__tab studio__tab--<?php echo esc_attr( $gkey ); ?> gtheme--<?php echo esc_attr( $gkey ); ?>" type="button" role="tab" data-group="<?php echo esc_attr( $gkey ); ?>" id="tab-<?php echo esc_attr( $slug ); ?>" aria-controls="panel-<?php echo esc_attr( $slug ); ?>" aria-selected="<?php echo $first ? 'true' : 'false'; ?>" tabindex="<?php echo $first ? '0' : '-1'; ?>">
									<span class="studio__tab-icon"><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									<span class="studio__tab-label"><?php echo esc_html( $service['title'] ); ?></span>
								</button>
								<?php $first = false; ?>
							<?php endforeach; ?>
						</div>
						<?php ++$o; ?>
					<?php endforeach; ?>
				</div>
			</aside>

			<div class="wb__main studio__main">
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
