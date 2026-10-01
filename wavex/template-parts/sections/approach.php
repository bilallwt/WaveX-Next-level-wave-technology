<?php
/**
 * Home: process overview (understand, plan, develop, launch, support).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steps = array(
	array( __( 'Understand', 'wavex' ), __( 'We start by learning your requirements and goals.', 'wavex' ) ),
	array( __( 'Plan', 'wavex' ), __( 'We plan the project and agree the direction together.', 'wavex' ) ),
	array( __( 'Develop', 'wavex' ), __( 'We design and build the solution.', 'wavex' ) ),
	array( __( 'Launch', 'wavex' ), __( 'We launch your product or website.', 'wavex' ) ),
	array( __( 'Support', 'wavex' ), __( 'We provide ongoing support after launch.', 'wavex' ) ),
);
?>
<section class="section section--tint" aria-labelledby="approach-title">
	<header class="section__head">
		<h2 class="section__title" id="approach-title"><?php esc_html_e( 'How we work', 'wavex' ); ?></h2>
		<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'our-approach' ) ); ?>">
			<?php esc_html_e( 'Our approach', 'wavex' ); ?>
			<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</header>

	<ol class="steps">
		<?php foreach ( $steps as $n => $step ) : ?>
			<li class="steps__item">
				<span class="steps__num"><?php echo esc_html( str_pad( (string) ( $n + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
				<h3 class="steps__title"><?php echo esc_html( $step[0] ); ?></h3>
				<p><?php echo esc_html( $step[1] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ol>
</section>
