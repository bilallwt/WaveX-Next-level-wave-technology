<?php
/**
 * Home: process overview as a journey (understand, plan, develop, launch, support).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steps = array(
	array( __( 'Understand', 'wavex' ), __( 'We start by learning your requirements and goals.', 'wavex' ), 'chat', 'var(--blue)' ),
	array( __( 'Plan', 'wavex' ), __( 'We plan the project and agree the direction together.', 'wavex' ), 'compass', 'var(--teal)' ),
	array( __( 'Develop', 'wavex' ), __( 'We design and build the solution.', 'wavex' ), 'code', 'var(--purple)' ),
	array( __( 'Launch', 'wavex' ), __( 'We launch your product or website.', 'wavex' ), 'rocket', 'var(--green)' ),
	array( __( 'Support', 'wavex' ), __( 'We provide ongoing support after launch.', 'wavex' ), 'shield', 'var(--blue)' ),
);
?>
<section class="jr" aria-labelledby="approach-title">
	<div class="jr__inner">
		<header class="jr__head">
			<div>
				<p class="eyebrow"><?php esc_html_e( 'How we work', 'wavex' ); ?></p>
				<h2 class="section__title" id="approach-title"><?php esc_html_e( 'From the first message to launch, and after.', 'wavex' ); ?></h2>
			</div>
			<a class="btn btn--ghost" href="<?php echo esc_url( wavex_url( 'our-approach' ) ); ?>"><?php esc_html_e( 'Our approach', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</header>

		<ol class="jr__track">
			<li class="jr__pulse" aria-hidden="true"><i></i></li>
			<?php foreach ( $steps as $n => $step ) : ?>
				<li class="jr__step" style="--c: <?php echo esc_attr( $step[3] ); ?>; --i: <?php echo (int) $n; ?>;">
					<span class="jr__node"><?php echo wavex_icon( $step[2] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="jr__card">
						<span class="jr__no"><?php echo esc_html( str_pad( (string) ( $n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h3><?php echo esc_html( $step[0] ); ?></h3>
						<p><?php echo esc_html( $step[1] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>

		<div class="jr__cta">
			<p><?php esc_html_e( 'Ready to start? Send us a message and we will take it from there.', 'wavex' ); ?></p>
			<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'starting a project', 'wavex' ) ) ); ?>
		</div>
	</div>
</section>
