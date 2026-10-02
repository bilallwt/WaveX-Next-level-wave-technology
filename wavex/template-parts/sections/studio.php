<?php
/**
 * Home: "See how it works", as a spell circle. Every service is a rune on one of
 * three rings; pick one and the scene is cast on the right, with its code.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$groups   = wavex_studio_groups();
$first    = true;

// Ring layout: radius in % of the circle, rotation offset in degrees.
$rings = array(
	'web'    => array( 45, -90 ),
	'seo'    => array( 32, -60 ),
	'mobile' => array( 19.5, -90 ),
);
$g_icons = array( 'web' => 'layout', 'mobile' => 'mobile', 'seo' => 'search' );
$first_slug  = '';
$first_group = '';
foreach ( $groups as $gk => $g ) {
	$first_slug  = $g['services'][0];
	$first_group = $gk;
	break;
}
?>
<section class="studio studio--home mg" id="studio" aria-labelledby="studio-title" data-studio data-all-tabs>
	<div class="mg__sky" aria-hidden="true">
		<?php for ( $i = 0; $i < 34; $i++ ) : ?>
			<i style="left: <?php echo (int) ( ( $i * 37 + 11 ) % 100 ); ?>%; top: <?php echo (int) ( ( $i * 53 + 7 ) % 100 ); ?>%; --d: <?php echo esc_attr( number_format( ( $i % 7 ) * .6, 1 ) ); ?>s; --s: <?php echo (int) ( 2 + $i % 3 ); ?>px;"></i>
		<?php endfor; ?>
		<b class="mg__aurora mg__aurora--1"></b><b class="mg__aurora mg__aurora--2"></b>
	</div>

	<div class="mg__inner">
		<header class="mg__head">
			<p class="mg__eyebrow"><span></span><?php esc_html_e( 'See how it works', 'wavex' ); ?></p>
			<h2 class="mg__title" id="studio-title"><?php esc_html_e( 'Pick a service. Watch the magic happen.', 'wavex' ); ?></h2>
			<p class="mg__lead"><?php esc_html_e( 'Every glowing rune is one of our services. Tap one and watch what happens behind the scenes: the screens appear while the code is written. These are illustrations of our process.', 'wavex' ); ?></p>
			<div class="mg__legend" role="group" aria-label="<?php esc_attr_e( 'Service areas', 'wavex' ); ?>">
				<?php foreach ( $groups as $gkey => $group ) : ?>
					<button class="sx__pill sx__pill--<?php echo esc_attr( $gkey ); ?>" type="button" data-group="<?php echo esc_attr( $gkey ); ?>" aria-pressed="false">
						<i></i><?php echo esc_html( $group['label'] ); ?><span class="sx__pill-count"><?php echo (int) count( $group['services'] ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
		</header>

		<div class="mg__stage">
			<div class="mg__circle-wrap">
				<div class="mg__circle" role="tablist" aria-label="<?php esc_attr_e( 'Services', 'wavex' ); ?>">
					<span class="mg__orbit mg__orbit--1" aria-hidden="true"></span>
					<span class="mg__orbit mg__orbit--2" aria-hidden="true"></span>
					<span class="mg__orbit mg__orbit--3" aria-hidden="true"></span>
					<span class="mg__spin" aria-hidden="true"><i></i><i></i><i></i></span>

					<div class="mg__core" aria-live="polite">
						<span class="mg__core-ring" aria-hidden="true"></span>
						<span class="mg__core-icon" data-mg-icon aria-hidden="true"><?php echo wavex_icon( $services[ $first_slug ]['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<strong class="mg__core-name" data-mg-name><?php echo esc_html( $services[ $first_slug ]['title'] ); ?></strong>
						<small class="mg__core-group" data-mg-group><?php echo esc_html( $groups[ $first_group ]['label'] ); ?></small>
					</div>

					<?php
					foreach ( $groups as $gkey => $group ) :
						$count = count( $group['services'] );
						$cfg   = isset( $rings[ $gkey ] ) ? $rings[ $gkey ] : array( 40, -90 );
						foreach ( $group['services'] as $n => $slug ) :
							$service = $services[ $slug ];
							$angle   = $cfg[1] + ( 360 / $count ) * $n;
							?>
							<button class="studio__tab studio__tab--<?php echo esc_attr( $gkey ); ?> gtheme--<?php echo esc_attr( $gkey ); ?> mg__rune" type="button" role="tab" data-group="<?php echo esc_attr( $gkey ); ?>" id="tab-<?php echo esc_attr( $slug ); ?>" aria-controls="panel-<?php echo esc_attr( $slug ); ?>" aria-selected="<?php echo $first ? 'true' : 'false'; ?>" tabindex="<?php echo $first ? '0' : '-1'; ?>" style="--a: <?php echo esc_attr( round( $angle, 2 ) ); ?>deg; --r: <?php echo esc_attr( $cfg[0] ); ?>;" data-icon="<?php echo esc_attr( $service['icon'] ); ?>">
								<span class="studio__tab-icon"><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<span class="studio__tab-label"><?php echo esc_html( $service['title'] ); ?></span>
							</button>
							<?php
							$first = false;
						endforeach;
					endforeach;
					?>
				</div>
			</div>

			<div class="mg__beam" aria-hidden="true"><i></i></div>

			<div class="mg__panelwrap studio__main">
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

		<div class="mg__cta">
			<p><strong><?php esc_html_e( 'Have something in mind?', 'wavex' ); ?></strong> <?php esc_html_e( 'Tell us about it and we will talk it through.', 'wavex' ); ?></p>
			<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'a development project', 'wavex' ) ) ); ?>
		</div>
	</div>
</section>
