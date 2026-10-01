<?php
/**
 * Home: the Studio. One animated, illustrative scene for every service.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$scenes   = wavex_studio_scenes();
$groups   = wavex_studio_groups();
?>
<section class="studio" id="studio" aria-labelledby="studio-title" data-studio>
	<div class="studio__inner">
		<header class="studio__head">
			<p class="eyebrow eyebrow--pill"><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
			<h2 class="section__title" id="studio-title"><?php esc_html_e( 'Watch every service come to life', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Pick a service to see, in a short animation, what happens behind the scenes. These are illustrations of our process.', 'wavex' ); ?></p>
		</header>

		<div class="studio__shell">
			<div class="studio__nav" role="tablist" aria-orientation="vertical" aria-label="<?php esc_attr_e( 'Services', 'wavex' ); ?>">
				<?php
				$first = true;
				foreach ( $groups as $group ) :
					?>
					<p class="studio__group"><?php echo esc_html( $group['label'] ); ?></p>
					<?php
					foreach ( $group['services'] as $slug ) :
						$service = $services[ $slug ];
						?>
						<button class="studio__tab" type="button" role="tab" id="tab-<?php echo esc_attr( $slug ); ?>" aria-controls="panel-<?php echo esc_attr( $slug ); ?>" aria-selected="<?php echo $first ? 'true' : 'false'; ?>" tabindex="<?php echo $first ? '0' : '-1'; ?>">
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
				foreach ( $groups as $group ) :
					foreach ( $group['services'] as $slug ) :
						$service = $services[ $slug ];
						$scene   = $scenes[ $slug ];
						?>
						<div class="studio__panel" id="panel-<?php echo esc_attr( $slug ); ?>" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr( $slug ); ?>"<?php echo $first ? '' : ' hidden'; ?> data-code="<?php echo esc_attr( wp_json_encode( $scene['code'] ) ); ?>">
							<div class="studio__top">
								<div>
									<p class="studio__badge"><?php echo esc_html( $group['label'] ); ?></p>
									<h3 class="studio__title"><?php echo esc_html( $scene['title'] ); ?></h3>
									<p class="studio__text"><?php echo esc_html( $scene['text'] ); ?></p>
								</div>
								<a class="btn btn--ghost btn--sm" href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>">
									<?php
									/* translators: %s: service name. */
									echo esc_html( sprintf( __( 'About %s', 'wavex' ), $service['title'] ) );
									?>
									<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							</div>

							<div class="stage"<?php echo ( 'wordpress' === $scene['scene'] ) ? '' : ' aria-hidden="true"'; ?>>
								<?php get_template_part( 'template-parts/studio/scene', $scene['scene'] ); ?>
							</div>

							<div class="studio__bottom">
								<figure class="code code--live" aria-label="<?php esc_attr_e( 'Example code, illustrative', 'wavex' ); ?>">
									<figcaption class="code__bar">
										<span class="code__dot"></span><span class="code__dot"></span><span class="code__dot"></span>
										<span class="code__file"><?php esc_html_e( 'example code', 'wavex' ); ?></span>
									</figcaption>
									<pre class="code__body"><code class="studio__code" aria-hidden="true"></code><noscript><?php echo esc_html( implode( "\n", $scene['code'] ) ); ?></noscript></pre>
								</figure>
								<ol class="studio__steps">
									<?php foreach ( $scene['steps'] as $step ) : ?>
										<li><?php echo esc_html( $step ); ?></li>
									<?php endforeach; ?>
								</ol>
							</div>
						</div>
						<?php
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
