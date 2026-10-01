<?php
/**
 * Home: "at a glance" cards. All figures are real: counts of this site's own
 * services, projects, process steps and contact channels.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact  = wavex_contact();
$channels = 1 + ( $contact['whatsapp'] ? 1 : 0 ) + ( $contact['phone'] ? 1 : 0 );
$projects = count( wavex_projects() );
if ( function_exists( 'wp_count_posts' ) ) {
	$counts = wp_count_posts( 'project' );
	if ( $counts && ! empty( $counts->publish ) ) {
		$projects = (int) $counts->publish;
	}
}

$cards = array(
	array( 'blue', count( wavex_services() ), __( 'Services we offer', 'wavex' ), __( 'Web, mobile, software and marketing', 'wavex' ), 'services' ),
	array( 'purple', $projects, __( 'Projects built', 'wavex' ), __( 'See the websites and apps', 'wavex' ), 'our-work' ),
	array( 'green', count( wavex_approach_steps() ), __( 'Step process', 'wavex' ), __( 'From understanding to support', 'wavex' ), 'our-approach' ),
	array( 'teal', $channels, __( 'Ways to reach us', 'wavex' ), $contact['whatsapp'] ? __( 'WhatsApp, email and more', 'wavex' ) : __( 'Message us directly', 'wavex' ), 'contact' ),
);
$spark = array(
	'M0 34 C20 30 28 36 48 26 S78 22 96 12 S122 14 140 4',
	'M0 30 C18 34 30 20 50 24 S80 30 98 16 S124 8 140 6',
	'M0 36 C22 32 34 28 52 30 S82 16 100 14 S126 10 140 2',
	'M0 28 C20 36 32 22 52 20 S84 26 102 12 S126 12 140 4',
);
?>
<section class="glance" aria-label="<?php esc_attr_e( 'WaveX at a glance', 'wavex' ); ?>">
	<ul class="glance__list">
		<?php foreach ( $cards as $i => $card ) : ?>
			<li>
				<a class="gcard gcard--<?php echo esc_attr( $card[0] ); ?>" href="<?php echo esc_url( wavex_url( $card[4] ) ); ?>">
					<span class="gcard__label"><?php echo esc_html( $card[2] ); ?></span>
					<span class="gcard__row">
						<strong class="gcard__num"><?php echo (int) $card[1]; ?></strong>
						<svg class="gcard__spark" viewBox="0 0 140 40" fill="none" aria-hidden="true" focusable="false"><path d="<?php echo esc_attr( $spark[ $i ] ); ?> V40 H0 Z" class="gcard__area"/><path d="<?php echo esc_attr( $spark[ $i ] ); ?>" class="gcard__line"/></svg>
					</span>
					<span class="gcard__note"><?php echo esc_html( $card[3] ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
