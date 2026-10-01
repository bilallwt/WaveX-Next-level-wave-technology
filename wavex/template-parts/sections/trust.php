<?php
/**
 * Home: trust strip. Only verifiable statements: real pages and real contact paths.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = array(
	array( 'briefcase', __( 'See real work', 'wavex' ), __( 'Browse the projects we have built.', 'wavex' ), 'our-work' ),
	array( 'compass', __( 'Know the process', 'wavex' ), __( 'Our approach is explained openly.', 'wavex' ), 'our-approach' ),
	array( 'chat', __( 'Talk to us directly', 'wavex' ), __( 'Message us on WhatsApp or email.', 'wavex' ), 'contact' ),
	array( 'shield', __( 'Your information stays yours', 'wavex' ), __( 'Read our Privacy Notice.', 'wavex' ), 'privacy-policy' ),
);
?>
<section class="trust" aria-label="<?php esc_attr_e( 'Why you can trust WaveX', 'wavex' ); ?>">
	<ul class="trust__list">
		<?php foreach ( $items as $item ) : ?>
			<li>
				<a class="trust__item" href="<?php echo esc_url( wavex_url( $item[3] ) ); ?>">
					<span class="trust__icon"><?php echo wavex_icon( $item[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span>
						<strong><?php echo esc_html( $item[1] ); ?></strong>
						<span><?php echo esc_html( $item[2] ); ?></span>
					</span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
